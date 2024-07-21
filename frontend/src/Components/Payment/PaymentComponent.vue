<template>
  <div class="payment-form">
    <div class="card payment-details">
      <div class="card-header">
        <h5>Payment Method<span class="badge badge-warning">TEST MODE</span></h5>
        <p class="mt-2 mb-0 font-weight-bold">Enjoy your post and reduce new product</p>
        <h2 class="mt-3">{{ formattedAmount }}</h2>
        <div class="stripe-logo mt-5">
          <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/04/Visa.svg/1200px-Visa.svg.png" alt="visa">
          <img src="https://upload.wikimedia.org/wikipedia/commons/2/2a/Mastercard-logo.svg" alt="mastercard">
        </div>
      </div>
    </div>
    <div class="card payment-details">
      <div class="card-body">
        <form @submit.prevent="submitPayment" :disabled="submitting">
          <div class="form-group">
            <label for="email">Contact information</label>
            <input type="email" class="form-control" id="email" v-model="email" placeholder="Email" required>
          </div>
          <div class="form-group">
            <label for="total">Amount</label>
            <input type="number" class="form-control" id="total" v-model.number="amount" placeholder="Total" required>
          </div>
          <div v-if="paymentMethod === 'card'">
            <div class="form-group">
              <label for="cardInfo">Card information</label>
              <div id="card-element" class="form-control"></div>
              <div id="card-errors" role="alert"></div>
            </div>
          </div>
          <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="saveInfo" v-model="saveInfo">
            <label class="form-check-label" for="saveInfo">Securely save my information for 1-click checkout</label>
          </div>
          <button type="submit" class="btn btn-primary mt-5" :disabled="submitting">Pay</button>
        </form>
        <div class="powered-by">
          <p class="text-muted">Powered by <strong>Stripe</strong></p>
          <p><a href="#">Terms</a> | <a href="#">Privacy</a></p>
        </div>
      </div>
    </div>
    <div v-if="showModal" class="custom-modal-overlay">
      <div class="custom-modal">
        <div class="custom-modal-header">
          <h5><i class="bi bi-check-circle-fill me-2 text-success"></i> Payment Successful!</h5>
          <button type="button" @click="closeModal" class="close-button">&times;</button>
        </div>
        <div class="custom-modal-body">
          <p>Your payment was processed successfully.</p>
          <p v-if="planTitle === 'Pro'">Your next payment will be due on {{ nextPaymentDate }}</p>
        </div>
        <div class="custom-modal-footer">
          <button type="button" @click="closeModal" class="btn btn-secondary">OK</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { loadStripe } from '@stripe/stripe-js';
import axios from 'axios';

export default {
  name: 'PaymentForm',
  data() {
    return {
      stripe: null,
      elements: null,
      cardElement: null,
      email: '',
      amount: this.$route.query.planPrice,
      paymentMethod: 'card',
      saveInfo: false,
      showModal: false,
      submitting: false,
      nextPaymentDate: '',
      planTitle: this.$route.query.planTitle
    };
  },
  computed: {
    formattedAmount() {
      return `$${this.amount}`;
    }
  },
  async mounted() {
    this.stripe = await loadStripe('pk_test_51PZ1M92KMJfWGuxDbOviEzE7eldlNfD2vLtPaweyyJPTAJEmEy7APiGipQYtve6F0MNP4iJTAxK15MAS9R25DRyG00GuyPPGZh');
    this.elements = this.stripe.elements();
    this.cardElement = this.elements.create('card', {
      style: {
        base: {
          iconColor: '#666EE8',
          color: '#31325F',
          fontWeight: 400,
          fontFamily: 'Helvetica Neue, Helvetica, Arial, sans-serif',
          fontSize: '16px',
          '::placeholder': {
            color: '#CFD7E0'
          }
        }
      }
    });
    this.cardElement.mount('#card-element');
    this.cardElement.on('change', (event) => {
      const displayError = document.getElementById('card-errors');
      if (event.error) {
        displayError.textContent = event.error.message;
      } else {
        displayError.textContent = '';
      }
    });
  },
  methods: {
    async submitPayment() {
      this.submitting = true;
      try {
        const { data } = await axios.post('http://127.0.0.1:8000/api/stripe/payment', {
          amount: this.amount
        });
        const clientSecret = data.client_secret;
        const { error, paymentIntent } = await this.stripe.confirmCardPayment(clientSecret, {
          payment_method: {
            card: this.cardElement,
            billing_details: {
              email: this.email
            }
          }
        });
        if (error) {
          console.error(error.message);
          const displayError = document.getElementById('card-errors');
          displayError.textContent = error.message;
        } else {
          if (paymentIntent) {
            await axios.post('http://127.0.0.1:8000/api/stripe/handlePaymentSuccess', {
              payment_intent_id: paymentIntent.id,
              email: this.email,
              plan_title: this.planTitle
            });
            if (this.planTitle === 'Pro') {
              const currentDate = new Date();
              const nextPaymentDate = new Date(currentDate.setMonth(currentDate.getMonth() + 1));
              this.nextPaymentDate = nextPaymentDate.toISOString().split('T')[0];
            }
            this.showModal = true;
          }
        }
      } catch (error) {
        console.error(error);
      } finally {
        this.submitting = false;
      }
    },
    closeModal() {
      this.showModal = false;
      this.$router.push('/product-post');
    }
  }
};
</script>

<style scoped>
/* Your styles here */
</style>

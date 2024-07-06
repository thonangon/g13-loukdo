<template>
    <div class="payment-form">
      <div class="card payment-details">
        <div class="card-header">
          <h5>Livelab Dev <span class="badge badge-warning">TEST MODE</span></h5>
          <p class="mt-2 mb-0 font-weight-bold">Asus Vivobook 17 Laptop - Intel Core 10th</p>
          <h2 class="mt-1">$0.00</h2>
          <div class="stripe-logo mt-5">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/04/Visa.svg/1200px-Visa.svg.png" alt="visa">
            <img src="https://upload.wikimedia.org/wikipedia/commons/2/2a/Mastercard-logo.svg" alt="mastercard">
          </div>
        </div>
      </div>
      <div class="card payment-details">
        <div class="card-body">
          <form @submit.prevent="submitPayment">
            <div class="form-group">
              <label for="email">Contact information</label>
              <input type="email" class="form-control" id="email" v-model="email" placeholder="Email">
            </div>
            <div class="form-group">
              <label for="paymentMethod">Payment method</label>
              <div class="payment-method">
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" id="card" name="paymentMethod" class="custom-control-input" v-model="paymentMethod" value="card">
                  <label class="custom-control-label" for="card">Card</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" id="cashAppPay" name="paymentMethod" class="custom-control-input" v-model="paymentMethod" value="cashAppPay">
                  <label class="custom-control-label" for="cashAppPay">Cash App Pay</label>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="total">Amount</label>
              <input type="number" class="form-control" id="total" v-model.number="amount" placeholder="total">
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
            <button type="submit" class="btn btn-primary mt-5">Pay</button>
          </form>
          <div class="powered-by">
            <p class="text-muted">Powered by <strong>Stripe</strong></p>
            <p><a href="#">Terms</a> | <a href="#">Privacy</a></p>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import { loadStripe } from '@stripe/stripe-js';
  import api from "../../views/api";
  export default {
    data() {
      return {
        stripe: null,
        elements: null,
        cardElement: null,
        email: '',
        paymentMethod: 'card',
        amount: 0.00,
        saveInfo: false,
      };
    },
    async mounted() {
      // Load Stripe
      this.stripe = await loadStripe('pk_test_51PZ1M92KMJfWGuxDbOviEzE7eldlNfD2vLtPaweyyJPTAJEmEy7APiGipQYtve6F0MNP4iJTAxK15MAS9R25DRyG00GuyPPGZh'); // Replace with your publishable key
  
      // Create an instance of Elements
      this.elements = this.stripe.elements();
  
      // Create a Card Element and mount it to the #card-element div
      this.cardElement = this.elements.create('card', {
        style: {
          base: {
            iconColor: '#666EE8',
            color: '#31325F',
            fontWeight: 400,
            fontFamily: 'Helvetica Neue, Helvetica, Arial, sans-serif',
            fontSize: '16px',
            '::placeholder': {
              color: '#CFD7E0',
            },
          },
        },
      });
      this.cardElement.mount('#card-element');
  
      // Handle real-time validation errors from the card Element
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
        try {
          // Create a Payment Intent on the backend
          const { data } = await api.ChargeMoney({
            amount: this.amount * 100, // Convert amount to cents
          });
  
          // Confirm the Card Payment
          const { error, paymentIntent } = await this.stripe.confirmCardPayment(data.clientSecret, {
            payment_method: {
              card: this.cardElement,
              billing_details: {
                email: this.email,
              },
            },
          });
  
          if (error) {
            // Show error to your customer
            console.error(error.message);
            const displayError = document.getElementById('card-errors');
            displayError.textContent = error.message;
          } else {
            if (paymentIntent.status === 'succeeded') {
              console.log('Payment succeeded:', paymentIntent);
              // Show a success message to your customer
              alert('Payment succeeded!');
            }
          }
        } catch (error) {
          console.error('Error creating payment intent:', error);
        }
      },
    },
  };
  </script>
  
  <style scoped>
  .payment-form {
    max-width: 1000px;
    margin: auto;
    display: flex;
    flex-direction: row;
    justify-content: space-between;
  }
  .payment-details {
    width: 48%;
  }
  .payment-form .card {
    padding: 20px;
  }
  .payment-form .card .card-header {
    background: none;
    border: none;
    padding: 0;
  }
  .payment-form .form-group label {
    font-weight: bold;
  }
  .payment-form .form-control {
    margin-bottom: 10px;
  }
  .payment-form .btn-primary {
    width: 100%;
  }
  .payment-method {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
  }
  .payment-method .custom-control {
    margin-right: 10px;
  }
  .powered-by {
    text-align: center;
    margin-top: 20px;
  }
  .stripe-logo {
    text-align: center;
    margin-bottom: 20px;
  }
  .stripe-logo img {
    max-width: 100px;
    margin: 0 5px;
  }
  </style>
  
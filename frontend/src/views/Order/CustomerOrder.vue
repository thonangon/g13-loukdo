<template>
  <div class="container my-5">
    <h3 class="mb-3" style="padding-top: 50px;">Payment Bank</h3>
    <div class="row">
      <div class="col-md-6 mb-4" style="padding-top: 25px;">
        <div class="card border-0">
          <div class="row no-gutters">
            <div class="col-4" @click="selectBank('ABA')">
              <img src="https://i.pinimg.com/564x/e2/33/f5/e233f5b0c5a358449398f202b03f063a.jpg" class="card-img" alt="ABA">
              <span class="mt-2">Pay with ABA</span>
            </div>
            <div class="col-4" @click="selectBank('Wing')">
              <img src="https://i.pinimg.com/736x/25/e8/7c/25e87cd478a762a4f9c3d79c35246cda.jpg" class="card-img" alt="Wing">
              <span class="mt-2">Pay with Wing</span>
            </div>
            <div class="col-4" @click="selectBank('Canadia')">
              <img src="https://i.pinimg.com/564x/84/0e/9e/840e9e6497547428463c05a21bd5c3d4.jpg" class="card-img" alt="Canadia">
              <span class="mt-2">Pay with Canadia</span>
            </div>
          </div>
          <div class="card-body">
            <div v-if="selectedBank">
              <h5 class="text-center mb-4">Confirm Payment Method</h5>
              <div class="text-center">
                <button class="btn btn-success me-2" @click="payWithSelectedBank">Proceed to Pay</button>
              </div>
            </div>
            <div v-else>
              <p class="text-muted text-center mt-3">Please select a payment method to continue.</p>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-6 mb-4">
        <div class="card border-0">
          <div class="card-body" style="padding-left: 130px;">
            <h2 class="card-title mb-4">{{ orderData.product_name }}</h2>
            <div class="d-flex mb-3">
              <span>Price:</span>
              <span style="margin-left: 150px;"><b>${{ orderData.price }}</b></span>
            </div>
            <div class="d-flex mb-4">
              <span>Quantities:</span>
              <span style="margin-left: 120px;"><b>{{ orderData.quantity }}</b></span>
            </div>
            <div class="d-flex mb-3">
              <span>Delivery:</span>
              <span style="margin-left: 140px;"><b>${{ orderData.delivery }}</b></span>
            </div>
            <div class="d-flex">
              <span>Total:</span>
              <span style="margin-left: 170px;"><b>${{ orderData.total }}</b></span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import api from "@/views/api.js";
import { useUserStore } from "@/stores/user.js";

export default {
  data() {
    return {
      selectedBank: null,
      orderData: {}
    };
  },
  created() {
    const orderProducts = JSON.parse(localStorage.getItem('orderData'));
    if (orderProducts) {
      this.orderData = {
        product_id: orderProducts.product_id,
        product_name: orderProducts.product_name,
        price: orderProducts.price,
        quantity: orderProducts.quantity,
        delivery: orderProducts.delivery,
        total: orderProducts.total
      };
    }
  },
  methods: {
    selectBank(bank) {
      this.selectedBank = bank;
    },
    async payWithSelectedBank() {
      try {
        if (!this.selectedBank) {
          alert('Please select a payment method.');
          return;
        }
        
        const store_user = useUserStore();
        const orderData = {
          user_id: store_user.accountUser.id,
          order_date: new Date().toISOString().split('T')[0],
          products: [
            {
              product_id: this.orderData.product_id,
              qty: this.orderData.quantity
            }
          ],
          bank: this.selectedBank
        };

        console.log('Order Data:', orderData); 

        const response = await api.Order_Product(orderData);
        console.log('Order created:', response.data);
        this.showOrderSuccessPopup(); 
      } catch (error) {
        console.error('Error creating order:', error.response ? error.response.data : error.message); // Debugging line
        alert('Failed to create order. Please try again later.');
      }
    },
    showOrderSuccessPopup() {
      alert('Order created successfully!');
    }
  }
};
</script>

<style>
/* Your component styles */
</style>

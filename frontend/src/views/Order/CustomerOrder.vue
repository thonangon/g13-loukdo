<template>
  <div class="container my-5">
    <h3 class="mb-3" style="padding-top: 50px;">Payment Bank</h3>
    <div class="row">
      <div class="col-md-6 mb-4" style="padding-top: 25px;">
        <div class="card border-0">
          <div class="row no-gutters">
            <div class="col-4">
              <img src="https://i.pinimg.com/564x/e2/33/f5/e233f5b0c5a358449398f202b03f063a.jpg" class="card-img" alt="Product 1" @click="selectBank('ABA')">
              <span>ABA</span>
            </div>
            <div class="col-4">
              <img src="https://i.pinimg.com/736x/25/e8/7c/25e87cd478a762a4f9c3d79c35246cda.jpg" class="card-img" alt="Product 2" @click="selectBank('Wing')">
              <span>Wing</span>
            </div>
            <div class="col-4">
              <img src="https://i.pinimg.com/564x/84/0e/9e/840e9e6497547428463c05a21bd5c3d4.jpg" class="card-img" alt="Product 3" @click="selectBank('Canadia')">
              <span>Canadia</span>
            </div>
          </div>
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center" style="padding-top: 30px;">
              <button class="btn me-2 w-50 border-0 " style="background-color: #f0f0f0;">Contact Owner</button>
              <button class="btn btn-outline-secondary w-50 border-0" style="background-color: black;" @click="createOrder">Buy Now</button>
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
            <div class="d-flex mb-4">
              <span>Total:</span>
              <span style="margin-left: 155px;"><b>${{ orderData.total }}</b></span>
            </div>
            <div class="d-flex mb-3">
              <span>Delivery:</span>
              <span style="margin-left: 130px;"><b>${{ orderData.delivery }}</b></span>
            </div>
            <div class="d-flex mb-4">
              <span>Delivery Start:</span>
              <span style="margin-left: 100px;"><b>8:45AM</b></span>
            </div>
            <div class="d-flex mb-4">
              <span>Arrived:</span>
              <span style="margin-left: 145px;"><b>10:30AM</b></span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      selectedBank: null,
      orderData: JSON.parse(localStorage.getItem('orderData')) || {},
    };
  },
  methods: {
    selectBank(bank) {
      this.selectedBank = bank;
    },
    async createOrder() {
      try {
        const orderData = {
          user_id: this.store_user.accountUser.id, // Assumes user ID is available in the store
          order_date: new Date().toISOString().split('T')[0], // Current date in YYYY-MM-DD format
          products: [
            {
              product_id: this.orderData.product_id,
              qty: this.orderData.quantity
            }
          ],
          payment_method: this.selectedBank // Include the selected bank in the order data
        };
        const response = await axios.post('/api/orders', orderData);
        console.log('Order created:', response.data);
        // Handle successful order creation, e.g., redirect to order summary or show success message
      } catch (error) {
        console.error('Error creating order:', error);
      }
    }
  }
};
</script>

<style>
/* Your component styles */
</style>

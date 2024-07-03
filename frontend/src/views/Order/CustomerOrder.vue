<template>
  <div class="container my-5">
    <h3 class="mb-3" style="padding-top: 50px;">Payment Bank</h3>
    <div class="row">
      <div class="col-md-6 mb-4" style="padding-top: 25px;">
        <div class="card border-0">
          <div class="row no-gutters">
            <div class="col-4">
              <img src="https://i.pinimg.com/564x/e2/33/f5/e233f5b0c5a358449398f202b03f063a.jpg" class="card-img" alt="ABA" @click="selectBank('ABA')">
              <span>ABA</span>
            </div>
            <div class="col-4">
              <img src="https://i.pinimg.com/736x/25/e8/7c/25e87cd478a762a4f9c3d79c35246cda.jpg" class="card-img" alt="Wing" @click="selectBank('Wing')">
              <span>Wing</span>
            </div>
            <div class="col-4">
              <img src="https://i.pinimg.com/564x/84/0e/9e/840e9e6497547428463c05a21bd5c3d4.jpg" class="card-img" alt="Canadia" @click="selectBank('Canadia')">
              <span>Canadia</span>
            </div>
          </div>
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center" style="padding-top: 30px;">
              <button class="btn me-2 w-50 border-0" style="background-color: #f0f0f0;">Contact Owner</button>
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
    const storedOrderData = JSON.parse(localStorage.getItem('orderData'));
    if (storedOrderData) {
      this.orderData = {
        product_id: storedOrderData.product_id,
        product_name: storedOrderData.product_name,
        price: storedOrderData.price,
        quantity: storedOrderData.quantity,
        delivery: storedOrderData.delivery,
        total: storedOrderData.total
      };
    }
  },
  methods: {
    selectBank(bank) {
      this.selectedBank = bank;
    },
    async createOrder() {
      try {
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

        console.log('Order Data:', orderData); // Debugging line

        const response = await api.Order_Product(orderData);
        console.log('Order created:', response.data);
        alert('Order created successfully!');
      } catch (error) {
        console.error('Error creating order:', error.response ? error.response.data : error.message); // Debugging line
        alert('Failed to create order. Please try again later.');
      }
    }
  }
};
</script>

<style>
/* Your component styles */
</style>

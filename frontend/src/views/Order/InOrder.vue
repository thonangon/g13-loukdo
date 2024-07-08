<template>
  <div class="container mt-4">
    <div class="row d-flex justify-content-between">
      <h3>Current orders</h3>
      <div class="col-lg-8 mb-4" style="width: 75%;">
        <div v-for="order in currentOrder" :key="order.id" class="card mb-4 shadow-sm">
          <div v-if="order.status !== 2">
            <div class="card-header d-flex justify-content-between">
                <div class="product d-flex gap-3">
                    <img :src="productImage(order.products[0].image)" alt="" style="width: 100px; height: 100px;">
                    <div class="product_title">
                        <div class="d-flex align-items-center">
                          <img v-if="order.products[0].owner.image" :src="profile_url(order.products[0].owner.image)" alt="User Image" class="text-dark profile-img">
                          <img v-else :src="ownerprofileName(order.products[0].owner.name)" alt="User Image" class="text-dark profile-img">
                          <p class="mb-0 p-1">{{ order.products[0].owner.name }}</p>
                        </div>
                        <p class="mb-0 p-1">{{ order.products[0].name }}</p>
                        <p class="mb-0 p-1">Quantity: <strong>{{ order.quantity }}</strong></p>
                    </div>
                </div>
                <div class="d-flex align-items-center" style="height: 100px;">
                    <button v-if="order.status == 1" class="btn btn-dark" @click="status">Delivery</button>
                    <button v-if="order.status == 0" class="btn btn-dark" @click="cancelOrderProduct(order.id)">Cancel</button>
                </div>
            </div>
            <div class="card-header d-flex justify-content-between">
                <div class="d-flex flex-column align-items-start"><span>Order by</span> <strong>{{ store_user.accountUser.name }}</strong></div>
                <div class="d-flex flex-column align-items-start"><span>Order date:</span> <strong>{{ order.created_at }}</strong></div>
                <div class="d-flex flex-column align-items-start"><span>Payment status</span><strong>${{ order.products[0].price * order.quantity }}</strong></div>
                <div class="d-flex flex-column align-items-start"><span>Delivery</span><strong>$2</strong></div>
            </div>
          </div>
        </div>

        <h3>Past orders</h3>
        <div v-for="order in currentOrder" :key="order.id" class="card mb-4 shadow-sm">
          <div v-if="order.status == 2">
            <div class="card-header d-flex justify-content-between">
              <div class="product d-flex gap-3">
                <img :src="productImage(order.products[0].image)" alt="" style="width: 100px; height: 100px;">
                <div class="product_title">
                  <div class="d-flex align-items-center">
                    <img v-if="order.products[0].owner.image" :src="profile_url(order.products[0].owner.image)" alt="User Image" class="text-dark profile-img">
                    <img v-else :src="ownerprofileName(order.products[0].owner.name)" alt="User Image" class="text-dark profile-img">
                    <p class="mb-0 p-1">{{ order.products[0].owner.name }}</p>
                  </div>
                  <p class="mb-0 p-1">{{ order.products[0].name }}</p>
                  <p class="mb-0 p-1">Quantity: <strong>{{ order.quantity }}</strong></p>
                </div>
              </div>
              <div class="d-flex align-items-center" style="height: 100px;">
                <a href="#" @click.prevent="toggleDetails(order)">See order</a>
              </div>
            </div>
            <div v-if="order.showDetails" class="card-header d-flex justify-content-between">
              <div class="d-flex flex-column align-items-start"><span>Order by</span> <strong>{{ store_user.accountUser.name }}</strong></div>
              <div class="d-flex flex-column align-items-start"><span>Order date:</span> <strong>{{ order.created_at }}</strong></div>
              <div class="d-flex flex-column align-items-start"><span>Payment status</span><strong>${{ order.products[0].price * order.quantity }} Done</strong></div>
              <div class="d-flex flex-column align-items-start"><span>Delivery</span><strong>$2</strong></div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-4" style="width: 25%;">
        <div class="d-flex flex-column-reverse" style="height: calc(2 * (250px + 1rem)); overflow-y: auto; scrollbar-width: thin; scrollbar-color: rgba(0, 0, 0, 0.3) rgba(0, 0, 0, 0.1);">
          <div v-for="product in products" :key="product.id" class="mb-3">
            <div class="card h-100 w-80 shadow-sm">
              <img :src="product.image" class="card-img-top" alt="Product Image">
              <div class="card-body d-flex flex-column">
                <h5 class="card-title">{{ product.name }}</h5>
                <p class="card-text">{{ product.description }}</p>
                <div class="mt-auto">
                  <router-link :to="'/product/' + product.id" class="btn btn-primary w-100">View Product</router-link>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { useUserStore } from '@/stores/user.js';
import api from "@/views/api.js";

export default {
  data() {
    return {
      store_user: useUserStore(),
      products: [
        { id: 1, name: 'Product 1', description: 'Description for product 1', image: 'https://via.placeholder.com/150' },
        { id: 2, name: 'Product 2', description: 'Description for product 2', image: 'https://via.placeholder.com/150' },
        { id: 3, name: 'Product 3', description: 'Description for product 3', image: 'https://via.placeholder.com/150' },
        // Add more products as needed
      ],
      currentOrder: null,
      pastOrder: []
    }
  },
  
  mounted(){
    this.fetchCurrentOrder();
    // this.fetchPastOrder();
  },
  methods: {
    async fetchCurrentOrder(){
      try {
        const headers = { Authorization: `Bearer ${this.store_user.tokenUser}` };
        const response = await api.listOrderProducts(headers);

        this.currentOrder = response.data.orderProducts; // Assuming response has currentOrders key
        console.log(this.currentOrder);
      } catch (error) {
        console.error('Error fetching current orders:', error);
      }
    },

    async cancelOrderProduct(orderId) {
      try {
        console.log(this.store_user.tokenUser)
        const headers = { Authorization: `Bearer ${this.store_user.tokenUser}` };
        const confirmed = confirm('Are you sure you want to cancel this order?');
        if (confirmed) {
          await api.deleteOrderProduct(orderId, headers);
          window.location.href = '/booking';
        }
      } catch (error) {
        console.error('Error deleting order product:', error);
      }
    },
    status(){
      alert('Your order has been successfully in delivery, please wait for the order. Thanks!');
    },

    productImage(filename){
      return api.imageUrlProduct(filename)
    },
    ownerprofileName(username) {
      if (username) {
        const initials = `${username[0]}${username[username.length - 1]}`.toUpperCase();
        return `https://dummyimage.com/100x100/000/fff&text=${initials}`;
      }
      return '../../assets/images/Male User.png';
    },
    profile_url(filename) {
      return api.profile(filename);
    },
    toggleDetails(order) {
      order.showDetails = !order.showDetails;
    },
    
  },
  
}
</script>

<style scoped>
.card {
  width: 100%;
}
.profile-img {
  width: 30px;
  height: 30px;
  border-radius: 50%;
  margin-right: 5px;
}

  /* Modern scrollbar styles */
  .d-flex {
    scrollbar-width: thin;
    scrollbar-color: rgba(0, 0, 0, 0.3) rgba(0, 0, 0, 0.1);
  }

  .d-flex::-webkit-scrollbar {
    width: 6px;
  }

  .d-flex::-webkit-scrollbar-track {
    background: rgba(0, 0, 0, 0.1);
  }

  .d-flex::-webkit-scrollbar-thumb {
    background-color: rgba(0, 0, 0, 0.3);
    border-radius: 10px;
    border: 3px solid rgba(0, 0, 0, 0);
  }

  .d-flex::-webkit-scrollbar-thumb:hover {
    background-color: rgba(0, 0, 0, 0.5);
  }
</style>

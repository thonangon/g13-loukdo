<template>
    <div class="container mt-4">
      <div class="row">
        <h3>Selling!</h3>
        <div class="col-lg-8 mb-4" style="width: 75%;">
          <!-- <div v-for="sell in currentSeller" :key="sell.id" class="card mb-4 shadow-sm"> -->
            <table class="table table-dark table-striped">
                <thead>
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Products</th>
                    <th scope="col">User Name</th>
                    <th scope="col">Quantities</th>
                    <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody v-for="(sell) in currentSeller" :key="sell.id" >
                    <tr v-if="sell.status !== 2">
                        <th scope="row">{{ sell.id }}</th>
                        <td>{{sell.products[0].name}}</td>
                        <td>{{sell.buyer.name}}</td>
                        <td>{{ sell.quantity }}</td>
                        <td class="">
                            <button v-if="sell.status == 0" class="btn btn-success" @click="updateStatus(sell.id, 1)">Confirm</button>
                            <button v-else class="btn btn-primary" @click="updateStatus(sell.id, 2)">Finish</button>
                        </td>
                    </tr>
                </tbody>
              </table>
            <h3>Sold out!</h3>
            <!-- <div v-for="sell in currentSeller" :key="sell.id" class="card mb-4 shadow-sm"> -->
            <table class="table table-dark table-striped">
                <thead>
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Products</th>
                    <th scope="col">User Name</th>
                    <th scope="col">Quantities</th>
                    <th scope="col">Totals</th>
                    </tr>
                </thead>
                <tbody>
                  <tr v-for="(sell, index) in currentSeller" :key="sell.id">
                    <th scope="row">{{ index + 1 }}</th>
                    <td>{{ sell.products[0].name }}</td>
                    <td>{{ sell.buyer.name }}</td>
                    <td>{{ sell.quantity }}</td>
                    <td>${{ sell.products[0].price * sell.quantity }}</td>
                  </tr>
                </tbody>
            </table>
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
        currentSeller: null,
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
          const response = await api.listSellerProducts(headers);
  
          this.currentSeller = response.data.orderProducts; // Assuming response has currentOrders key
          console.log(this.currentOrder);
        } catch (error) {
          console.error('Error fetching current orders:', error);
        }
      },

      async updateStatus(orderId, status) {
          const token = this.store_user.tokenUser; // Replace with the actual token

          try {
            const response = await api.updateOrderStatus(orderId, status, token);
            window.location.href ='/selling'
            console.log('Order status updated successfully', response);
          } catch (error) {
            console.error('Error updating order status', error);
          }
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
  
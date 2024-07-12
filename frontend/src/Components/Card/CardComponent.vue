<template>
  <section class="container">
    <div class="card mb-3 shadow-sm bg-light"  >
        <router-link :to="{ name: 'produc_detail', params: { id: product.id} }" style="text-decoration: none;">
          <img :src="imageProduct(product.image)" class="card-img" alt="clothe" style="height: 270px;"/>
        </router-link>
          <div class="card-body">
            <h5 class="card-title">{{ product.name }}</h5>
            <!-- <p class="card-text text-muted">{{ product.description }}</p> -->
            <h5 class="card-price text-success">${{ product.price }}</h5>
            <div class="d-flex align-items-center justify-content-between mt-3">
              <div class="star-rating" style="font-size: 1.5em; color: #f39c12">
                <span>&#9733;</span>
                <span>&#9733;</span>
                <span>&#9733;</span>
                <span>&#9734;</span>
              </div>
              <!-- <router-link :to="{ name: 'produc_detail', params: { id: product.id} }" class="btn btn-primary">Buy</router-link> -->
              <button class="btn btn-primary" @click="OrderProduct(product)">Buy</button>
            </div>
          </div>
        </div>
  </section>
  </template>
  
  <script>
  import api from '../../views/api'
  import { useUserStore } from "@/stores/user.js";
  export default {
    name: 'CardComponent',
    props: ['searchQuery', 'product'],
    data(){
      return {
        store_user: useUserStore(),
      }
    },
    methods:{
      imageProduct(filename){
        return api.imageUrlProduct(filename)
      },

      async OrderProduct(product) {
        try {
          const product_id = product.id;
          const quantity = 1;

          const orderData = {
            product_id: product_id,
            quantity: quantity,
          };

          const headers = { Authorization: `Bearer ${this.store_user.tokenUser}` };
          const response = await api.createOrderProduct(orderData, headers);

          console.log(response.data); // Optional: handle response as needed

          // Redirect to '/order' route after successful order creation
          this.$router.push('/booking');
        } catch (error) {
          console.error('Error ordering product:', error);
          // Handle error scenario, e.g., show error message to user
        }
      },
    }
  }
</script>

<style scoped>
.card {
  border-radius: 15px;
  overflow: hidden;
  transition: transform 0.2s;
}

.card:hover {
  transform: scale(1.05);
}

.card-img-top {
  height: 200px;
  object-fit: cover;
}

.card-body {
  padding: 20px;
}

.card-title {
  font-size: 1.2em;
  margin-bottom: 10px;
}

.card-text {
  font-size: 0.9em;
}

.card-price {
  font-size: 1.1em;
  font-weight: bold;
}

.star-rating span {
  margin-right: 5px;
}

.btn {
  border-radius: 30px;
  font-size: 0.9em;
  padding: 10px 20px;
}

.btn-primary {
  background-color: #007bff;
  border-color: #007bff;
}

.btn-primary:hover {
  background-color: #0056b3;
  border-color: #004085;
}
</style>

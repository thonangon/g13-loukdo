<template>
  <section class="container">
    <div class="row">
      <div class="col-md-3" v-for="(product, index) in filteredProducts" :key="index">
        <div class="card mb-3 shadow-sm">
          <img src="../../assets/images/Group 52.png" class="card-img" alt="clothe" />
          <div class="card-body">
            <h5 class="card-title">{{ product.name }}</h5>
            <p class="card-text text-muted">{{ product.description }}</p>
            <h5 class="card-price text-success">{{ product.price }}</h5>
            <div class="d-flex align-items-center justify-content-between mt-3">
              <div class="star-rating" style="font-size: 1.5em; color: #f39c12;">
                <span>&#9733;</span>
                <span>&#9733;</span>
                <span>&#9733;</span>
                <span>&#9733;</span>
                <span>&#9734;</span>
              </div>
              <router-link v-if="!store_user.accountUser" to="/register" class="btn btn-primary">Details</router-link>
              <router-link v-else :to="{ name: 'produc_detail', params: { id: product.id} }" class="btn btn-primary">Details</router-link>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  </template>
  
  
  <script>
  import api from '../../views/api'
  import { useUserStore } from '@/stores/user.js';
  export default {
    name: 'CardComponent',
    props: ['searchQuery'],
    setup() {
      const store_user = useUserStore();
      store_user.loadUser();
      return {
        store_user,
      }
    },
    data() {
      return {
        products: [],
      }
    },
    computed: {
      filteredProducts() {
        if (!this.searchQuery) {
          return this.products;
        }
        return this.products.filter(product => 
          product.name.toLowerCase().includes(this.searchQuery.toLowerCase())
        );
      }
    },
    async created() {
    try {
      const response = await api.listProduct();
      if (response.data.status) {
        this.products = response.data.data;
        this.$emit('products-loaded', this.products);
      } else {
        console.error('Error fetching products: ', response.data.message);
      }
    } catch (error) {
      console.error('API error: ', error);
    }
  },
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

<template>
    <section class="container">
      <h1>welcome to card</h1>
      <div class="row">
        <div class="col-md-3" v-for="(product, index) in products" :key="index">
          <div class="card mb-3">
            <img :src="product.image" class="card-img-top" alt="Example clothe" />
            <div class="card-body">
              <div class="d-flex align-items-center">
                <span class="material-symbols-outlined">account_circle</span>
                <div class="px-2 rounded font-semibold">{{ product.name }}</div>
              </div>
              <p class="card-text">{{ product.description }}</p>
              <div class="d-flex align-items-center justify-content-between">
                <div class="star-rating">
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star-half-alt checked"></span>
                  <span class="fa fa-star"></span>
                </div>
                <a href="#" class="btn btn-dark mt-3">Details</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </template>
  
  <script>
  import api from '../../views/api';
  export default {
    name: 'CardComponent',
    data() {
      return {
        products: []
      };
    },
    async created() {
      try {
        const response = await api.listProdcut();
        this.products = response.data;
      } catch (error) {
        console.error(error);
      }
    }
  };
  </script>
  
  <style scoped>
  /* Add any component-specific styles here */
  </style>
  
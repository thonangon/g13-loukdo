<template>
  <div class="container h-100">
    <div class="card mb-4" v-for="product in cart" :key="product.id">
      <div class="card1 d-flex m-4">
        <div class="d-flex justify-content-center align-items-center">
          <img :src="product_img_url(product.image)" alt="" style="width: 200px; height: 200px" />
        </div>
        <div class="text1 m-4">
          <h2>{{ product.name }}</h2>
          <p>${{ product.price }}</p>
          <p>{{ product.description }}</p>
          <p>{{ product.category.category_name }}</p>
        </div>
        <div class="ms-auto">
          <button class="btn btn-danger me-md-2" @click="deleteProduct(product)">Delete</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { ref } from 'vue'
import api from "@/views/api.js";

export default {
  data() {
    return {
      cart: []
    };
  },
  mounted() {
    this.loadCart();
  },
  methods: {
    loadCart() {
      this.cart = JSON.parse(localStorage.getItem('cart')) || [];
    },
    product_img_url(filename) {
      return api.imageUrlProduct(filename);
    },
    deleteProduct(product) {
      const index = this.cart.findIndex(item => item.id === product.id);
      if (index !== -1) {
        this.cart.splice(index, 1);
        localStorage.setItem('cart', JSON.stringify(this.cart));
        this.$emit('cart-updated'); // Emit event to parent component (like Navbar)
      }
    }
  }
};
</script>

<style>
/* Your component styles */
</style>

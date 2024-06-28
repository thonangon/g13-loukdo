<template>
    <div>
      <product_slide/>
      <h2 class="text-center mb-4">Welcome to Loukdo Store</h2>
      <search_product @search="handleSearch"/>
      <p class="text-center mb-4">Enjoy finding a million products all over the world here! </p>
      <p class="text-center mb-4">All in ONE!</p>    
      <cards_product :searchQuery="searchQuery"/>
    </div>
  </template>
  
  <script>
  import cards_product from '@/Components/Card/CardComponent.vue'
  import product_slide from '@/Components/Card/ProductSlide.vue'
  import search_product from '@/Components/Search/SearchProduct.vue'
  
  export default {
      components: {
          cards_product,
          product_slide,
          search_product,
      },
      data() {
          return {
              searchQuery: ''
          }
      },
      methods: {
          handleSearch(query) {
              this.searchQuery = query;
          }
      }
  }
  </script>
  
  <style>
  /* Add any custom styles here */
  </style>
  
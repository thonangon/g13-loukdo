<template>
  <div class="container ">
      <div class="card1 d-flex m-4">
        <div class="d-flex justify-content-center align-items-center">
          <img :src="imageProduct(product.image)" style="width: 200px; height: 200px" />
        </div>
        <div class="text1 m-4">
          <h2>{{ product.name }}</h2>
          <p>${{ product.price }}</p>
          <p>{{ product.description }}</p>
        </div>
        <div class="ms-auto">
          <button class="btn btn-danger me-md-2">Delete</button>
        </div>
      </div>
      {{product}}
    </div>
</template>
  
  <script>
  import api from '../../views/api'
  export default {
    name: 'CardComponent',
    props: ['searchQuery', 'product'],
    methods:{
      imageProduct(filename){
        return api.imageUrlProduct(filename)
      }
    }
  }
</script>

<style>

</style>

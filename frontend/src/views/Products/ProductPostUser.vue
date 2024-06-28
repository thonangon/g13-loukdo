<template>
  <form @submit.prevent="createProduct">
    <div class="container bg-light p-4 rounded shadow w-50">
      <div class="mb-3 text-center">
        <h3>Create your products</h3>
        <span>Start posting your product to make money here!</span>
      </div>
      <div class="mb-3 form-row d-flex" style="gap: 10px">
        <div class="form-group flex-grow-1">
          <label for="product-name" class="form-label fw-bold">Name</label>
          <input type="text" class="form-control" id="product-name" placeholder="Product name" v-model="name" required />
          <span style="color:red"> {{errorName}}</span>
        </div>
        <div class="form-group flex-grow-1">
          <label for="product-price" class="form-label fw-bold">Price</label>
          <div class="input-group">
            <span class="input-group-text">$</span>
            <input type="number" class="form-control" id="product-price" placeholder="Price" v-model="price" required />
          </div>
          <span style="color:red">{{errorPrice}}</span>
        </div>
      </div>
      <div class="mb-3">
        <label for="product-quantity" class="form-label fw-bold">Quantity</label>
        <input type="number" class="form-control" id="product-quantity" placeholder="Quantity" v-model="quantity" required />
        <span style="color:red"> {{errorQuantity}}</span>
      </div>
      <div class="mb-3">
        <label for="product-description" class="form-label fw-bold">Description</label>
        <textarea class="form-control" id="product-description" placeholder="Enter details about your product!" v-model="description" required></textarea>
        <span style="color:red"> {{errorDescription}}</span>
      </div>
      <div class="mb-3">
      <label for="product-image" class="form-label fw-bold">Photo</label>
      <div class="d-flex align-items-center">
        <input type="file" class="form-control flex-grow-1" id="product-image" required />
        <button type="submit" class="btn btn-dark ms-3"  :disabled="loading">
          <span v-if="loading" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
          Post
        </button>
      </div>
    </div>
    </div>
  </form>
</template>

<script>
import axios from 'axios'
export default {
  data(){
    return{
      name:'',
      price:'',
      quantity:'',
      description:'',
      image:'',
      loading:false,
      errorName:'',
      errorPrice:'',
      errorQuantity:'',
      errorDescription:'',
      api:{
        createProduct:'http://127.0.0.1:8000/api/products/create'
      }
    }
  },
  watch:{
    name(newName){
      if(!newName){
          this.errorName = 'Add valid product name'
      }
      else{
        this.errorName =null
      }
    },
    price(newPrice){
      if(!newPrice || newPrice <= 0){
        this.errorPrice = 'Enter valid price'
      }
      else{
        this.errorPrice = null
      }
    },
    quantity(newQuantity){
      if(!newQuantity || newQuantity <= 0){
        this.errorQuantity = 'Enter valid quantity'
      }
      else{
        this.errorQuantity = null
      }
    },
    description(newDescription){
      if(!newDescription){
        this.errorDescription = 'Add valid product description'
      }
      else{
        this.errorDescription = null
      }
    }
  },
  methods: {
    async createProduct() {
      try {
        this.loading = true; 
        let response = await axios.post(this.api.createProduct, {
          name: this.name,
          price: this.price,
          quantity: this.quantity,
          description: this.description,
          image: this.image,
        });
        console.log(response);

        
        // Handle the successful response here
        this.loading = false; // Set loading to false after the request is complete
      } catch (error) {
        console.log('Error creating product', error);
        this.loading = false; // Set loading to false in case of an error
      }
    },
  }
}
</script>

<style>
</style>
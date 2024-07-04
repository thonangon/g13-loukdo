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
        <label for="product-quantity" class="form-label fw-bold">Category</label>
        <input type="number" class="form-control" id="product-quantity" placeholder="Category" v-model="category" required />
        <span style="color:red"> {{errorCategory}}</span>
      </div>
      <div class="mb-3">
        <label for="product-description" class="form-label fw-bold">Description</label>
        <textarea class="form-control" id="product-description" placeholder="Enter details about your product!" v-model="description" required></textarea>
        <span style="color:red"> {{errorDescription}}</span>
      </div>
      <div class="mb-3">
        <label for="product-image" class="form-label fw-bold">Photo</label>
        <div class="d-flex align-items-center">
          <input type="file" class="form-control flex-grow-1" id="product-image" @change="handleFileUpload" ref="imageInput" required />
          <button type="submit" class="btn btn-dark ms-3" :disabled="loading">
            <span @click="chargeMoney" v-if="loading" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            Post
          </button>
        </div>
      </div>
    </div>
  </form>
</template>
<script>
import api from '../../views/api';
import { useUserStore } from '@/stores/user.js';

export default {
  data() {
    return {
      category: '',
      name: '',
      price: null,
      quantity: null,
      description: '',
      image: null,
      loading: false,
      errorName: '',
      errorPrice: '',
      errorQuantity: '',
      errorDescription: '',
      errorCategory: '',
      store_user: useUserStore(),
    };
  },
  methods: {
    async createProduct() {
      try {
        this.loading = true;
        const formData = new FormData();
        formData.append('name', this.name);
        formData.append('price', this.price);
        formData.append('quantity', this.quantity);
        formData.append('description', this.description);
        formData.append('image', this.image);
        formData.append('category_id', this.category);
        console.log(this.store_user.tokenUser)

        const token = localStorage.getItem('authToken'); // Assuming you store JWT token in localStorage

        const response = await api.createProduct(formData, {
          headers: {
            'Content-Type': 'multipart/form-data',
            Authorization: `Bearer ${this.store_user.tokenUser}`
          }
        });
        if (response.data.status) {
          // Handle success
          this.$router.push('/'); // Navigate to home page
        } else {
          // Handle error response
          console.error('Error posting product: ', response.data.message);
        }

        console.log('Product created:', response.data);
        this.resetForm();
      } catch (error) {
        console.error('Error creating product:', error);
        if (error.response && error.response.status === 401) {
          console.log('Unauthorized access. Redirecting to login.');
        }
      } finally {
        this.loading = false;
      }
    },
    handleFileUpload(event) {
      this.image = event.target.files[0];
    },
    resetForm() {
      this.name = '';
      this.price = null;
      this.quantity = null;
      this.description = '';
      this.image = null;
    },
    
  },
  watch: {
    name(newName) {
      if (!newName) {
        this.errorName = 'Add valid product name';
      } else {
        this.errorName = null;
      }
    },
    price(newPrice) {
      if (!newPrice || newPrice <= 0) {
        this.errorPrice = 'Enter valid price';
      } else {
        this.errorPrice = null;
      }
    },
    quantity(newQuantity) {
      if (!newQuantity || newQuantity <= 0) {
        this.errorQuantity = 'Enter valid quantity';
      } else {
        this.errorQuantity = null;
      }
    },
    description(newDescription) {
      if (!newDescription) {
        this.errorDescription = 'Add valid product description';
      } else {
        this.errorDescription = null;
      }
    },
    category(newCategory) {
      if (!newCategory || newCategory <= 0) {
        this.errorCategory = 'Select valid category';
      } else {
        this.errorCategory = null;
      }
    }
  },
};

</script>


<style>
</style>
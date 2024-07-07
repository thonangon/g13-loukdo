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
        <label for="product-category" class="form-label fw-bold">Category</label>
        <input type="number" class="form-control" id="product-category" placeholder="Category" v-model="category" required />
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
          <router-link to="/plans">

            <button type="submit" class="btn btn-dark ms-3" :disabled="loading">
              <span v-if="loading" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Post
            </button>
          </router-link>
        </div>
      </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="isProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Please upload your QR code!</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form @submit.prevent="uploadQRimage" enctype="multipart/form-data">
            <div class="modal-body">
              <input type="file" class="form-control" aria-label="Upload" accept="image/*" @change="onFileChange" required />
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    
  </form>
</template>

<script>
import api from '../../views/api';
import axios from 'axios';
import { useUserStore } from '@/stores/user.js';

export default {
  data() {
    return {
      userqr_image: null,
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
      num_products: 0, // Initialize with 0 or retrieve from backend
      canPost: true, // Initially true, will be updated based on num_products
    };
  },
  mounted() {
    this.getuser();
  },
  methods: {
    async getuser() {
      try {
        const response = await axios.get('http://127.0.0.1:8000/api/myaccount', {
          headers: {
            Authorization: `Bearer ${this.store_user.tokenUser}`,
          },
        });
        this.num_products = response.data.user.num_products || 0; // Assuming backend returns num_products
        this.updateCanPost(); // Update canPost based on num_products
      } catch (error) {
        console.error('Error getting user data: ', error);
      }
    },
    async createProduct() {
      try {
        if (!this.canPost) {
          // Redirect to /charge if the user has reached the limit
          this.$router.push('/plans');
          return;
        }
        this.loading = true;
        const formData = new FormData();
        formData.append('name', this.name);
        formData.append('price', this.price);
        formData.append('quantity', this.quantity);
        formData.append('description', this.description);
        formData.append('image', this.image);
        formData.append('category_id', this.category);

        const response = await api.createProduct(formData, {
          headers: {
            'Content-Type': 'multipart/form-data',
            Authorization: `Bearer ${this.store_user.tokenUser}`,
          },
        });
        if (response.data.status) {
          // Successfully posted a product, update num_products and disable button if over limit
          this.num_products++;
          this.updateCanPost();
          this.$router.push('/');
        } else {
          console.error('Error posting product: ', response.data.message);
        }
      } catch (error) {
        console.error('Error creating product:', error);
      } finally {
        this.loading = false;
      }
    },
    handleFileUpload(event) {
      this.image = event.target.files[0];
    },
    updateCanPost() {
      this.canPost = this.num_products < 10; // Disable button if user has posted 10 or more times
    },
    // Other methods for handling file uploads and form validation
  },
  watch: {
    num_products(newNumProducts) {
      this.updateCanPost();
    },
  },
};
</script>

<style>
/* Your styles */
</style>

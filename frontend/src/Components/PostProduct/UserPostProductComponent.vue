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
          <span style="color:red">{{ errorName }}</span>
        </div>
        <div class="form-group flex-grow-1">
          <label for="product-price" class="form-label fw-bold">Price</label>
          <div class="input-group">
            <span class="input-group-text">$</span>
            <input type="number" class="form-control" id="product-price" placeholder="Price" v-model="price" required />
          </div>
          <span style="color:red">{{ errorPrice }}</span>
        </div>
      </div>
      <div class="mb-3">
        <label for="product-quantity" class="form-label fw-bold">Quantity</label>
        <input type="number" class="form-control" id="product-quantity" placeholder="Quantity" v-model="quantity" required />
        <span style="color:red"> {{ errorQuantity }}</span>
      </div>
      <div class="mb-3">
        <label for="product-category" class="form-label fw-bold">Category</label>
        <select class="form-control" id="product-category" v-model="category" required>
          <option value="" hidden>Select a category</option>
          <option v-for="categories in allCate" :key="categories.id" :value="categories.id">{{ categories.category_name }}</option>
        </select>
        <span style="color:red"> {{ errorCategory }}</span>
      </div>
      <div class="mb-3">
        <label for="product-description" class="form-label fw-bold">Description</label>
        <textarea class="form-control" id="product-description" placeholder="Enter details about your product!" v-model="description" required></textarea>
        <span style="color:red"> {{ errorDescription }}</span>
      </div>
      <div class="mb-3">
        <label for="product-image" class="form-label fw-bold">Photo</label>
        <div class="d-flex align-items-center">
          <input type="file" class="form-control flex-grow-1" id="product-image" @change="handleFileUpload" ref="imageInput" required />
          <button type="submit" class="btn btn-dark ms-3" :disabled="loading">
            <span v-if="loading" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Post
          </button>
        </div>
      </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="isProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Please put your QR code!</h5>
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
import { useUserStore } from '@/stores/user.js';

export default {
  data() {
    return {
      allCate: [],
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
      num_products: 0,
      userInfo: {},
    };
  },
  mounted() {
    this.getuser();
    this.getCateList();
  },
  methods: {
    async getCateList() {
      this.num_products = this.store_user.num_products;
      try {
        const response = await api.getAllCate();
        if (response.data.data) {
          this.allCate = response.data.data;
          console.log(this.allCate);
        } else {
          console.error('Error getting category list:', response.data.message);
        }
      } catch (error) {
        console.error('Error getting category list:', error);
      }
    },
    async getuser() {
      try {
        const response = await axios.get('http://127.0.0.1:8000/api/myaccount', {
          headers: {
            Authorization: `Bearer ${this.store_user.tokenUser}`,
            'Content-Type': 'multipart/form-data'
          }
        });
        this.userInfo = response.data.user;
        console.log(this.userInfo);
        post_count= 0,
        canPost= true
      }
      catch (error) {
        console.error('Error getting user data: ', error);
      }
  },
  mounted() {
    this.getUser();
  },
  methods: {
    async getUser() {
      try {
        const response = await api.getUser(this.store_user.tokenUser);
        this.post_count = response.data.user.post_count || 0;
        this.updateCanPost();
      } catch (error) {
        console.error('Error getting user data: ', error);
      }
    },
    async createProduct() {
      try {
        this.loading = true;

        // Check if the user can post
        if (!this.canPost) {
          console.log('User has exceeded the post limit, redirecting to /plans');
          this.$router.push('/plans');
          return;
        }

        // Prepare form data
        const formData = new FormData();
        formData.append('name', this.name);
        formData.append('price', this.price);
        formData.append('quantity', this.quantity);
        formData.append('description', this.description);
        formData.append('image', this.image);
        formData.append('category_id', this.category);

        // API call to create product
        const response = await api.createProduct(formData, {
          headers: {
            'Content-Type': 'multipart/form-data',
            Authorization: `Bearer ${this.store_user.tokenUser}`,
          },
        });

        if (response.data.status) {
          this.post_count++;
          this.updateCanPost();
          this.$router.push('/'); // Redirect to home page after successful product creation
        } else {
          console.error('Error posting product:', response.data.message);
          // Handle specific error messages if needed
        }
      } catch (error) {
        if (error.response && error.response.status === 403) {
          console.error('403 Forbidden:', error.response.data.message);
          this.$router.push('/plans'); // Redirect to payment page on 403 error
        } else {
          console.error('Error creating product:', error);
          // Handle general error
        }
      } finally {
        this.loading = false;
      }
    },
    handleFileUpload(event) {
      this.image = event.target.files[0];
    },
    updateCanPost() {
      this.canPost = this.post_count < 10;
      console.log('Can post:', this.canPost, 'Post count:', this.post_count);
      if (!this.canPost) {
        console.log('Redirecting to /plans');
        this.$router.push('/plans');
      }
    },
  },
  watch: {
    post_count(newPostCount) {
      this.updateCanPost();
    },
  },
}
}
</script>

<style>
/* Your styles */
</style>

<template>
  <div class="container py-4 border border-gray rounded">
    <div class="d-column">
      <div class="d-flex flex-column align-items-center">
        <div class="d-flex justify-content-center mb-4">
          <img :src="imageProduct(product.image)" style="width: 200px; height: 200px" />
        </div>
        <div class="text-center">
          <h2>{{ product.name }}</h2>
          <p>${{ product.price }}</p>
          <p>{{ product.description }}</p>
        </div>
        <div>
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" :data-bs-target="`#`+product.id" data-bs-whatever="@mdo" @click="update_product(product)">Edit</button>
          <button @click="confirmDelete" class="btn btn-danger me-md-2 ms-2">Delete</button>
        </div>
      </div>
    </div>

    <!-- pop up form -->
    <div class="modal fade" :id="product.id" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="ModalLabel">Edit Product</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form>
              <div class="row g-3">
                <div class="col-md-6">
                  <label for="product-name" class="form-label fw-bold">Name</label>
                  <input type="text" class="form-control" id="product-name" placeholder="Product name" v-model="name" required>
                </div>
                <div class="col-md-6">
                  <label for="product-price" class="form-label fw-bold">Price</label>
                  <div class="input-group">
                    <span class="input-group-text">$</span>
                    <input type="number" class="form-control" id="product-price" placeholder="Price" v-model="price" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <label for="product-quantity" class="form-label fw-bold">Quantity</label>
                  <input type="number" class="form-control" id="product-quantity" placeholder="Quantity" v-model="quantity" required>
                </div>
                <div class="col-md-6">
                  <label for="product-category" class="form-label fw-bold">Category</label>
                  <select class="form-control" id="product-category" v-model="category" required>
                    <option value="" hidden>Select a category</option>
                    <option v-for="categories in allCate" :key="categories.id" :value="categories.id">{{ categories.category_name }}</option>
                  </select>
                </div>
                <div class="col-12">
                  <label for="product-description" class="form-label fw-bold">Description</label>
                  <textarea class="form-control" id="product-description" placeholder="Enter details about your product!" v-model="description" required></textarea>
                </div>
                <!-- <div class="col-12">
                  <label for="product-image" class="form-label fw-bold">Product Image</label>
                  <input type="file" class="form-control" id="product-image"  @change="handleFileUpload" required>
                </div> -->
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button @click="updateProduct" type="button" class="btn btn-primary">Save Edit</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import api from '../../views/api';
import { useUserStore } from '@/stores/user.js';

export default {
  name: 'CardComponent',
  props: ['product'],
  data() {
    return {
      userStore: useUserStore(),
      name: '',
      price: '',
      quantity: '',
      category: '',
      description: '',
      // updateImage:'',
      allCate: [],
    };
  },
  mounted() {
    this.getCateList();
  },
  methods: {
    imageProduct(filename) {
      return api.imageUrlProduct(filename);
    },
    confirmDelete() {
      if (confirm('Are you sure you want to delete this product?')) {
        this.deleteProduct(this.product.id);
      }
    },
    async deleteProduct(id) {
      try {
        const response = await api.deleteProduct(id, {
          headers: { Authorization: `Bearer ${this.userStore.tokenUser}` }
        });
        console.log(response);
        console.log(id);

        if (response.status === 200) {
          this.$emit('productDeleted', id);
        } else {
          alert('Failed to delete the product');
        }
      } catch (error) {
        console.error('Error deleting product', error);
      }
    },
    // handleFileUpload(event) {
    //   this.editProduct.image = event.target.files[0];
    // },
    async getCateList() {
      this.num_products = this.store_user;
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
    // get product
    update_product(product) {
      this.id = product.id;
      this.name = product.name;
      this.price = product.price;
      this.quantity = product.quantity;
      this.category = product.category;
      this.description = product.description;
      // console.log(this.name, this.price, this.quantity, this.description)
    },
    async updateProduct() {
      try {
        const id = this.id;
        const data = {
          name: this.name,
          price: this.price,
          quantity: this.quantity,
          category_id: this.category,
          description: this.description
        };
        const response = await api.updateProduct(id, data, this.userStore.tokenUser);
        window.location.href ='/userprodcuts'
        console.log(response);
        console.log(id);

        if (response.status === 200) {
          this.$emit('productUpdated', id); // Changed event to 'productUpdated' to reflect the operation
        } else {
          alert('Failed to update the product');
        }
      } catch (error) {
        console.error('Error updating product', error);
      }
    }
  }
};
</script>

<style>
/* Add your styles here */
</style>

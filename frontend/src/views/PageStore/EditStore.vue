<template>
  <div class="container mt-5 row justify-content-center">
    <div class="p-3 bg-light rounded shadow w-50">
      <div class="card-body">
        <h4 class="card-title text-center mb-2">Update Store</h4>
        <form @submit.prevent="updateStore">
          <div class="form-row d-flex" style="gap: 10px">
            <div class="col mb-3">
              <label for="StoreName" class="form-label">Store Name</label>
              <input
                type="text"
                class="form-control"
                id="StoreName"
                v-model="store.name"
                placeholder="Enter store name"
                required
              />
            </div>
          </div>
          <div class="mb-3">
            <label for="Address" class="form-label">Address</label>
            <input
              type="text"
              class="form-control"
              id="Address"
              v-model="store.address"
              placeholder="Enter address"
              required
            />
          </div>
          <div class="mb-3">
            <label for="Description" class="form-label">Description</label>
            <input
              type="text"
              class="form-control"
              id="Description"
              v-model="store.description"
              placeholder="Enter description"
              required
            />
          </div>
          <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input
              type="file"
              class="form-control"
              id="image"
              @change="onFileChange"
            />
          </div>
          <div class="mb-3 d-flex justify-content-between">
            <router-link to="/Createstore">
              <button type="button" class="btn btn-primary btn-lg" style="width: 120px;">
                Back
              </button>
            </router-link>
            <button type="submit" class="btn btn-dark btn-lg" style="width: 120px;">
              Save
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import api from '../../views/api';
import { useUserStore } from '@/stores/user.js';

export default {
  data() {
    return {
      store: {
        name: '',
        address: '',
        description: '',
        image: null
      },
      userStore: useUserStore(),
    };
  },
  methods: {
    async fetchStore() {
      const storeId = this.$route.params.id;
      try {
        const response = await api.getStore(storeId);
        this.store = response.data.data;
      } catch (error) {
        console.error('API error:', error);
      }
    },
    async updateStore() {
      try {
        const formData ={
          name: this.store.name,
          address: this.store.address,
          description: this.store.description
        }
        console.log(formData);
        console.log(this.userStore.tokenUser);
  
        const storeId = this.$route.params.id;
        const response = await api.updateStore(storeId, formData, {
          headers: {
            'Content-Type': 'multipart/form-data',
            Authorization: `Bearer ${this.userStore.tokenUser}`
          }
        });
        
        console.log('Store updated successfully:', response.data);
        this.$router.push('/Createstore'); // Redirect to the create page
      } catch (error) {
        // if (error.response) {
        //   console.error('Error response:', error.response.data);
        //   console.error('Status code:', error.response.status);
        //   console.error('Headers:', error.response.headers);
        // } else if (error.request) {
        //   console.error('No response received:', error.request);
        // } else {
        //   console.error('Error setting up the request:', error.message);
        // }
        console.error('Error updating store:');
      }
    },
    onFileChange(event) {
      this.store.image = event.target.files[0];
    },
  },
  async created() {
    await this.fetchStore();
  }
};
</script>

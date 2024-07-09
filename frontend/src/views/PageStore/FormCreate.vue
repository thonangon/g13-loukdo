<template>
  <div class="container mt-5 row justify-content-center">
    <div class="p-3 bg-light rounded shadow w-50">
      <div class="card-body">
        <h4 class="card-title text-center mb-2">Create Store</h4>
        <form @submit.prevent="createStore">
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
              required
            />
          </div>
          <div class="mb-3 d-flex justify-content-between">
            <router-link to="/">
              <button type="button" class="btn btn-primary btn-lg" style="width: 120px;">
                Back
              </button>
            </router-link>
            <button type="submit" class="btn btn-dark btn-lg" style="width: 120px;">
              Create
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
      loading: false
    };
  },
  methods: {
    onFileChange(event) {
      this.store.image = event.target.files[0];
    },
    async createStore() {
      this.loading = true;
      try {
        const formData = new FormData();
        formData.append('name', this.store.name);
        formData.append('address', this.store.address);
        formData.append('description', this.store.description);
        formData.append('image', this.store.image);
        const response = await api.createStore(formData, {
          headers: {
            'Content-Type': 'multipart/form-data',
            Authorization: `Bearer ${this.userStore.tokenUser}`
          }
        });

        console.log('Store created successfully:', response.data);
        this.$router.push('/storepage');
      } catch (error) {
        console.error('Error creating store:', error);
        if (error.response && error.response.status === 401) {
          console.log('Unauthorized access. Redirecting to login.');
          this.$router.push('/formCreate'); // Redirect to login if unauthorized
        }
      } finally {
        this.loading = false;
      }
    },
    resetForm() {
      this.store.name = '';
      this.store.address = '';
      this.store.description = '';
      this.store.image = null;
    }
  }
};
</script>

<style>
/* Add your styles here */
</style>

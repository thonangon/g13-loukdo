<template>
  <div class="container mt-5 row justify-content-center">
    <div class="p-3 rounded shadow bg-light w-50">
      <div class="card-body">
        <h4 class="mb-2 text-center card-title">Update Store</h4>
        <form @submit.prevent="updateStore">
          <div class="form-row d-flex" style="gap: 10px">
            <div class="mb-3 col">
              <label for="StoreName" class="form-label">Store Name</label>
              <input type="text" class="form-control" id="StoreName" v-model="store.name" placeholder="Enter store name"
                required />
            </div>
          </div>
          <div class="mb-3">
            <label for="Address" class="form-label">Address</label>
            <input type="text" class="form-control" id="Address" v-model="store.address" placeholder="Enter address"
              required />
          </div>
          <div class="mb-3">
            <label for="Description" class="form-label">Description</label>
            <input type="text" class="form-control" id="Description" v-model="store.description"
              placeholder="Enter description" required />
          </div>
          <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control" id="image" @change="onFileChange" />
          </div>
          <div class="mb-3 d-flex justify-content-between">
            <router-link to="/userStore">
              <button type="button" class="btn btn-primary" style="width: 120px;">
                Back
              </button>
            </router-link>
            <button type="submit" class="btn btn-dark" style="width: 120px;">
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
      userStore: useUserStore(),
      store: {
        name: '',
        address: '',
        description: '',
        image: null
      },
    };
  },
  mounted() {
    this.userStore.loadUser(); 
    console.log("User Token:", this.userStore.tokenUser); 
    this.fetchStore();
  },
  methods: {
    async fetchStore() {
      const storeId = this.$route.params.id;
      console.log("storeId",storeId);
      try {
        const response = await api.getStore(storeId);
        this.store = response.data.data;
        console.log('Store fetched successfully:', this.store);
      } catch (error) {
        console.error('API error:', error);
      }
    },
    async updateStore() {
    try {
      const id = this.store.id; 
      const formData = new FormData();

      formData.append('name', this.store.name);
      formData.append('address', this.store.address);
      formData.append('description', this.store.description);

      if (this.store.image instanceof File) {
        formData.append('image', this.store.image);
      }

      console.log(...formData); 

      const response = await api.updateStore(id, formData, {
        headers: {
          'Content-Type': 'multipart/form-data',
          Authorization: `Bearer ${this.userStore.tokenUser}`,
        }
      });

      if (response.status === 200) {
        console.log('Store updated successfully:', response.data);
        this.$router.push('/userStore'); 
      } else {
        alert('Failed to update the store');
      }
    } catch (error) {
      console.error('Error updating store:', error);
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

<style scoped>
/* Add your styles here */
</style>

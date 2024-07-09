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
            <router-link to="/storepage">
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
import api from '@/views/api';

export default {
  name: 'editStore',
  props: ['id'],
  data() {
    return {
      store: {
        name: '',
        address: '',
        description: '',
        image: null
      }
    };
  },
  async created() {
    try {
      const response = await api.getStore(this.id);
      this.store = response.data; // Ensure this matches the structure of your API response
    } catch (error) {
      console.error('Error fetching store data:', error);
    }
  },
  methods: {
    onFileChange(event) {
      this.store.image = event.target.files[0];
    },
    async updateStore() {
      try {
        const formData = new FormData();
        formData.append('name', this.store.name);
        formData.append('address', this.store.address);
        formData.append('description', this.store.description);
        if (this.store.image) {
          formData.append('image', this.store.image);
        }
        await api.updateStore(this.id, formData);
        this.$router.push('/storepage');
      } catch (error) {
        console.error('Error updating store:', error);
      }
    }
  }
};
</script>

<style>
/* Add your styles here */
</style>

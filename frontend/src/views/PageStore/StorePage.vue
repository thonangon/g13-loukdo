<template>
  <div class="container h-100">
    <div class="d-flex justify-content-center h-100">
      <div class="search">
        <input class="search_input" type="text" name="" placeholder="Search here..." />
        <a href="#" class="search_icon"><i class="fa fa-search"></i></a>
      </div>
    </div>
    <h3 class="text-center mt-4" style="color: teal">Shop Collections</h3>
    <div v-for="store in stores" :key="store.id" class="card mb-4">
      <div class="card-body d-flex m-4">
        <div class="d-flex justify-content-center align-items-center">
          <img
            :src="imageStore(store.image)"
            alt="Store Image"
            style="width: 200px; height: 200px"
          />
        </div>
        <div class="text1 m-4">
          <h2>Store name: {{ store.name }}</h2>
          <h5>My address: {{ store.address }}</h5>
          <p>{{ store.description }}</p>
          <div class="mt-2">
            <router-link
              :to="{ name: 'editStore', params: { id: store.id } }"
              class="btn btn-secondary"
              >Edit</router-link
            >
            <button class="btn btn-danger" @click="deleteStore(store.id)">Delete</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import api from '@/views/api';

export default {
  data() {
    return {
      stores: []
    };
  },
  async created() {
    await this.fetchStores();
  },
  methods: {
    async fetchStores() {
      try {
        const response = await api.getStores();
        this.stores = response.data.data;
      } catch (error) {
        console.error('API error:', error);
      }
    },
    imageStore(filename) {
      return api.imageUrlStore(filename);
    },
    async deleteStore(storeId) {
      try {
        await api.deleteStore(storeId);
        this.stores = this.stores.filter(store => store.id !== storeId);
      } catch (error) {
        console.error('Delete error:', error);
      }
    }
  },
  watch: {
    '$route': 'fetchStores' // Refetch stores whenever the route changes
  }
};
</script>

<style>
.search {
  height: 50px;
  background-color: #fff;
  border-radius: 40px;
  padding: 10px;
  border: 1px solid #000;
}
.search_input {
  color: black;
  border: 0;
  background: none;
  border: white;
}
.search .search_input {
  width: 500px;
  caret-color: black;
}
.search:hover > .search_icon {
  color: #fff;
}
.search_icon {
  margin-top: -4px;
  height: 35px;
  width: 40px;
  float: right;
  display: flex;
  justify-content: center;
  align-items: center;
  border-radius: 50%;
  color: white;
  background-color: black;
}
a:link {
  text-decoration: none;
}
</style>

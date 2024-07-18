<template>
  <div class="container h-auto">
    <!-- Search Bar -->
    <div class="d-flex justify-content-center">
      <div class="search">
        <input class="search_input" type="text" v-model="searchQuery" placeholder="Search here..." @input="performSearch" />
        <a href="#" class="search_icon"><i class="fa fa-search"></i></a>
      </div>
    </div>

    <!-- Create Button -->
    <div class="d-flex justify-content-start mb-3">
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createFormModal">
        Create
      </button>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="createFormModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="createModalLabel">Create Store</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form @submit.prevent="createStore">
              <div class="mb-3">
                <label for="StoreName" class="form-label">Store Name</label>
                <input type="text" class="form-control" id="StoreName" v-model="store.name" placeholder="Enter store name" required />
              </div>
              <div class="mb-3">
                <label for="Address" class="form-label">Address</label>
                <input type="text" class="form-control" id="Address" v-model="store.address" placeholder="Enter address" required />
              </div>
              <div class="mb-3">
                <label for="Description" class="form-label">Description</label>
                <input type="text" class="form-control" id="Description" v-model="store.description" placeholder="Enter description" required />
              </div>
              <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control" id="image" @change="onFileChange" required />
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" @click="createStore">Create</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Store Collection -->
    <h3 class="text-center mt-4" style="color: teal">Shop Collections</h3>
    <div v-if="stores.length > 0" class="stores-container">
      <div v-for="store in filteredStores" :key="store.id" class="card mt-4 ">
        <div class="card-body d-flex m-4">
          <div class="d-flex justify-content-center align-items-center">
            <img :src="imageStore(store.image)" alt="Store Image" style="width: 200px; height: 200px" />
          </div>
          <div class="text1 m-4">
            <h2>Store name: {{ store.name }}</h2>
            <h5>My address: {{ store.address }}</h5>
            <p>{{ store.description }}</p>
            <div class="mt-2">
              <router-link :to="{ name: 'editStore', params: { id: store.id } }" class="btn btn-secondary">Edit</router-link>
              <button class="btn btn-danger" @click="deleteStore(store.id)">Delete</button>
            </div>
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
  data() {
    return {
      store: {
        name: '',
        address: '',
        description: '',
        image: null
      },
      userStore: useUserStore(),
      stores: [],
      loading: false,
      searchQuery: ''
    };
  },
  computed: {
    filteredStores() {
      if (!this.searchQuery) {
        return this.stores;
      }
      const query = this.searchQuery.toLowerCase();
      return this.stores.filter(store =>
        store.name.toLowerCase().includes(query) ||
        store.description.toLowerCase().includes(query)
      );
    }
  },
  methods: {
    async createStore() {
      this.loading = true;
      try {
        const formData = new FormData();
        formData.append('name', this.store.name);
        formData.append('address', this.store.address);
        formData.append('description', this.store.description);
        formData.append('image', this.store.image);

        // window.location.href ='/userprodcuts'
        const response = await api.createStore(formData, {
          headers: {
            'Content-Type': 'multipart/form-data',
            Authorization: `Bearer ${this.userStore.tokenUser}`
          }
        });

        console.log('Store created successfully:', response.data);
        
        $('#createFormModal').modal('hide'); // Close the modal
        
        this.fetchStores(); // Refresh store list
        this.resetForm(); // Reset form fields

      } catch (error) {
        console.error('Error creating store:', error);
        if (error.response && error.response.status === 401) {
          console.log('Unauthorized access. Redirecting to login.');
          this.$router.push('/');
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
    },
    async fetchStores() {
      try {
        const response = await api.getStores();
        this.stores = response.data.data;
      } catch (error) {
        console.error('API error:', error);
      }
    },
    async deleteStore(storeId) {
      try {
        await api.deleteStore(storeId);
        this.stores = this.stores.filter(store => store.id !== storeId);
      } catch (error) {
        console.error('Delete error:', error);
      }
    },
    onFileChange(event) {
      this.store.image = event.target.files[0];
    },
    imageStore(filename) {
      return api.imageUrlStore(filename);
    },
    performSearch() {
      // Delayed fetch after typing
      if (this.timer) {
        clearTimeout(this.timer);
      }
      this.timer = setTimeout(() => {
        this.fetchStores();
      }, 500);
    }
  },
  async created() {
    await this.fetchStores();

    // Auto refresh every 10 seconds
    setInterval(async () => {
      await this.fetchStores();
    }, 10000); // Adjust the interval as needed
  }
};
</script>

<style>
.search {
  margin:10px;
  height: 50px;
  background-color: #fff;
  border-radius: 40px;
  padding: 10px;
  border: 1px solid #000;
}
.search_input {
  color: black;
  border: 0;
  outline: none;
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
/* Media queries for responsiveness */
@media (max-width: 992px) {
 
  .search .search_input {
    width: 300px;
  }
  .card-body{
    flex-direction:row;
  }
  

  .store-image {
    width: 150px;
    height: 150px;
  }
}@media (max-width: 768px) {
 
  .search .search_input {
    width: 200px;
  }
  .button {
    width: 100px;
  }
  .card-body {
    flex-direction: column;
    align-items: center;
    text-align: center;
    /* background-color: pink; */
  }
  .card {
    width: 80%;
    height: 470px;
    margin: 0 auto;
  }
  .store-image {
    width: 80px;
    height: 80px;
  }
  .btn-primary {
    width: 100px;
  }}
</style>


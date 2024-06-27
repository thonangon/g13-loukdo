<template>
  <section class="container">
    <div class="row">
      <div class="col-md-3" v-for="(product, index) in products" :key="index">
        <div class="card mb-3">
          <img :src="product.image" class="card-img-top" alt=" clothe" />
          <p>{{ product.image }}</p>
          <div class="card-body">
            <div class="d-flex align-items-center">
              <div class="d-flex align-items-center" style="height: 60px;">
                  <img src="../../assets/images/Male User.png" alt="User Image" style="height: 50px; width: 43px; margin-right: 10px;">
                   <p class="mb-0">Username</p>
              </div>
            </div>
            <h5>{{ product.name }}</h5>
            <p class="card-text">{{ product.description }}</p>
            <h5>{{ product.price }}</h5>
            <div class="d-flex align-items-center justify-content-between">
              <div class="star-rating" style="font-size: 1.7em;">
                <span>&#9733;</span>
                <span>&#9733;</span>
                <span>&#9733;</span>
                <span>&#9733;</span>
                <span>&#9734;</span>
              </div>
              <router-link v-if="!store_user.accountUser" to="/register" class="btn btn-dark mt-3">Details</router-link>
              <router-link v-else :to="{ name: 'produc_detail', params: { id: product.id} }" class="btn btn-dark mt-3">Details</router-link>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import api from '../../views/api'
import { useUserStore } from '@/stores/user.js';
export default {
  name: 'CardComponent',
  setup() {
    const store_user = useUserStore();
    store_user.loadUser();
    return{
      store_user,
    }
  },

  data() {
    return {
      products: [],
    }
  },
 
  async created() {
    try {
      const response = await api.listProduct()
      if (response.data.status) {
        this.products = response.data.data
      } else {
        console.error('Error fetching products: ', response.data.message)
      }
    } catch (error) {
      console.error('API error: ', error)
    }
  }
}
</script>

<style lang="scss" scoped>
</style>

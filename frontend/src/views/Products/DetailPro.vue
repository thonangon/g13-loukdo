<template>
  <div class="container mt-5">
    <div v-if="productDetails" class="">
      <div class="leftSide" style="width: 48%;">
        <div class="d-flex align-items-center" style="height: 60px;">
          <img src="../../assets/images/Male User.png" alt="User Image" style="height: 50px; width: 43px; margin-right: 10px;">
          <p class="mb-0">{{ productDetails.data.pro_owner.name }}>Owner>{{ productDetails.data.name }}</p>
        </div>
      </div>
      <div class="rightSide p-3 d-flex align-items-center gap-5 bg-light rounded shadow">
        <div class="proImageSlide">
          <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner" style="height: 600px;">
              <div class="carousel-item active">
                <img :src="product_img_url(productDetails.data.image)" class="d-block w-100" style="height: 100%;" alt="...">
              </div>
            </div>
          </div>
        </div>
        <form class="p-5" style="width: 60%;">
          <div class="title">
            <h1>{{ productDetails.data.name }}</h1>
            <h3>${{ productDetails.data.price }}</h3>
          </div>
          <div class="description">
            <h2>DESCRIPTION</h2>
            <p>{{ productDetails.data.description }}</p>
          </div>
          <div class="detail">
            <h2>DETAIL</h2>
            <ul>
              <li class="d-flex">
                <p>Color:</p>
                <p>Black</p>
              </li>
              <li class="d-flex">
                <p>Size:</p>
                <p>S</p>
              </li>
              <li class="d-flex">
                <p>Material:</p>
                <p>Cotton</p>
              </li>
            </ul>
          </div>
          <div class="quantity">
            <h2>QUANTITY</h2>
            <input type="number" v-model="quantity" class="p-4">
          </div>
          <div class="action d-flex justify-content-between mt-5 gap-2">
            <router-link v-if="!store_user.accountUser" to="/login" class="nav-link mr-0 custom-font-size"><button class="btn btn-success" style="width: 270px; height: 52px;">Add to cart!</button></router-link>
            <button v-else type="submit" class="btn btn-success" style="width: 270px; height: 52px;">Add to cart!</button>
            <router-link v-if="!store_user.accountUser" to="/login" class="nav-link mr-0 custom-font-size text-danger"><button class="btn btn-primary" style="width: 270px; height: 52px;">Buy now!</button></router-link>
            <router-link v-else to="/order" class="nav-link mr-0 custom-font-size text-danger">
              <button class="btn btn-primary" style="width: 270px; height: 52px;" @click.prevent="redirectToPayment">Buy now!</button>
            </router-link>
          </div>
          
        </form>
      </div>
    </div>
    <p class="p- mt-5 border-bottom" style="width: 100%;">Ratings and Feedback for this product!</p>
    <div class="RateAndFeedback d-flex">
      <div class="feedback" style="width: 70%;">
        <rate_show :product_id="id" />
        <div v-if="productDetails" class="feedback">
          <div v-for="comment in productDetails.data.comments" :key="comment.id" class="">
            <comment :comment="comment" />
          </div>
        </div>
      </div>
      <div class="cardPro border-start" style="width: 30%">
        <div class="" v-for="(product, index) in products" :key="index">
          <cards_product :product="product" style="width: 90%" />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import api from "@/views/api.js";
import { useUserStore } from "@/stores/user.js";
import rate_show from "@/Components/Card/RateProShow.vue";
import comment from "@/Components/Card/CommentPro.vue";
import cards_product from '@/Components/Card/CardComponent.vue';

export default {
  props: ['id'],
  components: {
    rate_show,
    comment,
    cards_product,
  },
  data() {
    return {
      productDetails: null,
      quantity: 1,
      products: [],
      store_user: useUserStore()
    };
  },
  async mounted() {
    try {
      const productId = this.id;
      const response = await api.detailProduct(productId);
      this.productDetails = response.data.data;
    } catch (error) {
      console.error('Error fetching product details:', error);
    }
  },
  computed: {
    filteredProducts() {
      if (!this.searchQuery) {
        return this.products;
      }
      return this.products.filter(product => 
        product.name.toLowerCase().includes(this.searchQuery.toLowerCase())
      );
    }
  },
  async created() {
    try {
      const response = await api.listProduct();
      if (response.data.status) {
        this.products = response.data.data;
      } else {
        console.error('Error fetching products:', response.data.message);
      }
    } catch (error) {
      console.error('API error: ', error);
    }
  },
  methods: {
    product_img_url(filename) {
      return api.imageUrlProduct(filename);
    },
    redirectToPayment() {
      const orderData = {
        product_id: this.productDetails.data.id,
        quantity: this.quantity,
        price: this.productDetails.data.price,
        total: this.productDetails.data.price * this.quantity,
        delivery: 9.99, 
      };
      localStorage.setItem('orderData', JSON.stringify(orderData));
      this.$router.push('/order');
    }
  }
};
</script>

<style>
/* Your component styles */
</style>

<template>
    <div class="container mt-5">
        <!-- v-for="comment in productDetails.comments" :key="comment.id" -->
        <div v-if="productDetails" class="">
            <div class="leftSide" style="width: 48%;">
                <div class="d-flex align-items-center" style="height: 60px;">
                    <img src="../../assets/images/Male User.png" alt="User Image" style="height: 50px; width: 43px; margin-right: 10px;">
                    <p class="mb-0">{{ productDetails.data.pro_owner.name }}>Owner>{{ productDetails.data.name }}</p>
                </div>
            </div>
            <!-- <p>{{ productDetails }}</p> -->
            <!-- _______________________________________________PPPPPPP_______________________________________________ -->
            <div class="rightSide p-3 d-flex align-items-center gap-5 bg-light rounded shadow">
                <div class="proImageSlide">
                    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner" style="height: 600px;">
                            <div class="carousel-item active">
                                <img :src="product_img_url(productDetails.data.image)" class="d-block w-100" style="height: 100%;" alt="...">
                            </div>
                        </div>
                        <!-- {{ productDetails }} -->
                    </div>
                </div>
                <form class="p-5" style="width: 60%;">
                    <div class="title">
                        <h1>{{productDetails.data.name}}</h1>
                        <h3>${{ productDetails.data.price }}</h3>
                    </div>
                    <div class="description">
                        <h2>DESCRIPTION</h2>
                        <p>{{productDetails.data.description}}</p>
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
                        <input type="number" value="1" class="p-4">
                    </div>
                    <div class="action d-flex justify-content-between mt-5">
                        <button type="button" class="btn btn-secondary" style="width: 280px; height: 52px;">Add to Cart</button>
                        <button type="button" class="btn btn-dark" style="width: 280px; height: 52px;">Buy Now</button>
                    </div>
                </form>
            </div>   
        </div>
        <!-- ______________________________________________PPPPPPPPPPPPP_________________________________ -->
        <p class="p- mt-5 border-bottom" style="width: 100%;">Ratings and Fatback this product!</p>
        <!-- _____________________________________PPPPPPPPPPPPPPP___________________________________ -->
         <div class="RateAndFeadback d-flex">
            <div class="feadback" style="width: 70%;">
                <!-- __________________________________________rate_show________________________________ -->
                <rate_show :product_id="id"/>
                <!-- _________________________________________________________Show feadback______________________________________ -->
                 <div v-if="productDetails" class="feadback">
                    <div v-for="comment in productDetails.data.comments" :key="comment.id" class="">
                        <comment :comment="comment"/>
                    </div>
                 </div>

            </div>
            <!-- ________________________________________PPPPPPPPPPPPPPPPPPPPPPP_____________________________________ -->
            <div class="cardPro border-start" style="width: 30%">
                <div class="" v-for="(product, index) in products" :key="index">
                    <cards_product :product="product" style="width: 90%"/>
                </div>
            </div>
         </div>
    </div>
</template>

<script>
import api from "@/views/api.js";
import { useUserStore } from "@/stores/user.js";
import rate_show from "@/Components/Card/RateProShow.vue"
import comment from "@/Components/Card/CommentPro.vue"
import cards_product from '@/Components/Card/CardComponent.vue'

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
      user_store: useUserStore(),
      products: [],
    };
  },
  async mounted() {
    try {
      const productId = this.id; // Assuming 'id' prop is passed to this component
      const userToken = this.user_store.tokenUser;
      console.log(userToken)

      // Make the API request with authorization headers
      const response = await api.detailProduct(productId, {
        Authorization: `Bearer ${userToken}`
      });

      this.productDetails = response.data.data;
      console.log(this.productDetails)
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
        const response = await api.listProduct()
        if (response.data.status) {
          this.products = response.data.data
        } else {
          console.error('Error fetching products: ', response.data.message)
        }
      } catch (error) {
        console.error('API error: ', error)
      }
    },
  methods:{
    product_img_url(filename){
        return api.imageUrlProduct(filename);
    },
  }
};
</script>

<style>
/* Your component styles */
</style>
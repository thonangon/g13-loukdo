<template>
    <div class="container mt-5">
        <!-- v-for="comment in productDetails.comments" :key="comment.id" -->
        <div v-if="productDetails" class="">
            <div class="leftSide" style="width: 48%;">
                <div class="d-flex align-items-center" style="height: 60px;">
                    <img src="../../assets/images/Male User.png" alt="User Image" style="height: 50px; width: 43px; margin-right: 10px;">
                    <p class="mb-0">{{ productDetails.pro_owner.name }}>Owner>{{ productDetails.name }}</p>
                </div>
            </div>
            <!-- <p>{{ productDetails }}</p> -->
            <!-- _______________________________________________PPPPPPP_______________________________________________ -->
            <div class="rightSide p-3 d-flex align-items-center gap-5 bg-light rounded shadow">
                <div class="proImageSlide">
                    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner" style="height: 600px;">
                            <div class="carousel-item active">
                                <img :src="product_img_url(productDetails.image)" class="d-block w-100" style="height: 100%;" alt="...">
                            </div>
                        </div>
                    </div>
                </div>
                <form class="p-5" style="width: 60%;">
                    <div class="title">
                        <h1>{{productDetails.name}}</h1>
                        <h3>${{ productDetails.price }}</h3>
                    </div>
                    <div class="description">
                        <h2>DESCRIPTION</h2>
                        <p>{{productDetails.description}}</p>
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
                <div class="score" style="height: 200PX;">
                    <div class="rate d-flex">
                        <h1>4.5</h1><h4>/9</h4>
                    </div>
                    <div class="star d-flex">
                        <img src="../../assets/images/star.png" alt="">
                        <img src="../../assets/images/star.png" alt="">
                        <img src="../../assets/images/star.png" alt="">
                        <img src="../../assets/images/star.png" alt="">
                        <img src="../../assets/images/star.png" alt="">
                    </div>
                    <p>5000 score</p>
                </div>
                <div class="rateObtion d-flex justify-content-end border-top border-bottom">
                    <div class="feadback d-flex">
                        <button type="button" class="btn btn-outline-none border-start" data-bs-toggle="modal" data-bs-target="#feadback" data-bs-whatever="@fat">Feadback</button>

                        <div class="modal fade" id="feadback" tabindex="-1" aria-labelledby="feadbackLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="feadbackLabel">Feadback for this product</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form>
                                    <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label">Photo:</label>
                                        <div class="input-group">
                                            <input type="file" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="message-text" class="col-form-label">Message:</label>
                                        <textarea class="form-control" id="message-text" v-model="messagees"></textarea>
                                    </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Send</button>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="star d-flex ">
                        <button class="btn btn-outline-none border-start dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><img src="../../assets/images/star.png" alt="">Rate</button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">5 Star</a></li>
                            <li><a class="dropdown-item" href="#">4 Star</a></li>
                            <li><a class="dropdown-item" href="#">3 Star</a></li>
                            <li><a class="dropdown-item" href="#">2 Star</a></li>
                             <li><a class="dropdown-item" href="#">1 Star</a></li>
                        </ul>
                    </div>
                </div>
                <!-- _________________________________________________________Show feadback______________________________________ -->
                 <div v-if="productDetails" class="feadback">
                    <div v-for="comment in productDetails.comments" :key="comment.id" class="">
                        <div class="d-flex align-items-center" style="height: 60px;">
                            <img src="../../assets/images/Male User.png" alt="User Image" style="height: 50px; width: 43px; margin-right: 10px;">
                            <p class="mb-0">{{ comment.user.name }}:</p>
                        </div>
                        <div class="d-flex flex-column">
                            <p>{{ comment.comment }}.</p>
                            <p class="d-flex">
                                <img :src="imageCommented_url(comment.image)" alt="Comment Image" style="width: 243px; height: 240px;">
                                <small>Posted on: {{ new Date(comment.created_at).toLocaleString() }}</small>
                            </p>
                        </div>
                        <div class="user-actions">
                            <button class="btn btn-primary btn-custom">Like</button>
                            <button class="btn btn-secondary">Reply</button>
                        </div>
                    </div>
                 </div>

            </div>
            <!-- ________________________________________PPPPPPPPPPPPPPPPPPPPPPP_____________________________________ -->
            <div class="cardPro border-start d-flex flex-column align-items-end" style="width: 30%;">
                <div class="card card-custom">
                    <img src="../../assets/images/Group 52.png" class="card-img-top" alt="Product Image" style="width: 300px; height: 300px;">
                    <div class="card-body">
                        <h5 class="card-title">Product Name</h5>
                        <p class="card-text">$99.99</p>
                        <div class="star-rating">
                            <span>&#9733;</span>
                            <span>&#9733;</span>
                            <span>&#9733;</span>
                            <span>&#9733;</span>
                            <span>&#9734;</span>
                        </div>
                    </div>
                </div>
                <div class="card card-custom">
                    <img src="../../assets/images/Group 52.png" class="card-img-top" alt="Product Image" style="width: 300px; height: 300px;">
                    <div class="card-body">
                        <h5 class="card-title">Product Name</h5>
                        <p class="card-text">$99.99</p>
                        <div class="star-rating">
                            <span>&#9733;</span>
                            <span>&#9733;</span>
                            <span>&#9733;</span>
                            <span>&#9733;</span>
                            <span>&#9734;</span>
                        </div>
                    </div>
                </div>
            </div>
         </div>
    </div>
</template>

<script>
import api from "@/views/api.js";
import { useUserStore } from "@/stores/user.js";

export default {
  props: ['id'],
  data() {
    return {
      productDetails: null,
      user_store: useUserStore()
    };
  },
  async mounted() {
    try {
      const productId = this.id; // Assuming 'id' prop is passed to this component
      const userToken = this.user_store.tokenUser;

      // Make the API request with authorization headers
      const response = await api.detailProduct(productId, {
        Authorization: `Bearer ${userToken}`
      });

      this.productDetails = response.data.data;
    } catch (error) {
      console.error('Error fetching product details:', error);
    }
  },
  methods:{
    product_img_url(filename){
        return api.imageUrlProduct(filename);
    },

    imageCommented_url(filename){
        return api.imageComment(filename);
    }
  }
};
</script>

<style>
/* Your component styles */
</style>
<template>
  <div class="">
    <div id="slid-show" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <div class="">
            <div class="row align-items-center">
              <div class="col-md-6">
                <div class="carousel-caption text-center">
                  <h1>Welcome For All Owner Business And Individual For Selling</h1>
                  <p><a class="btn btn-primary btn-lg mt-5" href="/Createstore" role="button">Store</a></p>
                </div>
              </div>
              <div class="col-md-6 position-relative">
                <img src="../../assets/images/cloth.jpg" class="img-fluid" alt="Chair" />
                <span class="discount-badge">54%<br />Discount</span>
              </div>
            </div>
          </div>
        </div>
        <div class="carousel-item">
          <div class="">
            <div class="row align-items-center">
              <div class="col-md-6">
                <div class="carousel-caption text-center">
                  <h1>New Arrivals!</h1>
                  <p class="content">Post for selling everywhere and everytime</p>
                  <p>
                    <a class="btn btn-primary btn-lg mt-5" href="/product" role="button">Explore Now</a>
                  </p>
                </div>
              </div>
              <div class="col-md-6 position-relative">
                <img src="../../assets/images/shoes.jpg" class="img-fluid" alt="Shoes" />
                <span class="discount-badge">30%<br />Off</span>
              </div>
            </div>
          </div>
        </div>
        <div class="carousel-item">
          <div class="container">
            <div class="row align-items-center">
              <div class="col-md-6">
                <div class="carousel-caption text-center">
                  <h1>Second hand Goods!</h1>
                  <p class="content">
                    reducing the cost compared to buying new products, Save money , Encourages users
                    to know about products , where products are reused and recycled rather than
                    discarded.
                  </p>
                  <p>
                    <a class="btn btn-primary btn-lg mt-5" href="/product" role="button">Explore Now</a>
                  </p>
                </div>
              </div>
              <div class="col-md-6 position-relative">
                <img
                  src="../../assets/images/secondhandclothing.jpg"
                  class="img-fluid"
                  alt="Shoes"
                />
                <span class="discount-badge">30%<br />Off</span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <button
        class="carousel-control-prev"
        type="button"
        data-bs-target="#slid-show"
        data-bs-slide="prev"
      >
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button
        class="carousel-control-next"
        type="button"
        data-bs-target="#slid-show"
        data-bs-slide="next"
      >
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>

    <div class="d-flex justify-content-between feature-icons mt-5">
      <div class="col">
        <img src="../../assets/images/box.png" alt="box" />
        <h5>Discount</h5>
        <p>Every week new sales</p>
      </div>
      <div class="col">
        <img src="../../assets/images/delivery-truck.png" alt="delivery" />
        <h5>Free Delivery</h5>
        <p>100% free for all orders</p>
      </div>
      <div class="col">
        <img src="../../assets/images/24-hours.png" alt="24" />
        <h5>Great Support 24/7</h5>
        <p>We care about your experiences</p>
      </div>
      <div class="col">
        <img src="../../assets/images/shield.png" alt="shield" />
        <h5>Secure Payment</h5>
        <p>100% secure payment method</p>
      </div>
    </div>
    
    <div class="mt-5">
      <h3 class="container  border-bottom mb-5">Recently Add New Products</h3>
      <div class="scrollable-container">
        <div class="row">
          <div class="col-md-3 mt-3" v-for="(product, index) in filteredProducts" :key="index">
            <cards_product :searchQuery="searchQuery" :product="product" />
          </div>
        </div>
      </div>
    </div>
    <div>
      <div class="container mt-5">
        <h3>The Popular Categories</h3>
        <categories class="mt-5"/>
      </div>
    </div>

    <div class="mt-5">
      <div class="row align-items-center">
        <div class="col-md-6">
          <div class="text-center">
            <h1>Second hand Goods!</h1>
            <p class="content">
              encourages recycling and reduces waste, promoting a more sustainable lifestyle.
              Small businesses and individuals can reach a wider audience, increasing their chances of selling items.
              Small businesses and thrift stores can expand their market reach and increase revenue through online sales.
              Individuals can earn money by selling items they no longer need, providing an additional source of income.
              Reducing the demand for new products
              Save money 
              Encourages users to know about products, where products are reused and recycled rather than discarded.
            </p>
            <p><a class="btn btn-primary btn-lg mt-5" href="#" role="button">Explore Now</a></p>
          </div>
        </div>
        <div class="container col-md-6 position-relative">
          <img src="../../assets/images/reuse.jpg" class="img-fluid" alt="Shoes" />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import cards_product from '@/Components/Card/CardComponent.vue'
import Categories from '@/Components/Card/CategoriesSlide.vue'
import api from '@/views/api';
import NavBar from '@/Components/navbars/NavBar.vue';
import Footer from '@/Components/footer/FooTer.vue';

export default {
  name: 'HomeView',
  components: {
    cards_product,
    Categories
  },
  data() {
    return {
      products: [],
      searchQuery: ''
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
}
</script>

<style scoped>
/* CSS styles */
body {
  font-family: Arial, sans-serif;
  background-color: #f8f9fa;
}

.carousel-item {
  text-align: center;
  padding: 50px 0;
  background-color: white;
}
.content {
  color: black;
  font-size: 15px;
}
.carousel-caption {
  position: static;
  padding-bottom: 50px;
}

.carousel-caption h1 {
  font-size: 2.5rem;
  font-weight: bold;
  color: black;
}

.carousel-caption p {
  font-size: 1.25rem;
}

.discount-badge {
  position: absolute;
  top: 20px;
  right: 20px;
  background-color: red;
  color: white;
  border-radius: 50%;
  padding: 10px;
  font-size: 1rem;
  text-align: center;
}

.feature-icons {
  background-color: #efe8e865;
  border: 1px solid #ffffff;
  text-align: center;
  border-radius: 20px;
}

.btn-primary {
  background-color: #17a2b8;
  border-color: #17a2b8;
}
.btn-primary:hover {
  background-color: #138496;
  border-color: #117a8b;
}


.scrollable-container {
  height: calc(1.8 * (250px + 0.5rem));
  overflow-y: auto;
  scrollbar-width: thin;
  scrollbar-color: rgba(0, 0, 0, 0.3) rgba(0, 0, 0, 0.1);

  overflow-x: hidden;
}

.scrollable-container::-webkit-scrollbar {
  width: 2px;
} 

.scrollable-container::-webkit-scrollbar-thumb {
  background-color: rgba(0, 0, 0, 0.3);
  border-radius: 4px;
}

.scrollable-container::-webkit-scrollbar-track {
  background-color: rgba(0, 0, 0, 0.1);
  border-radius: 4px;
} 
</style>

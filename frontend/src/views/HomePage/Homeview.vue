<template>

    <div id="slid-show" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <div class="container">
            <div class="row align-items-center">
              <div class="col-md-6">
                <div class="carousel-caption text-center">
                  <h1>Welcome For All Owner Business And Individual For Selling</h1>
                  <p><a class="btn btn-primary btn-lg" href="#" role="button">Shop Now</a></p>
                </div>
              </div>
              <div class="col-md-6 position-relative">
                <img src="../../assets/images/cloth.jpg" class="img-fluid" alt="Chair" />
                <span class="discount-badge">54%<br />Discount</span>
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

    <div class="row feature-icons">
      <div class="col">
        <img src="../../assets/images/box.png" alt="box">
        <h5>Discount</h5>
        <p>Every week new sales</p>
      </div>
      <div class="col">
        <img src="../../assets/images/delivery-truck.png" alt="delivery">
        <h5>Free Delivery</h5>
        <p>100% free for all orders</p>
      </div>
      <div class="col">
        <img src="../../assets/images/24-hours.png" alt="24">
        <h5>Great Support 24/7</h5>
        <p>We care about your experiences</p>
      </div>
      <div class="col">
        <img src="../../assets/images/shield.png" alt="shield">
        <h5>Secure Payment</h5>
        <p>100% secure payment method</p>
      </div>
    </div>
    <div class="container mt-5">
        <h3 >Recently Add New Products</h3>
        <cards_product  class="mt-5" :searchQuery="searchQuery"/>
    </div>
  
</template>
<script>
import  cards_product from '@/Components/Card/CardComponent.vue'
export default {
    name:'HomeView',
    components: {
        cards_product
    },
    data(){
        return {
            
        }
    }
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
</style>

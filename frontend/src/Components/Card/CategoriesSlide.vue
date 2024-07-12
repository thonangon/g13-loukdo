<template>
    <section class="container">
      
      <b-carousel class="d-flex gap-3 "
        id="categoryCarousel"
        controls
        indicators
        background="#ababab"
        
      >
        <b-carousel-slide v-for="(category, index) in categories" :key="index">
          <div class="card h-100 " >
            <img src="../../assets/images/shoes.jpg" class="card-img-top" :alt="category.title">
            <div class="card-body">
              <h5 class="card-title">{{ category.title }}</h5>
              <p class="card-text">{{ category.products }} Products</p>
            </div>
          </div>
        </b-carousel-slide>
      </b-carousel>
    </section>
  </template>
  
  <script>
  export default {
    name: 'TopCategories',
    data() {
      return {
        categories: [
          { title: 'Wing Chair', products: 3584,  },
          { title: 'Wooden Chair', products: 157,  },
          { title: 'Desk Chair', products: 154,},
          { title: 'Desk Chair', products: 154,},
          
        ],
      };
    },
  };
  </script>
  
  <style scoped>
  .card {
    overflow: hidden;
    border-radius: 10px;
  }
  
  .card img {
    height: 200px;
    object-fit: cover;
    border-radius: 10px 10px 0 0;
  }
  </style>
  
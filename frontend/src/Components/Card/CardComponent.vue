<template>
    <section class="container">
      <div class="row justify-content-between">
        <div class="col-md-3" v-for="(product, index) in products" :key="index">
          <div class="card mb-3">
            <img :src="product.image" class="card-img-top" alt="Example clothe" />
            <div class="card-body">
              <div class="d-flex align-items-center mb-2">
                <span class="material-symbols-outlined ">account_circle</span>
                <div class="px-2 rounded font-semibold">{{ product.name }}</div>
              </div>
              <p class="card-text">{{ product.title }}</p>
              <div class="d-flex align-items-center justify-content-between">
                <div class="star-rating">
                    <span class="material-symbols-outlined">star</span>
                    <span class="material-symbols-outlined">star</span>
                    <span class="material-symbols-outlined">star</span>
                    <span class="material-symbols-outlined">star</span>
                    <span class="material-symbols-outlined">star</span>
                  
                </div>
                <a href="" class="btn btn-dark mt-3">Details</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </template>
  
  <script>
  export default {
    name: 'HomeView',
    data() {
      return {
        products: [
          {
            id: 1,
            name: 'Thona',
            title: 'T-Shirt',
            image: 'https://images.nightcafe.studio/jobs/8gONOFn1ruXBxrx9Jsc3/8gONOFn1ruXBxrx9Jsc3--1--9m9d2_2x.jpg?tr=w-1600,c-at_max'
          },
          {
            id: 2,
            name: 'Thonal',
            title: 'T-Shirt',
            image: 'https://images.nightcafe.studio/jobs/8gONOFn1ruXBxrx9Jsc3/8gONOFn1ruXBxrx9Jsc3--1--9m9d2_2x.jpg?tr=w-1600,c-at_max'
          },
          {
            id: 3,
            name: 'Thonal',
            title: 'T-Shirt',
            image: 'https://images.nightcafe.studio/jobs/8gONOFn1ruXBxrx9Jsc3/8gONOFn1ruXBxrx9Jsc3--1--9m9d2_2x.jpg?tr=w-1600,c-at_max'
          },
          {
            id: 4,
            name: 'Thonal',
            title: 'T-Shirt',
            image: 'https://images.nightcafe.studio/jobs/8gONOFn1ruXBxrx9Jsc3/8gONOFn1ruXBxrx9Jsc3--1--9m9d2_2x.jpg?tr=w-1600,c-at_max'
          }
        ]
      };
    }
  };
  </script>
  
  <style scoped>
  .card {
    border: none; /* Remove default card border */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.708); /* Black box shadow */
    transition: transform 0.2s ease, box-shadow 0.2s ease; /* Add smooth transitions */
  }
  
  .card:hover {
    transform: translateY(-15px); /* Lift card on hover */
  }
  </style>
  
<template>
    <section class="container">
      <div class="row">
        <div class="col-md-3" v-for="(product, index) in products" :key="index">
          <div class="card mb-3">
            <img :src="product.image" class="card-img-top" alt="Example clothe" />
            <div class="card-body">
              <div class="d-flex align-items-center">
                <span class="material-symbols-outlined">account_circle</span>
                <div class="px-2 rounded font-semibold">{{ product.name }}</div>
              </div>
              <p class="card-text">{{ product.title }}</p>
              <div class="d-flex align-items-center justify-content-between">
                <div class="star-rating">
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star-half-alt checked"></span>
                  <span class="fa fa-star"></span>
                </div>
                <a href="#" class="btn btn-dark mt-3">Details</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </template>
  
  <script>
  export default {
    name: 'CardComponent',
    data() {
      return {
        products: [
          {
            id: 1,
            name: 'thonal',
            title: 'Example Clothing',
            image:
              'https://images.nightcafe.studio/jobs/8gONOFn1ruXBxrx9Jsc3/8gONOFn1ruXBxrx9Jsc3--1--9m9d2_2x.jpg?tr=w-1600,c-at_max'
          },
          {
            id: 2,
            name: 'thonal',
            title: 'Example Clothing',
            image:
              'https://images.nightcafe.studio/jobs/8gONOFn1ruXBxrx9Jsc3/8gONOFn1ruXBxrx9Jsc3--1--9m9d2_2x.jpg?tr=w-1600,c-at_max'
          },
          {
            id: 3,
            name: 'thonal',
            title: 'Example Clothing',
            image:
              'https://images.nightcafe.studio/jobs/8gONOFn1ruXBxrx9Jsc3/8gONOFn1ruXBxrx9Jsc3--1--9m9d2_2x.jpg?tr=w-1600,c-at_max'
          },
          {
            id: 4,
            name: 'thonal',
            title: 'Example Clothing',
            image:
              'https://images.nightcafe.studio/jobs/8gONOFn1ruXBxrx9Jsc3/8gONOFn1ruXBxrx9Jsc3--1--9m9d2_2x.jpg?tr=w-1600,c-at_max'
          }
        ]
      };
    }
  };
  </script>
  
  <style scoped>
  /* Add any component-specific styles here */
  </style>
  
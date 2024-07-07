<template>
    <div class="container mt-4">
      <div class="row">
        <!-- Left Side: Product Cards -->
        <div class="col-lg-4">
          <div class="card mb-4 shadow-sm">
            <div class="card-header bg-primary text-white">
              Current Order
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item" v-for="item in currentOrder" :key="item.id">
                {{ item.name }} - {{ item.quantity }}
              </li>
            </ul>
          </div>
          
                  <!-- Right Side: Current Order and Past Order -->
          <div class="card shadow-sm">
            <div class="card-header bg-secondary text-white">
              Past Order
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item col" v-for="item in pastOrder" :key="item.id">
                {{ item.name }} - {{ item.quantity }}
              </li>
            </ul>
          </div>
        </div>

        <div class="col-lg-8">
          <div class="row g-4">
            <div class="col-md-6 col-lg-4" v-for="product in products" :key="product.id">
              <div class="card h-100 shadow-sm">
                <img :src="product.image" class="card-img-top" alt="Product Image">
                <div class="card-body d-flex flex-column">
                  <h5 class="card-title">{{ product.name }}</h5>
                  <p class="card-text">{{ product.description }}</p>
                  <div class="mt-auto">
                    <a href="#" class="btn btn-primary w-100">View Product</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  

  <script>
  export default {
    data() {
      return {
        products: [
          { id: 1, name: 'Product 1', description: 'Description for product 1', image: 'https://via.placeholder.com/150' },
          { id: 2, name: 'Product 2', description: 'Description for product 2', image: 'https://via.placeholder.com/150' },
          { id: 3, name: 'Product 3', description: 'Description for product 3', image: 'https://via.placeholder.com/150' },
          // Add more products as needed
        ],
        currentOrder: [
          { id: 1, name: 'Product A', quantity: 2 },
          { id: 2, name: 'Product B', quantity: 1 },
          // Add more current order items as needed
        ],
        pastOrder: [
          { id: 1, name: 'Product C', quantity: 1 },
          { id: 2, name: 'Product D', quantity: 3 },
          // Add more past order items as needed
        ]
      }
    }
  }
  </script>
  

  <style scoped>
  .card {
    width: 100%;
  }
  </style>
  
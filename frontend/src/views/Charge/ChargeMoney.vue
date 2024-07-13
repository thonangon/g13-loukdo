<template>
  <div class="plans">
    <div class="container py-5">
      <div class="d-flex gap-3 align-items-center text-center justify-content-center flex-wrap">
        <!-- Display Free Plan -->
        <div class="plan bg-white p-5 rounded-lg shadow mb-4">
          <h1 class="h6 text-uppercase font-weight-bold mb-4">FREE</h1>
          <h2 class="h1 font-weight-bold">$0<span class="text-small font-weight-normal ml-2">/ free</span></h2>
          <div class="custom-separator my-4 mx-auto bg-primary"></div>
          <ul class="list-unstyled my-5 text-small text-left">
            <li class="mb-3">
              <i class="fas fa-check-circle mr-2 text-primary"></i> User can post the product at least 9 posts
            </li>
            <li class="mb-3">
              <i class="fas fa-check-circle mr-2 text-primary"></i> You need to pay to use the basic pro and Premium product
            </li>
            <li class="mb-3">
              <i class="fas fa-check-circle mr-2 text-primary"></i> Allow only product to be used at this time and at least 9 posts
            </li>
          </ul>
          <button class="btn btn-primary btn-block shadow rounded-pill">Buy Now</button>
        </div>
        <!-- Display Other Plans -->
        <div class="plan bg-white p-5 rounded-lg shadow mb-4" v-for="plan in plans" :key="plan.name">
          <h1 class="h6 text-uppercase font-weight-bold mb-4">{{ plan.name }}</h1>
          <h2 class="h1 font-weight-bold">{{ plan.price }}<span class="text-small font-weight-normal ml-2">/ month</span></h2>
          <div class="custom-separator my-4 mx-auto bg-primary"></div>
          <ul class="list-unstyled my-5 text-small text-left">
            <li class="mb-3" v-for="feature in plan.features" :key="feature">
              <i class="fas fa-check-circle mr-2 text-primary"></i>{{ feature }}
            </li>
          </ul>
          <router-link :to="{ name: '/charge', params: { selectedPlan: plan }}">
            <button class="btn btn-primary btn-block shadow rounded-pill">Buy Now</button>
          </router-link>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { loadStripe } from '@stripe/stripe-js';
import api from '../api';

export default {
  data() {
    return {
        plans: [
        { name: 'Basic', price: "$15", features: ['Unlimited product posts', 'Charge if posts exceed 10', 'Easy and continuous posting'] },
        { name: 'Premium', price: "$50", features: ['Unlimited product posts', 'No additional charges for unlimited posts', '2.5% discount every month', 'Additional premium features'] }
      ]
    };
  },
  
  
};
</script>

<style scoped>
.plans {
  background: #f8f9fa;
  padding: 50px 0;
}

.plan {
  width: 320px; 
  height: 84vh;
  border-radius: 10px;
  transition: transform 0.3s ease;
}

.plan:hover {
  transform: scale(1.05);
}

.custom-separator {
  width: 50px;
  height: 4px;
  background-color: #007bff;
  margin: 20px auto;
}

.card-element {
  padding: 10px;
  border: 1px solid #e6e6e6;
  border-radius: 4px;
}

#card-errors {
  color: red;
  margin-top: 10px;
}
</style>

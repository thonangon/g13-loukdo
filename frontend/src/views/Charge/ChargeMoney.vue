<template>
  <div class="container my-5">
    <div class="row text-center">
      <div class="col-12 mb-5">
        <h2>Choose your plan</h2>
      </div>
    </div>
    <div class="row justify-content-center">
      <div 
        class="col-md-4 mb-4" 
        v-for="(plan, index) in plans" 
        :key="index"
      >
        <div 
          class="card plan-card h-100" 
          :class="{ 'recommended': plan.recommended }"
        >
          <div v-if="plan.recommended" class="card-header text-center">
            Recommended
          </div>
          <div class="card-body text-center">
            <h5 class="card-title" :class="{ 'text-success': plan.recommended }">{{ plan.title }}</h5>
            <h6 class="card-subtitle mb-2 text-muted">{{ plan.price }}</h6>
            <p class="card-text">{{ plan.description }}</p>
            <router-link to="/charge">
              <button 
                class="btn w-100" 
                :class="plan.recommended ? 'btn-success' : 'btn-outline-primary'"
              >
                Get this plan
              </button>
            </router-link>

          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { loadStripe } from '@stripe/stripe-js';
import api from '../api';

export default {
  name: 'PricingPlans',
  data() {
    return {
      plans: [
        {
          title: 'Free',
          price: '$0 per month',
          description: 'Freer for you to post the post of 10 produt first',
          recommended: false
        },
        {
          title: 'Standard',
          price: '$9.99 /10 posts',
          description: 'Unlimited product posts, Charge if posts exceed 10, Easy and continuous posting',
          recommended: true
        },
        {
          title: 'Pro',
          price: '$19.99 per month',
          description: 'Unlimited product posts, No additional charges for unlimited posts, 2.5% discount every month, Additional premium features',
          recommended: false
        }
      ]
    };
  }
};
</script>

<style scoped>
body {
  font-family: 'Montserrat', sans-serif;
}
.plan-card {
  border-radius: 15px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  transition: transform 0.2s, box-shadow 0.2s;
  padding: 1rem;
}

.plan-card:hover {
  transform: scale(1.1);
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

.recommended {
  border: 2px solid #28a745;
  position: relative;
}

.recommended .card-header {
  background-color: #28a745;
  color: white;
  font-size: 1rem;
  border-radius: 15px 15px 0 0;
  position: absolute;
  top: -1.5rem;
  left: 50%;
  transform: translateX(-50%);
  padding: 0.5rem 1rem;
}

.card-title {
  font-size: 1.5rem;
  margin-top: 2.5rem; /* Adjusted to make space for the header */
}

.card-subtitle {
  font-size: 1.25rem;
  margin-bottom: 1rem;
  color: #666;
}

.card-text {
  margin-bottom: 1.5rem;
  color: #666;
}

.btn {
  border-radius: 25px;
  padding: 0.75rem 1rem;
}

.btn-outline-primary {
  border-color: #007bff;
  color: #007bff;
  border: 2px solid #28a745;
  position: relative;
  color: #28a745;
}

.btn-outline-primary:hover {
  background-color: #28a745;
  color: white;
}

.btn-success {
  background-color: #28a745;
  color: white;
  border: none;
}

.btn-success:hover {
  background-color: #218838;
}
</style>

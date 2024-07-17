<template>
  <div class="container ">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="step-indicator">
          <span class="step-number">1</span>
          <span class="step-separator"></span>
          <span class="step-number">2</span>
          <span class="step-separator"></span>
          <span class="step-number">3</span>
        </div>
        <h2 class="text-center my-4">Choose your plan</h2>
        <div class="row">
          <div class="col-md-4" v-for="(plan, index) in plans" :key="index">
            <div class="card plan-card h-100" :class="{ recommended: plan.recommended }">
              <div v-if="plan.recommended" class="card-header text-center">Recommended</div>
              <div class="card-body text-center">
                <h2 class="card-title" :class="{ 'text-success': plan.recommended }">
                  {{ plan.title }}
                </h2>
                <h1 class="card-subtitle mb-2">{{ plan.price }}</h1>
                <p class="card-text">{{ plan.description }}</p>
                <router-link to="/charge">
                  <button class="btn w-100" :class="plan.recommended ? 'btn-success' : 'btn-outline-primary'" >
                    Get this plan
                  </button>
                </router-link>
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
      plans: [
        {
          title: 'Free',
          price: '$0',
          description: 'Freer for you to post the post of 10 produt first',
          recommended: false
        },
        {
          title: 'Standard',
          price: '$10 per 10 posts',
          description:
            'Unlimited product posts, Charge if posts exceed 10, Easy and continuous posting still 20 posts',
          recommended: true
        },
        {
          title: 'Pro',
          price: '$20 per month',
          description:
            'Unlimited product posts, No additional charges for unlimited posts, 2.5% discount every month, Additional premium features',
          recommended: false
        }
      ],
      selectedPlan: null
    }
  },
  
}
</script>

<style scoped>
body {
  font-family: 'Arial', sans-serif;
}
.step-indicator {
  display: flex;
  justify-content: center;
  align-items: center;
  margin-bottom: 20px;
}

.step-number {
  background-color: #fff;
  border: 2px solid #28a745;
  border-radius: 50%;
  width: 30px;
  height: 30px;
  display: flex;
  justify-content: center;
  align-items: center;
  font-size: 1.2em;
  color: #28a745;
}

.step-separator {
  width: 50px;
  height: 2px;
  background-color: #28a745;
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
  position: relative;
  top: -1.5rem;
  left: 50%;
  transform: translateX(-50%);
}

.card-title {
  font-size: 1.7rem;
  margin-top: 2.5rem;
}

.card-subtitle {
  font-size: 2rem;
  margin-bottom: 1rem;
  color: black;
}



.btn {
  border-radius: 25px;
  padding: 0.75rem 1rem;
}

.btn-outline-primary {
  border-color: #28a745;
  color:  #28a745;
}

.btn-outline-primary:hover {
  background-color: #007bff;
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

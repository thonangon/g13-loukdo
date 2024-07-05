<template>
    <div class="plans">
      <div class="container py-5">
          <div class="row text-center align-items-end">
          <!-- Display Free Plan -->
          <div class="col-lg-4 mb-5 mb-lg-0">
            <div class=" plan bg-white p-5 rounded-lg shadow">
              <h1 class="h6 text-uppercase font-weight-bold mb-4">FREE</h1>
              <h2 class="h1 font-weight-bold">$0<span class="text-small font-weight-normal ml-2">/ free</span></h2>
  
              <div class="custom-separator my-4 mx-auto bg-primary"></div>
  
              <ul class="list-unstyled my-5 text-small text-left">
                <li class="mb-3">
                  <i class="fa fa-check mr-2 text-primary"></i> Lorem ipsum dolor sit amet
                </li>
                <li class="mb-3">
                  <i class="fa fa-check mr-2 text-primary"></i> Sed ut perspiciatis
                </li>
                <li class="mb-3">
                  <i class="fa fa-check mr-2 text-primary"></i> At vero eos et accusamus
                </li>
                <li class="mb-3 text-muted">
                  <i class="fa fa-times mr-2"></i>
                  <del>Nam libero tempore</del>
                </li>
                <li class="mb-3 text-muted">
                  <i class="fa fa-times mr-2"></i>
                  <del>Sed ut perspiciatis</del>
                </li>
                <li class="mb-3 text-muted">
                  <i class="fa fa-times mr-2"></i>
                  <del>Sed ut perspiciatis</del>
                </li>
              </ul>
                <button class="btn btn-primary btn-block shadow rounded-pill">Buy Now</button>
              
            </div>
          </div>
  
          <!-- Display Paid Plans -->
          <div v-for="plan in plans" :key="plan.id" class="  col-lg-4 mb-5 mb-lg-0">
            <div class="plan bg-white p-5 rounded-lg shadow">
              <h1 class="h6 text-uppercase font-weight-bold mb-4">{{ plan.name }}</h1>
              <h2 class="h1 font-weight-bold">${{ plan.price }}<span class="text-small font-weight-normal ml-2">/ month</span></h2>
  
              <div class="custom-separator my-4 mx-auto bg-primary"></div>
  
              <ul class="list-unstyled my-5 text-small text-left font-weight-normal">
                <li class="mb-3">
                  <i class="fa fa-check mr-2 text-primary"></i> Lorem ipsum dolor sit amet
                </li>
                <li class="mb-3">
                  <i class="fa fa-check mr-2 text-primary"></i> Sed ut perspiciatis
                </li>
                <li class="mb-3">
                  <i class="fa fa-check mr-2 text-primary"></i> At vero eos et accusamus
                </li>
                <li class="mb-3">
                  <i class="fa fa-check mr-2 text-primary"></i> Nam libero tempore
                </li>
                <li class="mb-3">
                  <i class="fa fa-check mr-2 text-primary"></i> Sed ut perspiciatis
                </li>
                <li class="mb-3 text-muted">
                  <i class="fa fa-times mr-2"></i>
                  <del>Sed ut perspiciatis</del>
                </li>
              </ul>
              <a href="/payment">
                <button class="btn btn-primary btn-block shadow rounded-pill">Buy Now</button>
              </a>
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
        plans: []
      };
    },
    mounted() {
      // Fetch plans data from API or Vuex store on component mount
      this.fetchPlans();
    },
    methods: {
      fetchPlans() {
        // Simulated data for demonstration
        this.plans = [
          { id: 1, name: 'Basic Plan', price: 29, slug: 'basic-plan' },
          { id: 2, name: 'Pro Plan', price: 49, slug: 'pro-plan' },
          
        ];
        // Replace with actual API call to fetch plans
        // axios.get('/api/plans')
        //   .then(response => {
        //     this.plans = response.data.plans;
        //   })
        //   .catch(error => {
        //     console.error('Error fetching plans:', error);
        //   });
      }
    }
  };
  </script>
  
  <style scoped>
  /* Your component-specific styles */
  .plan{
    border-radius: 10px;
  }
  </style>
  
<template>
  <div class="plans">
    <div class="container py-5">
      <div class="d-flex gap-3 align-items-center text-center">
        
        <!-- Display Free Plan -->
        <div class="plan bg-white p-5 rounded-lg shadow mb-4">
          <h1 class="h6 text-uppercase font-weight-bold mb-4">FREE</h1>
          <h2 class="h1 font-weight-bold">$0<span class="text-small font-weight-normal ml-2">/ free</span></h2>
          <div class="custom-separator my-4 mx-auto bg-primary"></div>
          <ul class="list-unstyled my-5 text-small text-left">
            <li class="mb-3">
              <i class="fa fa-check mr-2 text-primary"></i> User can post the product at least 9 posts
            </li>
            <li class="mb-3">
              <i class="fa fa-check mr-2 text-primary"></i> You need to pay to us if you want to use the basic pro and Premium product
            </li>
            <li class="mb-3">
              <i class="fa fa-check mr-2 text-primary"></i> Allow the only product to be used at this time and at least 9 posts
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

        <!-- Display Basic Plan -->
        <div class="plan bg-white p-5 rounded-lg shadow mb-4">
          <h1 class="h6 text-uppercase font-weight-bold mb-4">Basic class</h1>
          <h2 class="h1 font-weight-bold">$10<span class="text-small font-weight-normal ml-2">/ month</span></h2>
          <div class="custom-separator my-4 mx-auto bg-primary"></div>
          <ul class="list-unstyled my-5 text-small text-left font-weight-normal">
            <li class="mb-3">
              <i class="fa fa-check mr-2 text-primary"></i> You can post your items that you want
            </li>
            <li class="mb-3">
              <i class="fa fa-check mr-2 text-primary"></i> We will charge your money if you post over 10 products
            </li>
            <li class="mb-3">
              <i class="fa fa-check mr-2 text-primary"></i> Easy to use for posting the product and can continue to post after charge
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

        <!-- Display Premium Plan -->
        <div class="plan bg-white p-5 rounded-lg shadow mb-4">
          <h1 class="h6 text-uppercase font-weight-bold mb-4">Premium</h1>
          <h2 class="h1 font-weight-bold">$100<span class="text-small font-weight-normal ml-2">/ month</span></h2>
          <div class="custom-separator my-4 mx-auto bg-primary"></div>
          <ul class="list-unstyled my-5 text-small text-left font-weight-normal">
            <li class="mb-3">
              <i class="fa fa-check mr-2 text-primary"></i> You can post your items that you want
            </li>
            <li class="mb-3">
              <i class="fa fa-check mr-2 text-primary"></i> You can post unlimited items that you want if you charge per month
            </li>
            <li class="mb-3">
              <i class="fa fa-check mr-2 text-primary"></i> We will give you a discount every month 2.5%
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
</template>

<script>
export default {
  data() {
    return {};
  },
};
</script>

<style scoped>
.plan {
  border-radius: 10px;
}

</style>

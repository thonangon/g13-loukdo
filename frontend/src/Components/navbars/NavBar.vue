<template>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <div class="d-flex w-100 justify-content-between align-items-center">
        <!-- Empty div to push the logo to the center -->
        <div class="d-flex" style="width: 40%;">
          <div class="d-flex me-auto">
            <!-- <p class="me-5 mb-0">Products</p> -->
            <router-link to="/" class="me-5 mb-0">
              Products
            </router-link>
            <div class="dropdown me-5">
              <a class="text-dark" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">Categories</a>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
              </ul>
            </div>
            <p class="me-5 mb-0">More...</p>
          </div>
        </div>
        <!-- Logo -->
        <a class="navbar-brand mx-auto" href="#">
          <img class="ms-auto" src="../../assets/images/lOUKDO.png" alt="Logo">
        </a>
        <!-- Profile -->
        <div class="d-flex justify-content-end align-items-center" style="width: 40%;">
          <a class="nav-link mr-0" href="#">Login</a>
          <img src="../../assets/images/Male User.png" alt="">
        </div>
      </div>
    </div>
  </nav>

</template>

<script>
export default {

}
</script>

<style>

</style>
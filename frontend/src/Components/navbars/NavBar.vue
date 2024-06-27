<template>
  <div class="navbar-shadow sticky-xl-top mb-5">
    <div class="container">
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
          <div class="d-flex w-100 justify-content-between align-items-center">
            <!-- Empty div to push the logo to the center -->
            <div class="d-flex" style="width: 40%;">
              <div class="d-flex me-auto">
                <!-- <p class="me-5 mb-0">Products</p> -->
                <router-link to="/" class="me-5 mb-0 custom-font-size nav-link" active-class="active text-primary border-bottom">Products</router-link>
                <div class="dropdown me-5 custom-font-size">
                  <a class="text-dark custom-font-size nav-link" active-class="active text-primary border-bottom" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">Categories</a>
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <router-link to="/register" class="me-5 mb-0 dropdown-item custom-font-size">Register</router-link>
                    <li><a class="dropdown-item custom-font-size" href="#">Another action</a></li>
                    <li><a class="dropdown-item custom-font-size" href="#">Something else here</a></li>
                  </ul>
                </div>
                <router-link to="/product/create" class="me-5 mb-0 custom-font-size nav-link" active-class="active text-primary border-bottom">More...</router-link>
              </div> 
            </div>
            <!-- Logo -->
            <a class="navbar-brand mx-auto" href="#">
              <img class="ms-auto" src="../../assets/images/lOUKDO.png" alt="Logo">
            </a>
            <!-- Profile -->
            <div class="d-flex justify-content-end align-items-center" style="width: 40%;">
              <router-link v-if="!store_user.accountUser" to="/login" class="nav-link mr-0 custom-font-size">Login</router-link>
              <h5 v-else-if="store_user.accountUser" class="mb-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">{{ store_user.accountUser.name.toUpperCase() }}</h5>
              
              <div class="">
                <img class="dropdown-toggle" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false" src="../../assets/images/Male User.png" alt="">
                <div class="dropdown">
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <router-link class="dropdown-item" active-class="active" exact to="/profile">Profile</router-link>
                    <button class="dropdown-item" @click="logout">Logout</button>
                  </ul>

                </div>
            </div>
              
            </div>
          </div>
        </div>
      </nav>
    </div>
  </div>

</template>

<script>

import { useUserStore } from '@/stores/user.js';
import axios from 'axios';

export default {
  setup() {
    const store_user = useUserStore();
    store_user.loadUser(); // Ensure user data is loaded from localStorage

    const logout = async () => {
      try {
        await axios.post('http://127.0.0.1:8000/api/logout', {}, {
          headers: {
            Authorization: `Bearer ${store_user.tokenUser}`
          }
        });
        store_user.logout();
        window.location.href = '/'; // Redirect to login page after logout
      } catch (error) {
        console.error('Logout failed:', error);
      }
    };

    return {
      store_user,
      logout,
    };
  },
};
</script>

<style>
.custom-font-size {
  font-size: 20px;
  transition: color 0.3s, font-size 0.3s;
  font-size: 18px;
}
.custom-font-size:hover {
  color: blue; /* Change text color to blue on hover */
  font-size: 20px;
}
.navbar-shadow {
  box-shadow: 0 4px 2px -2px rgba(0, 0, 0, 0.1);
}
.dropdown-item {
    transition: color 0.3s, font-size 0.3s; /* Smooth transition for color and font-size */
    font-size: 18px; /* Default font size */
    color: black; /* Default text color */
}
.dropdown-item:hover {
    color: blue; /* Change text color to blue on hover */
    font-size: 20px; /* Increase font size on hover */
}

</style>
<template>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <div class="d-flex w-100 justify-content-between align-items-center">
        <!-- Empty div to push the logo to the center -->
        <div class="d-flex" style="width: 40%;">
          <div class="d-flex me-auto">
            <router-link to="/" class="me-5 mb-0">Products</router-link>
            <div class="dropdown me-5">
              <a class="text-dark" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">Categories</a>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <router-link to="/register" class="me-5 mb-0 dropdown-item">Register</router-link>
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
          <router-link v-if="!store_user.accountUser" to="/login" class="nav-link mr-0">Login</router-link>
          <router-link v-else class="nav-link mr-0">{{ store_user.accountUser.name }}</router-link>
          
          <div>
            <img class="dropdown-toggle" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false" src="../../assets/images/Male User.png" alt="">
            <div class="dropdown">
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li>
                      <a class="dropdown-item" @click="profile">Profile</a>
                    </li>
                    <li>
                      <button class="dropdown-item" @click="logout">Logout</button>
                    </li>
                </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>
</template>


<script>
import { useUserStore } from '@/stores/user.js';
import axios from 'axios';
import { ref, onMounted } from 'vue';
import { useRouter } from 'vue-router';

export default {
  setup() {
    const store_user = useUserStore();
    const router = useRouter();

    onMounted(() => {
      store_user.loadUser(); // Ensure user data is loaded from localStorage
    });

    const logout = async () => {
      try {
        await axios.post('http://127.0.0.1:8000/api/logout', {}, {
          headers: {
            Authorization: `Bearer ${store_user.tokenUser}`
          }
        });
        store_user.logout();
        window.location.href = '/product_detail'; // Redirect to login page after logout
      } catch (error) {
        console.error('Logout failed:', error);
      }
    };

    const profile = () => {
      if (store_user.accountUser === null) {
        router.push('/register');
      } else {
        router.push('/profile');
      }
    };

    return {
      store_user,
      logout,
      profile,
    };
  }
};
</script>

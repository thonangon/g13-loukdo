<template>
  <div class="navbar-shadow sticky-xl-top mb-5">
    <div class="container">
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <div class="d-flex w-100 justify-content-between align-items-center">
              <!-- Left side of the navbar -->
              <div class="d-flex flex-grow-1">
                <router-link to="/" class="me-5 mb-0 custom-font-size nav-link" active-class="active text-primary border-bottom">Home</router-link>
                <router-link to="/product" class="me-5 mb-0 custom-font-size nav-link" active-class="active text-primary border-bottom">Products</router-link>
                <div class="dropdown me-5 custom-font-size">
                  <a class="text-dark custom-font-size nav-link" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">Categories</a>
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <router-link to="/register" class="dropdown-item custom-font-size">Register</router-link>
                    <router-link to="/profile" class="dropdown-item custom-font-size">profile</router-link>
                    <li><a class="dropdown-item custom-font-size" href="#">Another action</a></li>
                    <li><a class="dropdown-item custom-font-size" href="#">Something else here</a></li>
                  </ul>
                </div>
                <router-link to="/product-post" class="me-5 mb-0 custom-font-size nav-link" active-class="active text-primary border-bottom">More...</router-link>
              </div>


              
              <!-- Logo -->
              <a class="navbar-brand mx-auto logo" href="#">
                <img class="ms-auto logo-img" src="../../assets/images/lOUKDO.png" alt="Logo">
              </a>
              <!-- Profile -->
              <div class="d-flex justify-content-end align-items-center profile-section" style="width: 40%;">
                <router-link v-if="!store_user.accountUser" to="/login" class="nav-link mr-0 custom-font-size">Login</router-link>
                <div v-else class="dropdown d-flex align-items-center profile-container" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                  <img :src="profileImageUrl" class="profile-img" alt="">
                  <span class="profile-name">{{ store_user.accountUser.name.toUpperCase() }}</span>
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <router-link v-if="!store_user.accountUser" class="dropdown-item" active-class="active" exact to="/register">Profile</router-link>
                    <router-link v-else class="dropdown-item" active-class="active" exact to="/profile">Profile</router-link>
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
import { computed } from 'vue';

export default {
  setup() {
    const store_user = useUserStore();
    store_user.loadUser(); // Ensure user data is loaded from localStorage
    // onMounted(() => {
    //   store_user.loadUser(); // Ensure user data is loaded from localStorage
    // });

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

    const profileImageUrl = computed(() => {
      if (store_user.accountUser && store_user.accountUser.name) {
        const name = store_user.accountUser.name;
        const initials = `${name[0]}${name[name.length - 1]}`.toUpperCase();
        return `https://dummyimage.com/100x100/000/fff&text=${initials}`;
      }
      return '../../assets/images/Male User.png';
    });

    return {
      store_user,
      logout,
      profileImageUrl,
    };
  }
};
</script>

<style>
.profile-container {
  position: relative;
  display: flex;
  align-items: center;
}

.profile-img {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  cursor: pointer;
  transition: transform 0.3s;
}

.profile-container:hover .profile-img {
  transform: scale(1.1);
}

.profile-name {
  display: none;
  position: absolute;
  top: 50%;
  right: 0%;
  transform: translate(-50%, -50%);
  background: rgba(0, 0, 0, 0.7);
  color: white;
  padding: 5px 10px;
  border-radius: 5px;
  white-space: nowrap;
  pointer-events: none;
}

.profile-container:hover .profile-name {
  display: block;
}

.custom-font-size {
  font-size: 18px;
  transition: color 0.3s, font-size 0.3s;
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

.logo-img {
  max-height: 40px;
  transition: max-height 0.3s;
}
.username {
  font-size: 18px;
  transition: font-size 0.3s;
}
.profile-img {
  max-height: 60px;
  transition: max-height 0.3s;
}
@media (max-width: 992px) {
  .logo-img {
    max-height: 30px;
  }
  .username {
    font-size: 14px;
  }
  .profile-img {
    max-height: 50px;
  }
  .custom-font-size {
    font-size: 16px;
  }
}
@media (max-width: 768px) {
  .logo {
    display: none;
  }
  .custom-font-size {
    font-size: 16px;
  }
  .username {
    font-size: 12px;
  }
  .profile-img {
    max-height: 40px;
  }
  .profile-section {
    width: auto;
  }
}
</style>

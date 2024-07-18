<template>
  <div class="div bg-white sticky-xl-top">
    <div class="navbar-shadow">
      <div class="container">
        <nav class="navbar navbar-expand-lg d-flex flex-column">
          <div class="container-fluid">
            <button
              class="navbar-toggler"
              type="button"
              data-bs-toggle="collapse"
              data-bs-target="#navbarNavDropdown"
              aria-controls="navbarNavDropdown"
              aria-expanded="false"
              aria-label="Toggle navigation"
            >
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
              <div class="d-flex w-100 justify-content-between align-items-center">
                <!-- Left side of the navbar -->
                <div class="d-flex flex-grow-1">
                  <router-link to="/" class="me-5 mb-0 text-secondary custom-font-size nav-link" active-class="text-dark active border-bottom" @click="isProduct(0)"><i class="fas fa-home"></i> Home</router-link>
                  <router-link to="/product" class="me-5 mb-0 text-secondary custom-font-size nav-link" active-class="text-dark active border-bottom" @click="isProduct(1)"><i class="fas fa-box me-2"></i>Products</router-link>
                  <router-link to="/Createstore" class="me-5 text-secondary mb-0 custom-font-size nav-link" active-class="text-dark active border-bottom" @click="isProduct(0)">Store</router-link>
                </div>

                <!-- Logo -->
                <a class="navbar-brand mx-auto logo" href="#">
                  <img class="ms-auto logo-img" src="../../assets/images/lOUKDO.png" alt="Logo" />
                </a>

                <!-- Profile -->
                <div class="d-flex justify-content-end align-items-center profile-section" style="width: 40%">
                  <div class="iconenav d-flex align-items-center">
                    <div v-if="store_user.accountUser" class="position-relative me-3" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" alt="">
                      <i class="bi bi-bell-fill me-2"></i>
                      <span v-if="notiNum > 0" class="badge bg-danger position-absolute top-0 start-100 translate-middle">{{ notiNum }}</span>
                    </div>
                    <ul class="dropdown-menu dropdown-menu-end custom-dropdown">
                      <li v-if="currentSeller">
                        <router-link v-for="(sell, list) in currentSeller" :key="list" class="custom-dropdown-item border-bottom" to="/selling">
                          <p v-if="sell.status==0" @click="isClick"><i class="fas fa-user me-2"></i>{{sell.buyer.name}} order {{ sell.products[0].name }}</p>
                        </router-link>
                      </li>
                    </ul>
                    <router-link v-if="store_user.accountUser" to="/card" class="position-relative">
                      <i class="bi bi-cart-dash me-2"></i>
                      <span class="badge bg-success position-absolute top-0 start-100 translate-middle">{{ numcart }}</span>
                    </router-link>
                  </div>
                  <router-link v-if="!store_user.accountUser" to="/login" class="nav-link mr-0 custom-font-size"><button class="btn btn-secondary m-1">Login</button></router-link>
                  <router-link v-if="!store_user.accountUser" to="/register" class="nav-link mr-0 custom-font-size"><button class="btn btn-primary m-1">Register</button></router-link>
                  <div v-else class="dropdown d-flex align-items-center profile-container">
                    <span class="profile-name">{{ store_user.accountUser.name.toUpperCase() }}</span>
                    <img v-if="store_user.accountUser.profile" :src="profile_url(store_user.accountUser.profile)" class="text-dark custom-font-size nav-link profile-img" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" alt="">
                    <img v-else :src="profileImageUrl" class="text-dark custom-font-size nav-link profile-img" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" alt="">
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink">
                      <li>
                        <router-link v-if="store_user.accountUser.id == 1" class="dropdown-item" to="/dashboard" active-class="active"><i class="fas fa-user me-2"></i>Profile</router-link>
                        <router-link v-else class="dropdown-item" to="/profile" active-class="active"><i class="fas fa-user me-2"></i>Profile</router-link>
                      </li>
                      <li>
                        <button class="dropdown-item" @click="logout"><i class="fas fa-sign-out-alt me-2"></i>Logout</button>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </nav>
      </div>
    </div>

    <div class="container">
      <nav v-if="ifProduct" class="d-flex">
        <ul v-for="cate in listCategories" :key="cate.id" class="nav nav-tabs">
          <li class="nav-item">
            <router-link class="nav-link" active-class="navbar-shadow active" aria-current="page" :to="{ name: 'product/category', params: { id: cate.id} }">{{cate.category_name}}</router-link>
          </li>
        </ul>
      </nav>
    </div>
  </div>
</template>

<script>
import { useUserStore } from '@/stores/user.js';
import axios from 'axios';
import { computed, ref, onMounted } from 'vue';
import api from '@/views/api.js';

export default {
  setup() {
    const store_user = useUserStore();
    store_user.loadUser(); // Ensure user data is loaded from localStorage

    const ifProduct = ref(false);
    const numcart = ref(0);
    const listCategories = ref([]);
    const currentSeller = ref([]);
    const notiNum = ref(0);

    const loadCart = () => {
      const cart = JSON.parse(localStorage.getItem('cart')) || [];
      numcart.value = cart.length;
    };

    const getListCate = async () => {
      try {
        const response = await api.listCategories();
        listCategories.value = response.data.data;
      } catch (error) {
        console.log(error);
      }
    };

    const cate_id = (id) => {
      store_user.getCateProId(id);
      // this.$router.push({name:productCategory, id:id})
    };

    const isProduct = (isProduct) => {
      ifProduct.value = isProduct === 1;
    };

    const fetchCurrentOrder = async () => {
      try {
        const headers = { Authorization: `Bearer ${store_user.tokenUser}` };
        const response = await api.listSellerProducts(headers);

        currentSeller.value = response.data.orderProducts; // Assuming response has orderProducts key
        notiNum.value = 0;
        for (const order of currentSeller.value) {
          if (order.status === 0) {
            notiNum.value += 1;
          }
        }
      } catch (error) {
        console.error('Error fetching current orders:', error);
      }
    };

    const isClick = () => {
      if (notiNum.value !== 0) {
        notiNum.value -= 1;
      } else {
        notiNum.value = 0;
      }
    };

    const profile_url = (filename) => {
      return api.profile(filename);
    };

    const logout = async () => {
      try {
        await axios.post(
          'http://127.0.0.1:8000/api/logout',
          {},
          {
            headers: {
              Authorization: `Bearer ${store_user.tokenUser}`,
            }
          }
        );
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

    onMounted(() => {
      loadCart();
      getListCate();
      fetchCurrentOrder();
    });

    return {
      store_user,
      logout,
      profileImageUrl,
      ifProduct,
      numcart,
      listCategories,
      currentSeller,
      notiNum,
      loadCart,
      getListCate,
      cate_id,
      isProduct,
      fetchCurrentOrder,
      isClick,
      profile_url,
    };
  },
};
</script>

<style>
/* Add your CSS styling here */
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
  /* font-size: 20px; */
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
.iconenav {
  margin-right: 10px;
}

.badge {
  font-size: 10px; /* Adjust font size */
  border-radius: 10px; /* Adjust border radius */
}

.start-100 {
  left: 78% !important;
}

.translate-middle {
  transform: translate(-50%, -50%) !important;
}
.custom-dropdown {
  width: 300px;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.custom-dropdown-item {
  display: flex;
  align-items: center;
  padding: 10px 15px;
  transition: background-color 0.3s ease;
}

.custom-dropdown-item:hover {
  background-color: #f8f9fa;
}

.custom-dropdown-item i {
  margin-right: 10px;
  color: #6c757d;
}

.custom-dropdown-item span {
  flex-grow: 1;
  font-size: 0.9rem;
  color: #495057;
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

<template>
  <section class="container">
    <div class="row d-flex justify-content-center align-items-center">
      <div class="col-12">
        <div class="card h-100">
          <div class="cover rounded-top text-white d-flex flex-row">
            <div
            class="profile ms-4 mt-5 d-flex flex-row align-items-center"
            style="padding-top: 60px">
              <div class="position-relative">
                <img :src="userStore.accountUser.profile_path" class="img-fluid img-thumbnail mt-5 me-3" />
                <label for="fileUpload" class="camera-icon position-absolute">
                  <i class="fas fa-camera fa-lg text-dark"></i>
                </label>
                <input type="file" id="fileUpload" ref="fileUpload" style="display: none"/>
              </div>
              <h4 class="mt-5" style="color: black">{{ userStore.accountUser.name }}</h4>
            </div>
          </div>
          <div class="p-4 text-black">
            <div class="d-flex justify-content-around align-items-center">
              <div class="d-flex justify-content-center">
                <div class="mx-2">
                  <p class="text-muted mb-0">Message</p>
                </div>
                <div class="mx-2">
                  <p class="text-muted mb-0">Products</p>
                </div>
                <div class="mx-2">
                  <p class="text-muted mb-0">Delivery</p>
                </div>
                <div class="mx-2">
                  <p class="text-muted mb-0">Add to chat</p>
                </div>
              </div>
              <div class="d-flex align-items-center gap-1">
                <div>
                  <button class="btn bg-light-gray btn-sm">...</button>
                </div>
                <div>
                  <button class="btn btn-dark btn-sm">Post</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import axios from 'axios';
import { useUserStore } from '@/stores/user.js'
import { ref, onMounted } from 'vue'


export default {
  name: 'Profile',
  data(){
    return{
      api:{
        profile:'http://127.0.0.1:8000/api/user/update'
      }
    }
  },
  methods: {
    async updateUserImageProfile() {

      try {
        console.log(response);
        let response = await axios.post(this.api.profile,{
          // image: this.$refs.fileUpload.files[0]
        });
      } catch (error) {
        console.error('Error updating user profile:', error);
      }
    }
  },

  setup() {
    const userStore = useUserStore()
    const user = ref(userStore.accountUser)

    onMounted(() => {
      user.value = userStore.accountUser
    })


    

    return {
      userStore,
    }
  }
}
</script>

<style scoped>
html,
body,
#app {
  height: 100%;
  margin: 0;
  padding: 0;
}

.profile img {
  border-radius: 50%;
  width: 150px;
  height: 150px;
  z-index: 1;
}

.profile h4 {
  margin-left: 10px; /* Adjust as needed */
}

.card {
  width: 100%;
}

.cover {
  height: 200px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  background: rgb(79, 220, 242);
}

.bg-light-gray {
  background-color: #676768a4;
}

.text-dark {
  color: #333; /* Adjust to match your dark color preference */
}

.position-relative {
  position: relative;
}

.camera-icon {
  top: 150px; /* Adjust as needed */
  right:25px; /* Adjust as needed */
  cursor: pointer;
}
</style>

<template>
  <section class="container">
    <div class="row d-flex justify-content-center align-items-center">
      <div class="col-12">
        <div class="card h-100">
          <div class="cover rounded-top text-white d-flex flex-row">
            <div class="profile ms-4 mt-5 d-flex flex-column align-items-center">
              <img src="" class="img-fluid img-thumbnail mt-5" />
              <h4 class="mt-2">{{ user?.name }}</h4>
            </div>
            <div class="ms-3" style="margin-top: 130px"></div>
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
              <p>{{userStore}}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import { useUserStore} from '@/stores/user.js'
import { ref, onMounted } from 'vue'

export default {
  name: 'Profile',
  setup() {
    const userStore = useUserStore()
    userStore.loadUser()
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
</style>

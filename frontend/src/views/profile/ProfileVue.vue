<template>
  <section class="container">
    <div class="row d-flex justify-content-center align-items-center">
      <div class="col-12">
        <div class="card h-100">
          <div class="cover rounded-top text-white d-flex flex-row">
            <div
              class="profile ms-4 mt-5 d-flex flex-row align-items-center"
              style="padding-top: 60px"
            >
              <div class="position-relative">
                <img
                  :src="userStore.accountUser.profile_path"
                  class="img-fluid img-thumbnail mt-5 me-3"
                />
                <label for="inputGroupFile04" class="camera-icon position-absolute">
                  <i
                    class="fas fa-camera fa-lg"
                    data-bs-toggle="modal"
                    data-bs-target="#exampleModal"
                  ></i>
                </label>

                <!-- Modal -->
                <div
                  class="modal fade"
                  id="exampleModal"
                  ref="exampleModalRef"
                  tabindex="-1"
                  aria-labelledby="exampleModalLabel"
                  aria-hidden="true">

                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title text-dark" id="exampleModalLabel">
                          Upload your profile
                        </h5>
                        <button
                          type="button"
                          class="btn-close"
                          data-bs-dismiss="modal"
                          aria-label="Close"
                        ></button>
                      </div>

          
                      <form @submit.prevent="uploadProfilePicture" enctype="multipart/form-data">
                        <div class="modal-body">
                          <input
                            type="file"
                            class="form-control"
                            aria-label="Upload"
                            accept="image/*"
                            @change="onFileChange"
                          />
                        </div> 
                        <div class="modal-footer justify-content-between">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-danger">Upload</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <h4 class="mt-5" style="color: black">
                {{ userStore.accountUser.name.toUpperCase() }}
              </h4>
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
import axios from 'axios'
import { useUserStore } from '@/stores/user.js'

export default {
  name: 'Profile',
  data() {
    return {
      userStore: useUserStore(),
      profile: null
    }
  },
  mounted() {
    // Retrieve profile path from localStorage on component mount
    const storedProfilePath = localStorage.getItem('profile_path')
    if (storedProfilePath) {
      this.userStore.accountUser.profile_path = storedProfilePath
    }
  },
  methods: {
    onFileChange(e) {
      this.profile = e.target.files[0]
      console.log(this.profile) // Log the file
    },
    async uploadProfilePicture() {
      if (!this.profile) {
        console.error('No file selected.')
        return
      }

      const formData = new FormData()
      formData.append('profile', this.profile) // Ensure key matches backend

      try {
        const response = await axios.post('http://127.0.0.1:8000/api/user/update', formData, {
          headers: {
            Authorization: `Bearer ${this.userStore.tokenUser}`,
            'Content-Type': 'multipart/form-data'
          }
        })

        console.log(response.data) // Log the response
        // Update the profile path in the user store
        this.userStore.accountUser.profile_path = response.data.image_path

        // Save profile path to localStorage
        localStorage.setItem('profile_path', response.data.image_path)

      } catch (error) {
        if (error.response && error.response.data) {
          console.error('Error:', error.response.data) // Log detailed error from server
        } else {
          console.error('Error:', error.message) // Log generic error
        }
      }
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
  margin-left: 10px;
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
  color: #333;
}

.position-relative {
  position: relative;
}

.camera-icon {
  top: 150px;
  right: 25px;
  cursor: pointer;
}
.camera-icon :hover {
  color: black;
}
</style>

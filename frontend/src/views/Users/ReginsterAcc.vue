<template>
  <div class="container">
    <form @submit.prevent="submitForm">
      <div class="row justify-content-center">
        <div class="bg-light rounded shadow w-50" style="width: 50%">
          <div class="">
            <div class="title text-center">
              <h2><b>Create an account</b></h2>
              <p>Enter your email to sign up for this app</p>
            </div>
            <div class="form-row d-flex" style="gap: 10px">
              <div class="col">
                <div class="form-group">
                  <label for="firstName">First name</label>
                  <input type="text" class="form-control" id="firstName" v-model="user.firstname"/>
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label for="lastName">Last name</label>
                  <input type="text" class="form-control" id="lastName" v-model="user.lastname"/>
                </div>
              </div>
            </div>

            <div class="form-group fw-bold mt-3">
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email" v-model="user.email"/>
            </div>

            <div class="form-group fw-bold mt-3">
              <label for="password" class="form-label mt-2">Password</label>
            </div>
            <div class="d-flex">
              <input type="password" class="form-control fw-bold flex-grow-1" v-model="user.password"/>
              <button type="submit" class="btn btn-dark ms-3">Submit</button>
            </div>

            <div class="row justify-content-center mt-4">
              <div class="d-flex align-items-center">
                <div class="flex-grow-1 border-top border-dark"></div>
                <div class="text-center px-3">or continue with</div>
                <div class="flex-grow-1 border-top border-dark"></div>
              </div>
            </div>

            <div class="form-group d-flex align-items-center mt-3 bg-light p-2 rounded">
              <div>
                <img
                  src="https://img.icons8.com/color/48/000000/google-logo.png"
                  alt="Google Logo"
                  class="img-fluid"
                  style="width: 35px;"
                />
              </div>
              <div class="ms-3 text-center">
                <p class="mb-0">Google</p>
              </div>
            </div>
            <p class="mt-3 text-center">
              By clicking continue, you agree to our <b>Terms of Service</b> and
              <b>Privacy</b><br /><b>Policy.</b>
            </p>
          </div>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
import axios from "axios";
import { useUserStore } from "@/stores/user.js";

export default {
  name: "RegisterAccVue",
  data() {
    return {
      API: {
        register: "http://127.0.0.1:8000/api/register",
      },
      user: {
        firstname: "",
        lastname: "",
        email: "",
        password: "",
      },
      store_user: useUserStore(),
    };
  },
  computed: {
    fullName() {
      return this.user.firstname + " " + this.user.lastname;
    }
  },
  methods: {
    async register(data_register) {
      try {
        let response = await axios.post(this.API.register, data_register);
        if (response.data.success) {
          this.store_user.accountUser = response.data.data;
          this.store_user.tokenUser = response.data.token;

          // Save to localStorage
          localStorage.setItem('user_token', response.data.token);
          localStorage.setItem('userAccount', JSON.stringify(response.data.data));

          this.$router.push("/");
        }
      } catch (e) {
        console.log("Error register:", e);
      }
    },
    submitForm() {
      const userWithFullName = {
        ...this.user,
        name: this.fullName
      };
      this.register(userWithFullName);
    },
  },
  mounted() {
    // Check if token exists in localStorage on component mount
    const token = localStorage.getItem('user_token');
    const accountUser = localStorage.getItem('userAccount');
    if (token && accountUser) {
      this.store_user.tokenUser = token;
      this.store_user.accountUser = JSON.parse(accountUser);
      this.$router.push("/");
    }
  }
};

</script>

<style>
/* Add any necessary styles here */
</style>

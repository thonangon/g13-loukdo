<template>
  <form @submit.prevent="login">
    <div class="container bg-light p-4 rounded shadow w-50">
      <div class="mb-3 text-center">
        <h3>Login account</h3>
        <span>Have a nice day!</span>
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label fw-bold" style="padding-top: 10px">Email address</label>
        <input type="email" class="form-control fw-bold" v-model="email" required />
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label fw-bold" style="padding-top: 10px">Password</label>
        <div class="d-flex align-items-center">
          <input type="password" class="form-control fw-bold flex-grow-1" v-model="password" required />
          <button type="submit" class="btn btn-dark ms-3" :disabled="loading">
            <span v-if="loading" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            Submit
          </button>
        </div>
      </div>
      <div v-if="error" class="alert alert-dark">{{ error }}</div>
      <div>
        <a href="" style="text-decoration: none">Did you forget password?</a>
      </div>
    </div>
  </form>
</template>

<script>
import axios from 'axios';
import { useUserStore } from '@/stores/user.js';

export default {
  data() {
    return {
      email: '',
      password: '',
      store_user: useUserStore(),
      api: {
        login: 'http://127.0.0.1:8000/api/login'
      },
      loading: false,
      error: null
    }
  },
  methods: {
    async login() {
      this.loading = true;
      try {
        let response = await axios.post(this.api.login, { email: this.email, password: this.password });
        console.log(response);
        if (response.data.success) {
          this.store_user.accountUser = response.data.data;
          this.store_user.tokenUser = response.data.token;

          // Save to localStorage
          localStorage.setItem('user_token', response.data.token);
          localStorage.setItem('userAccount', JSON.stringify(response.data.data));

          this.$router.push('/order');
        } else {
          this.error = response.data.message;
        }
      } catch (e) {
        this.error = 'Error logging in. Please try again.';
      } finally {
        this.loading = false;
      }
    }
  },
  mounted() {
    // Check if token exists in localStorage on component mount
    const token = localStorage.getItem('user_token');
    const accountUser = localStorage.getItem('userAccount');
    if (token && accountUser) {
      this.store_user.tokenUser = token;
      this.store_user.accountUser = JSON.parse(accountUser);
      this.$router.push('/order');
    }
  }
}
</script>

<style>
</style>
<template>
  <form @submit.prevent="login">
    <div class="container bg-light p-4 rounded shadow w-50">
      <div class="mb-3 text-center">
        <h3>Login account</h3>
        <span>Have a nice day!</span>
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label fw-bold" style="padding-top: 10px"
          >Email address</label
        >
        <input type="email" class="form-control fw-bold" v-model="email" />
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label fw-bold" style="padding-top: 10px"
          >Password</label
        >
        <div class="d-flex align-items-center">
          <input type="password" class="form-control fw-bold flex-grow-1" v-model="password" />
          <button type="submit" class="btn btn-primary ms-3">Submit</button>
        </div>
      </div>
      <div>
        <a href="" style="text-decoration: none">Did you forget password?</a>
      </div>
    </div>
  </form>
</template>

<script>
import axios from 'axios';

export default {
  data(){
    return {
      email:'',
      password:''
    }
  },
  methods: {
        async login(data) {
        try {
          const response = await axios.post('http://127.0.0.1:8000/api/login', data);
          console.log(response.data.email);
          if (response.data.success) {
            this.$router.push({ email: 'login' });
          }
        } catch (error) {
          console.error('Error creating login:', error);
        }
      },
        
  }

}
</script>

<style>
</style>
<template>
  <div class="container bg-light rounded shadow w-50 p-5 items-center" style="width: 50%">
    <form @submit.prevent="submitForm">
      <div class="p-4">
        <div class="title text-center">
          <h2><b>Create an account</b></h2>
          <p>Enter full fields to sign up for this app</p>
        </div>
        <div class="form-row d-flex" style="gap: 10px">
          <div class="col">
            <div class="form-group">
              <label for="firstName">First name</label>
              <input type="text" class="form-control" id="firstName" v-model="user.firstname" />
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label for="lastName">Last name</label>
              <input type="text" class="form-control" id="lastName" v-model="user.lastname" />
            </div>
          </div>
        </div>

        <div class="form-group fw-bold mt-3">
          <label for="email">Email</label>
          <input type="email" class="form-control" id="email" v-model="user.email" @input="validateEmail(user.email)" />
          <span v-if="emailError" class="text-danger">{{ emailError }}</span>
        </div>

        <div class="form-group fw-bold mt-3">
          <label for="password" class="form-label mt-2">Password</label>
          <input type="password" class="form-control fw-bold flex-grow-1" v-model="user.password" @input="validatePassword(user.password)" />
          <span v-if="passwordError" class="text-danger">{{ passwordError }}</span>
        </div>

        <div class="d-flex justify-content-center mt-4">
          <button type="submit" class="btn btn-primary btn-center form-control">Sign up</button>
        </div>
      </div>
    </form>
    <div class="text-center">
      <a href="#" class="text-black">Have account already</a>
      <a href="/login" style="text-decoration: none"> | Login</a>
    </div>
  </div>
</template>

<script>
import api from '../../views/api';
import { useUserStore } from '@/stores/user.js';

export default {
  name: 'RegisterAccVue',
  data() {
    return {
      user: {
        firstname: '',
        lastname: '',
        email: '',
        password: '',
      },
      store_user: useUserStore(),
      loading: false,
      emailError: null,
      passwordError: null,
    };
  },
  computed: {
    fullName() {
      return this.user.firstname + ' ' + this.user.lastname;
    },
  },
  methods: {
    validateEmail(email) {
      if (!email) {
        this.emailError = 'Email is required.';
      } else if (!this.isValidEmail(email)) {
        this.emailError = 'Please enter a valid email address.';
      } else {
        this.emailError = null;
      }
    },
    validatePassword(password) {
      if (!password) {
        this.passwordError = 'Password is required.';
      } else if (password.length < 8) {
        this.passwordError = 'Password must be at least 8 characters long.';
      } else if (!this.isStrongPassword(password)) {
        this.passwordError =
          'Password must include at least one uppercase letter, one lowercase letter, one number, and one special character.';
      } else {
        this.passwordError = null;
      }
    },
    isValidEmail(email) {
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      return emailRegex.test(email);
    },
    isStrongPassword(password) {
      const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
      return passwordRegex.test(password);
    },
    async register(userData) {
      this.validateEmail(userData.email);
      this.validatePassword(userData.password);

      if (this.emailError || this.passwordError) {
        return;
      }

      this.loading = true;
      try {
        let response = await api.register(userData);
        if (response.data.success) {
          this.store_user.accountUser = response.data.data;
          this.store_user.tokenUser = response.data.token;

          // Save to localStorage
          localStorage.setItem('user_token', response.data.token);
          localStorage.setItem('userAccount', JSON.stringify(response.data.data));

          this.$router.push('/');
        }
      } catch (e) {
        this.loading = false;
        console.log('Error register:', e);
      }
    },
    submitForm() {
      const userWithFullName = {
        ...this.user,
        name: this.fullName,
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
      this.$router.push('/');
    }
  },
};
</script>

<style>
.btn {
  border-radius: 30px;
  font-size: 0.9em;
  padding: 10px 20px;
  cursor: pointer; 
}

.btn-center {
  display: inline-block;
  margin: 0 auto;
}
</style>
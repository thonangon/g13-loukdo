// stores/user.js

import { defineStore } from 'pinia';

export const useUserStore = defineStore({
  id: 'user',
  state: () => ({
    accountUser: null,
    tokenUser: null,
    numProducts: 0, // Example: Number of products user can post
  }),
  actions: {
    setUser(data) {
      this.accountUser = data.accountUser;
      this.tokenUser = data.tokenUser;
      
      localStorage.setItem('user_token', data.userToken);
      localStorage.setItem('userAccount', JSON.stringify(data.accountUser));
    },
    loadUser() {
      const token = localStorage.getItem('user_token');
      const accountUser = localStorage.getItem('userAccount');
      if (token && accountUser) {
        this.tokenUser = token;
        this.accountUser = JSON.parse(accountUser);
      }
    },
    logout() {
      this.accountUser = null;
      this.tokenUser = null;
      this.numProducts = 0; // Reset number of products on logout
      localStorage.removeItem('user_token');
      localStorage.removeItem('userAccount');
    },
    updateUserStatus() {
      // Example: Update numProducts after successful payment
      this.numProducts = Math.max(this.numProducts - 1, 0);
    },
  },
});

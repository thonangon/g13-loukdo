
import { defineStore } from 'pinia';

export const useUserStore = defineStore('user', {
  state: () => ({
    accountUser: null,
    tokenUser: null,
  }),
  actions: {
    setUser(data) {
      this.accountUser = data.userAccount;
      this.tokenUser = data.userToken;
      
      localStorage.setItem('user_token', data.userToken);
      localStorage.setItem('userAccount', JSON.stringify(data.userAccount));
    },
    loadUser() {
      const token = localStorage.getItem('user_token');
      const userAccount = localStorage.getItem('userAccount');
      if (token && accountUser) {
        this.tokenUser = token;
        this.accountUser = JSON.parse(userAccount);
      }
    },
    logout() {
      this.accountUser = null;
      this.tokenUser = null;
      localStorage.removeItem('user_token');
      localStorage.removeItem('userAccount');
    }
  }
});


import { defineStore } from 'pinia';

export const useUserStore = defineStore('user', {
  state: () => ({
    accountUser: null,
    tokenUser: null,
    quantity: null,
    productDetails: null,
    num_products: 0,
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
      localStorage.removeItem('user_token');
      localStorage.removeItem('userAccount');
    },
    setOrderData(quantity, productDetails) {
      this.quantity = quantity;
      this.productDetails = productDetails;
    },
    get_num_products(num_products) {
      this.num_products = num_products;
    },
  }
});

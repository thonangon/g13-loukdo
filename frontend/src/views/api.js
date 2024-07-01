import axios from 'axios';

const API_URL = 'http://127.0.0.1:8000/api';

export default {
  listProduct() {
    return axios.get(`${API_URL}/products/list`);
  },
  createProduct(formData, config) {
    return axios.post(`${API_URL}/products/create`, formData, config);
  },

  imageUrlProduct(filename) {
    return `${API_URL}/products/image/${filename}`;
  },

  register(userData) {
    return axios.post(`${API_URL}/register`, userData);
  },

  login(userData) {
    return axios.post(`${API_URL}/login`, userData);
  },

  logout() {
    return axios.post(`${API_URL}/logout`);
  },

};

import axios from 'axios';

const API_URL = 'http://127.0.0.1:8000/api';
const URL_PORT = 'http://127.0.0.1:8000';

export default {
  listProduct() {
    return axios.get(`${API_URL}/products/list`);
  },

  imageUrlProduct(filename) {
    return `${API_URL}/products/image/${filename}`;
  },
  
  imageComment(filename) {
    return `${URL_PORT}/images/product/${filename}`;
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

  detailProduct(productId, headers) {
    return axios.get(`${API_URL}/products/pro_details/${productId}`, {
      headers: headers
    });
  }
  
};


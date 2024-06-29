// src/api.js
import axios from 'axios';

const API_URL = 'http://127.0.0.1:8000/api';

export default {
  listProduct() {
    return axios.get(`${API_URL}/products/list`);
  },
  createProduct(){
    return axios.post(`${API_URL}/products/create`);
  }
};

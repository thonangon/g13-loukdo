import axios from 'axios';

const API_URL = 'http://127.0.0.1:8000/api';
const URL_PORT = 'http://127.0.0.1:8000';

export default {
  myaccount(headers){
    return axios.get(`${API_URL}/myaccount`, {headers: headers});
  },
  
  listProduct() {
    return axios.get(`${API_URL}/products/list`);
  },
  createProduct(formData, config) {
    return axios.post(`${API_URL}/products/create`, formData, config);
  },

  imageUrlProduct(filename) {
    return `${API_URL}/products/image/${filename}`;
  },
  imageUrlStore(filename) {
    return `${API_URL}/stores/image/${filename}`;
  },
  
  imageComment(filename) {
    return `${URL_PORT}/images/product/${filename}`;
  },

  profile(filename) {
    return `${URL_PORT}/storage/${filename}`;
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
  },

  comment_product(data, headers) {
    return axios.post(`${API_URL}/comment/create`, data, {
      headers: headers
    });
  },

  replycomment(formData, config) {
    return axios.post(`${API_URL}/reply/create`, formData, config);
  },
  userproduct(id) {
    return axios.get(`${API_URL}/userproduct`, {
      params: { id: id }
    });
  },
  createStore(formData, config){
    return axios.post(`${API_URL}/store/create`, formData, config)
  },
  getStores(){
    return axios.get(`${API_URL}/store/list`);
  },
  updateStore(storeId, formData, config) {
    return axios.put(`${API_URL}/store/update/${storeId}`, formData, config);
  },
  deleteStore(storeId) {
    return axios.delete(`${API_URL}/store/remove/${storeId}`);
  }
};


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


  chatrooms(headers) {
    return axios.get(`${API_URL}/message/chat/rooms`, {
      headers: headers
    });
  },
  getAllCate(){
    return axios.get(`${API_URL}/categories/list`);},
  createStore(formData, config){
    return axios.post(`${API_URL}/store/create`, formData, config)
  },
  getStores(){
    return axios.get(`${API_URL}/store/list`);
  },
  getStore(storeId) {
    return axios.get(`${API_URL}/store/show/${storeId}`);
  },
  updateStore(storeId, formData) {
    return axios.put(`${API_URL}/store/update/${storeId}`, formData);
  },
  deleteStore(storeId) {
    return axios.delete(`${API_URL}/store/remove/${storeId}`);
  },
  imageUrlStore(filename) {
    return `${API_URL}/stores/image/${filename}`;
  },
  deleteProduct(id, config) {
    return axios.delete(`${API_URL}/products/remove/${id}`, config);
  },
// __________________________pro_________________

  updateProduct(pro_id, data, token) {
    const headers = {
      'Authorization': `Bearer ${token}`
    };
    return axios.post(`${API_URL}/products/update/${pro_id}`, data, { headers: headers });
  },
   // New CRUD methods for OrderProduct
   listOrderProducts(headers) {
    return axios.get(`${API_URL}/order/list`, { headers: headers });
  },
   listSellerProducts(headers) {
    return axios.get(`${API_URL}/order/list/seller`, { headers: headers });
  },

  createOrderProduct(data, headers) {
    return axios.post(`${API_URL}/order/create/order`, data, { headers: headers });
  },

  updateOrderProduct(id, data, headers) {
    return axios.put(`${API_URL}/order/update/${id}`, data, { headers: headers });
  },

  deleteOrderProduct(id, headers) {
    console.log(`${API_URL}/order/remove/${id}`)
    return axios.delete(`${API_URL}/order/remove/${id}`, { headers: headers });
  },

  updateOrderStatus(orderId, status, token) {
    const headers = {
      'Authorization': `Bearer ${token}`
    };
    return axios.put(`${API_URL}/order/update/status/${orderId}`, { status: status }, { headers: headers });
  },

  // ____________________CATEGORY________________
  listCategories(){
    return axios.get(`${API_URL}/categories/list`);
  },

  productCategory(cateId) {
    return axios.get(`${API_URL}/products/category/${cateId}`);
  },

};


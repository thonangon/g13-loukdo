import 'bootstrap/dist/css/bootstrap.css'
import { createApp } from 'vue'
// import App from './App.vue'
import bootstrap from 'bootstrap/dist/js/bootstrap.bundle.js' 
import '@fortawesome/fontawesome-free/css/all.css';
import Loukdo from '../../frontend/src/LoukDo.vue'
import axios from 'axios';
import router from './router'
import { createPinia } from 'pinia'
const pinia = createPinia()


createApp(Loukdo).use(bootstrap).use(router).use(pinia).mount('#app')

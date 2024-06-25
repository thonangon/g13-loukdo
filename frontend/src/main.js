import 'bootstrap/dist/css/bootstrap.css'
import { createApp } from 'vue'
// import App from './App.vue'
import bootstrap from 'bootstrap/dist/js/bootstrap.bundle.js' 
import Loukdo from '../../frontend/src/LoukDo.vue'
import router from './router'


createApp(Loukdo).use(bootstrap).use(router).mount('#app')

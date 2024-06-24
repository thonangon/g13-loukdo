import { createApp } from 'vue'
// import App from './App.vue'
import 'bootstrap/dist/css/bootstrap.css'
import bootstrap from 'bootstrap/dist/js/bootstrap.bundle.js' 
import Loukdo from '../../frontend/src/LoukDo.vue'

createApp(Loukdo).use(bootstrap).mount('#app')

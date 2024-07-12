import { createRouter, createWebHistory } from 'vue-router'
import Loukdo from '../LoukDo.vue'
import Admin from '../Admin.vue'

const routes = [
  {
    path: '/',
    name: 'Loukdo',
    component: Loukdo
  },
  {
    path: '/admin',
    name: 'Admin',
    component: Admin
  }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router

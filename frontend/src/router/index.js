import { createWebHistory, createRouter } from 'vue-router'

// import homePage from '@/views/HomePage.vue'
import produc_detail from '../views/Products/DetailPro.vue'


const routes = [
    // { 
    //     path: '/',
    //     name:'home', 
    //     component: homePage
    // },
    { 
        path: '/produc_detail',
        name:'produc_detail', 
        component: produc_detail
    },
 
]

const router = createRouter({
    history: createWebHistory(),
    routes,
})

export default router;
import { createWebHistory, createRouter } from 'vue-router'
import home_pro from '../views/Products/ProductShow.vue'
import produc_detail from '../views/Products/DetailPro.vue'
import LoginUser from '../views/Users/LoginUser.vue'
import CustomerOrder from '../views/Order/CustomerOrder.vue'
import ChangePassword from '../views/FogetPassword/ChangePassword.vue'
import register from '../views/Users/ReginsterAcc.vue'
import Viewprofile from '../views/profile/ProfileVue.vue'




const routes = [
    { 
        path: '/',
        name:'home_pro', 
        component: home_pro
    },
    { 
        path: '/produc_detail',
        name:'produc_detail', 
        component: produc_detail
    },
    { 
        path: '/login',
        name:'login', 
        component: LoginUser
    },
    {
        path: '/register',
        name:'register', 
        component: register
    },
    { 
        path: '/order',
        name:'order', 
        component: CustomerOrder
      
    },
    { 
        path: '/foget',
        name:'foget', 
        component: ChangePassword
    },
    {
        path: '/profile',
        name:'profile', 
        component: Viewprofile
    },
    
 
]

const router = createRouter({
    history: createWebHistory(),
    routes,
})

export default router;
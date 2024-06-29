import { createWebHistory, createRouter } from 'vue-router'

import home_pro from '../views/Products/ProductShow.vue'
import produc_detail from '../views/Products/DetailPro.vue'
import LoginUser from '../views/Users/LoginUser.vue'
import CustomerOrder from '../views/Order/CustomerOrder.vue'
import ChangePassword from '../views/FogetPassword/ChangePassword.vue'
import register from '../views/Users/ReginsterAcc.vue'
<<<<<<< HEAD
import creatProduct from '../views/Products/CreateProduct.vue'

=======
import ProductShow from '../views/Products/ProductShow.vue';
>>>>>>> origin/Search_Product

const routes = [
    { 
        path: '/',
        name:'home_pro', 
        component: home_pro
    },
    { 
        path: '/product/:id',
        name:'produc_detail', 
        component: produc_detail,
        props: true
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
<<<<<<< HEAD
    { 
        path: '/product/create',
        name:'create_product',  
        component: creatProduct
    },
=======
    {
      path: '/product/:id',
      name: 'ProductShow',
      component: ProductShow,
    },
  

>>>>>>> origin/Search_Product
 
]

const router = createRouter({
    history: createWebHistory(),
    routes,
})

export default router;
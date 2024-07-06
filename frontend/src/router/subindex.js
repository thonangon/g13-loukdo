import { createWebHistory, createRouter } from 'vue-router'

import userprodcuts from '../views/Users/ProductVue.vue'

const routes = [
   
    {
        path: '/userprodcuts',
        name: 'userprodcuts', 
        component: userprodcuts
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes,
})

export default router

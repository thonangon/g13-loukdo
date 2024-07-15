import { createWebHistory, createRouter } from 'vue-router'

import dashboad from ''

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

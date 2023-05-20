import {createRouter, createWebHistory} from "vue-router"
import Huvud from './components/Huvud.vue'
import Login from './components/Login.vue'
import Todos from './components/Todos.vue'



const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/',
            name: 'home',
            component: Huvud
        },
        {
            path: '/login',
            name: 'login',
            component: Login
        },
        {
            path: '/todos',
            name: 'todos',
            component: Todos
        }

    ]
})

export default router;
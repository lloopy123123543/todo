import {createRouter, createWebHistory} from "vue-router"
import Main from './components/Main.vue'
import Login from './components/Login.vue'
import Todos from './components/Todos.vue'
import Register from './components/Register.vue'

const router = createRouter({
    history: createWebHistory(),
    routes: [

        {
            path: '/',
            name: 'main',
            component: Main
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
        },

        {
            path: '/registration',
            name: 'login',
            component: Register
        },

    ]
})

export default router;
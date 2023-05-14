import { createApp } from 'vue'
import './assets/style.css'
import {createRouter, createWebHistory} from "vue-router"
import Login from './components/Login.vue'
import App from './App.vue'
import Nav from './components/Nav.vue'
import Todos from './components/Todos.vue'

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/',
            name: 'Login',
            component: Login
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

const app = createApp(App);
app.use(router);
app.mount('#app');
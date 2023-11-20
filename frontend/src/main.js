import { createApp } from 'vue'
import { createRouter, createWebHistory } from 'vue-router'
import './style.css'
import App from './App.vue'


import Home from './Pages/Home.vue';
import NewProduct from './Pages/NewProduct.vue';

const router = createRouter({
    history: createWebHistory(),
    routes: [
        { path: '/', component: Home },
        { path: '/new-product', component: NewProduct}
    ]
});

const app = createApp(App)
app.use(router);
app.mount('#app')

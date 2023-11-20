import { createApp } from 'vue'
import { createRouter, createWebHistory } from 'vue-router'
import './style.css'
import App from './App.vue'
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

// If you don't need the styles, do not connect
import 'sweetalert2/dist/sweetalert2.min.css';

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
app.use(VueSweetalert2);
app.use(router);
app.mount('#app')

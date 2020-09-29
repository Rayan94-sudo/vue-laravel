require('./bootstrap');
import Vue from 'vue';
import VueRouter from 'vue-router';
import { routes } from './routes';
import VueTableDynamic from 'vue-table-dynamic';
import VueSidebarMenu from 'vue-sidebar-menu'
import 'vue-sidebar-menu/dist/vue-sidebar-menu.css';
import admin from './admin'
import axios from './config/axios.js'


Vue.use(VueSidebarMenu);
Vue.use(VueTableDynamic);
Vue.use(VueRouter);
window.Vue = require('vue');

const router = new VueRouter({
    mode: 'history',
    routes: routes
});

const app = new Vue({
    el: '#app',
    components: {
        "admin": admin
    },
    router
});

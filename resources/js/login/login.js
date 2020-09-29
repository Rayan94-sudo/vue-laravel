require('../bootstrap');
import Vue from 'vue';
window.Vue = require('vue');
import login from "./Login.vue";
import axios from 'axios';

const app = new Vue({
    el: '#login',
    components: {
        'login': login
    }
});

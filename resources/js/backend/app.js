require('./bootstrap');
window.API_URL = '/admin/api';

import Vue from 'vue'
import VueRouter from 'vue-router'
import VueAxios from 'vue-axios'
import axios from 'axios'
import moment from 'vue-moment'
import router from './router'

Vue.use(VueRouter);
Vue.use(VueAxios, axios);
Vue.use(moment);

import App from './components/App.vue'
new Vue({
    el: '#app',
    router,
    render: h => h(App)
});

require('./bootstrap');

import Vue from 'vue'
import VueRouter from 'vue-router'
import router from './router'
Vue.use(VueRouter);

import App from './components/App.vue'

new Vue({
    el: '#app',
    router,
    render: h => h(App)
});

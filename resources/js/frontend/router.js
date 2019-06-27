import VueRouter from 'vue-router'


import auth from './auth'
import NotFound from './pages/404.vue'
import Home from './pages/Home.vue'
import SignUp from './pages/SignUp'
import Profile from './pages/Profile'
import Login from './pages/Login.vue'

function requireAuth(to, from, next) {
    if (!auth.loggedIn()) {
        next({
            path: '/login',
            query: {redirect: to.fullPath}
        })
    } else {
        next()
    }
}

const routes = [
    {path: '/', name: 'home', component: Home},
    {path: '/register', name: 'register', component: SignUp},
    {path: '/profile', name: 'profile', component: Profile, beforeEnter: requireAuth},
    {path: '/login', component: Login},
    {
        path: '/logout',
        beforeEnter(to, from, next) {
            auth.logout();
            next('/')
        }
    },
    {path: '*', component: NotFound}
];

const router = new VueRouter({
    history: true,
    mode: 'history',
    routes
});

export default router
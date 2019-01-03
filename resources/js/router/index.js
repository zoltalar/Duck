import Vue from 'vue'
import VueRouter from 'vue-router'
import store from '../store'

Vue.use(VueRouter)

// Router
let router = new VueRouter({
    routes: [
        {
            path: '/home',
            name: 'home',
            component: require('../components/home').default,
            meta: { auth: false }
        },
        {
            path: '/add-post',
            name: 'add-post',
            component: require('../components/add-post').default,
            meta: { auth: false }
        },
        {
            path: '/login',
            name: 'login',
            component: require('../components/login').default,
            meta: { auth: false }
        },
        {
            path: '/register',
            name: 'register',
            component: require('../components/register').default,
            meta: { auth: false }
        }
    ]
})

router.beforeEach((to, from, next) => {
    if (store.getters.loggedIn === false && to.meta.auth) {
        return next('/login')
    }

    next()
})

export default router
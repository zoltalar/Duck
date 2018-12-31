import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

// Router
let router = new VueRouter({
    routes: [
        {
            path: '/home',
            name: 'home',
            component: require('../components/home').default
        },
        {
            path: '/add-post',
            name: 'add-post',
            component: require('../components/add-post').default
        }
    ]
})

export default router
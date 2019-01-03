import Vue from 'vue'
import App from './components/app'
import router from './router'
import store from './store'

window.axios = require('axios')

const app = new Vue({
    el: '#root',
    router,
    store,
    template: '<app></app>',
    components: { App }
})
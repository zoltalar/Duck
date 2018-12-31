import Vue from 'vue'
import App from './components/app'
import router from './router'

window.axios = require('axios')

const app = new Vue({
    el: '#root',
    router,
    template: '<app></app>',
    components: { App }
})
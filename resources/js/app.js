import Vue from 'vue'
import App from './components/App'

window.axios = require('axios')

const app = new Vue({
    el: '#root',
    template: '<app></app>',
    components: { App }
})
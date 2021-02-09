/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import 'es6-promise/auto'
import axios from 'axios'
import './bootstrap'
import './fontawesome'
import Vue from 'vue'
import VueAuth from '@websanova/vue-auth'
import VueAxios from 'vue-axios'
import VueRouter from 'vue-router'
import Index from './Index'
import auth from './auth'
import router from './router'
import VueIziToast from 'vue-izitoast'
import 'izitoast/dist/css/iziToast.min.css'
import LoadScript from 'vue-plugin-load-script';
import onlyInt from 'vue-input-only-number';
import policies from './authorization/policies'
import VCalendar from 'v-calendar';
import VueMoment from 'vue-moment'

window.Vue = require('vue').default;
// Set Vue router
Vue.router = router
Vue.use(VueRouter)

// Set Vue authentication
Vue.use(VueAxios, axios)
Vue.use(VueAuth, auth)
Vue.use(VueIziToast);
Vue.use(LoadScript);
Vue.use(onlyInt);
Vue.use(VCalendar);
Vue.use(VueMoment);

Vue.prototype.authorization = policies

axios.defaults.baseURL = 'http://myapp.com:8000/api'

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('index', Index);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',

    data() {
        return {
            tags: [],
            isShowModal: -1,

            loading: false,
        }
    },

    mounted() {
        this.fetch('/tags');
    },

    methods: {
        fetch(endpoint) {
            axios.get(endpoint)
            .then(({data}) => {
                this.tags = data.data
            })
        },
    },

    router
});

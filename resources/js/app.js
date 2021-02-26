import Vue from 'vue'
import VueRouter from 'vue-router'
import Vuex from 'vuex'
import axios from 'axios'
import VueSwal from 'vue-swal'
import VueMeta from 'vue-meta'

import '@fortawesome/fontawesome-free/css/all.css'
import '@fortawesome/fontawesome-free/js/all.js'
import App from './views/app.vue'
import SignIn from './views/signin.vue'
import SignUp from './views/signup.vue'
import Search from './views/search.vue'
import Navitem from './views/nav.vue'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'

// Import Bootstrap an BootstrapVue CSS files (order is important)
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import VuexPersist from "vuex-persist";

// Make BootstrapVue available throughout your project
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)
Vue.use(VueMeta)

Vue.prototype.$axios = axios
Vue.use(Navitem)
Vue.use(Vuex)
Vue.use(VueSwal)
Vue.use(VueRouter)
Vue.component('pagination', require('laravel-vue-pagination'));





const vuexLocalStorage = new VuexPersist({
    key: 'vuex', // The key to store the state on in the storage provider.
    storage: window.localStorage, // or window.sessionStorage or localForage
    // Function that passes the state and returns the state with only the objects you want to store.
    // reducer: state => state,
    // Function that passes a mutation and lets you decide if it should update the state in localStorage.
    // filter: mutation => (true)
})
const store = new Vuex.Store({
    state: {
        count: 0,
        token:0
    },
    mutations: {
        increment (state) {
            state.count++
        },
        savetoken(state,tokenval)
        {
            state.token=tokenval;
        }
    },
    plugins: [vuexLocalStorage.plugin]

})
const routes = [

    { path: '/', component: App ,      beforeEnter: (to, from, next) => {
            if ( (store.state.token=="0")) next({ path: '/signin'})
            else next()

        }
    },
    { path: '/signin', component: SignIn },
    { path: '/signup', component: SignUp },
    {
        path: '/search/:str', component: Search, beforeEnter: (to, from, next) => {
            if ((store.state.token == "0")) next({path: '/signin'})
            else next()
        }
    }


]

const router = new VueRouter({
    mode: 'history',

    routes // short for `routes: routes`
})
const app = new Vue({
    router,
    store: store,
}).$mount('#app')

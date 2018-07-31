
import Vue from 'vue/dist/vue.js';
window.Vue = Vue;
Vue.config.debug = true;
// const debug = process.env.NODE_ENV !== 'production';

Vue.config.devTools = true;
Vue.config.productionTip = false;

import VueRouter from 'vue-router';
window.VueRouter = VueRouter;
Vue.use(VueRouter);

// import VueMaterial from 'vue-material'
// window.VueMaterial = VueMaterial;
// Vue.use(VueMaterial);

import Vuex from "vuex";
import state from "./store/state";
import mutations from "./store/mutations";
import actions from "./store/actions";
import getters from "./store/getters";

window.store = new Vuex.Store({
  state,
  getters,
  mutations,
  actions
});

import Vuetify from "vuetify";
Vue.use(Vuetify);
window.Vuetify = Vuetify;



window._ = require('lodash');
try {
    window.$ = window.jQuery = require('jquery');

    require('bootstrap-sass');
} catch (e) {}

window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}




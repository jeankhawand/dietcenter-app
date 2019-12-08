/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");
import { store } from "./store/index.js";
import routes from "./routes.js";
import VueRouter from "vue-router";
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

window.Vue = require("vue");
Vue.use(VueRouter);

import vuetify from "./vuetify";

import App from "./components/App.vue";
const router = new VueRouter({
    routes,
    mode: "history"
});
const app = new Vue({
    vuetify,
    store: store,
    router: router,
    render: h => h(App),
    el: "#app"
});

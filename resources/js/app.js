require("./bootstrap");
import {store} from "./store/index.js";
import routes from "./routes.js";
import VueRouter from "vue-router";
import vuetify from "./vuetify";
import App from "./components/App.vue";
import {abilitiesPlugin} from '@casl/vue';
import ability from './ability';

window.Vue = require("vue");
Vue.use(VueRouter);
Vue.use(abilitiesPlugin, ability);
Vue.config.productionTip = false;


const router = new VueRouter({
    routes,
    mode: "history"
});
router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        // used meta given by the router to check user logged in from vuex getters
        if (!store.getters.loggedIn) {
            next({
                name: "Login"
            });
        } else {
            next();
        }
    } else if (to.matched.some(record => record.meta.requiresVisitor)) {
        // used meta given by the router to check user if it's authenticator
        if (store.getters.loggedIn) {
            next({
                name: "Dashboard"
            });
        } else {
            next();
        }
    } else {
        next();
    }
});
const app = new Vue({
    vuetify,
    store: store,
    router: router,
    render: h => h(App),
    el: "#app"
});

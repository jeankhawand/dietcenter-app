import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex);
// we have to import each object from getters.js, mutations.js, and actions.js
import { productGetters, authGetters } from "./getters";
import { productMutations, cartMutations, authMutations} from "./mutations";
import { productActions, cartActions, authActions } from "./actions";

export const store = new Vuex.Store({
    // vuex definitions
    strict: true,
    state: {
        cart: [],
        showLoader: false,
        product: {},
        products: [],
        productsPageIndex: 1,
        token: localStorage.getItem("access_token") || null
    },
    mutations: Object.assign(
        {},
        productMutations,
        cartMutations,
        authMutations
    ),
    getters: Object.assign(
        {},
        productGetters,
        authGetters
    ),
    actions: Object.assign(
        {},
        productActions,
        cartActions,
        authActions)
});

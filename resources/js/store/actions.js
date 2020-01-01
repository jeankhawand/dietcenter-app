import axios from 'axios'
import {
    ADD_PRODUCT,
    ADD_PRODUCT_SUCCESS,
    ADD_QUANTITY_TO_CART,
    ADD_TO_CART,
    ALL_CLIENTS,
    ALL_PRODUCTS,
    ALL_PRODUCTS_NEXT_PAGE_SUCCESS,
    ALL_PRODUCTS_SUCCESS,
    DESTROY_TOKEN,
    DESTROY_USER_INFO,
    EMPTY_CART,
    GET_USER_INFO,
    PRODUCT_BY_ID,
    PRODUCT_BY_ID_SUCCESS,
    REMOVE_FROM_CART,
    REMOVE_PRODUCT,
    REMOVE_PRODUCT_SUCCESS,
    REMOVE_QUANTITY_FROM_CART,
    RETRIEVE_TOKEN,
    UPDATE_PRODUCT,
    UPDATE_PRODUCT_SUCCESS,
    UPDATE_SESSION_STORAGE_CART
} from './mutation-types'
// -------- PLEASE ENCAPSULATE AXIOS REQUEST WITH PROMISE BLOCK !!! -------
axios.defaults.baseURL = process.env.MIX_API_ENDPOINT;
export const productActions = {
    allProducts({commit}) {
        commit(ALL_PRODUCTS)
        axios.get(`recipes`).then(response => {
            commit(ALL_PRODUCTS_SUCCESS, response.data)
        })
    },
    allProductsNextPage({commit}, index) {
        commit(ALL_PRODUCTS)
        axios.get(`recipes?page=` + index).then(response => {
            commit(ALL_PRODUCTS_NEXT_PAGE_SUCCESS, response.data)
        })
    },
    productById({commit}, payload) {
        commit(PRODUCT_BY_ID)
        axios.get(`products/${payload}`).then(response => {
            commit(PRODUCT_BY_ID_SUCCESS, response.data)
        })
    },
    addProduct({commit}, payload) {
        commit(ADD_PRODUCT)
        axios.post(`products`, payload).then(response => {
            commit(ADD_PRODUCT_SUCCESS, response.data)
        })
    },
    updateProduct({commit}, payload) {
        commit(UPDATE_PRODUCT)
        axios.put(`products/${payload._id}`, payload).then(response => {
            commit(UPDATE_PRODUCT_SUCCESS, response.data)
        })
    },
    removeProduct({commit}, payload) {
        commit(REMOVE_PRODUCT)
        axios.delete(`products/${payload}`, payload).then(response => {
            commit(REMOVE_PRODUCT_SUCCESS, response.data)
        })
    }
}

export const cartActions = {
    addToCart({commit}, payload) {
        commit(ADD_TO_CART, payload)
        commit(UPDATE_SESSION_STORAGE_CART)
    },
    removeFromCart({commit}, payload) {
        commit(REMOVE_FROM_CART, payload)
        commit(UPDATE_SESSION_STORAGE_CART)
    },
    addQuantityToCart({commit}, payload) {
        commit(ADD_QUANTITY_TO_CART, payload)
        commit(UPDATE_SESSION_STORAGE_CART)
    },
    removeQuantityFromCart({commit}, payload) {
        commit(REMOVE_QUANTITY_FROM_CART, payload)
        commit(UPDATE_SESSION_STORAGE_CART)
    }
}

export const authActions = {
    destroyToken(context) {
        // setup destroy token in order once user login he have to provide the authorization which is
        // the access_token in this case and this logout route will handle delete session created for this
        // particular user
        axios.defaults.headers.common["Authorization"] =
            "Bearer " + context.state.token;

        if (context.getters.loggedIn) {
            return new Promise((resolve, reject) => {
                axios
                    .post("logout")
                    .then(response => {
                        localStorage.removeItem("access_token");
                        context.commit(DESTROY_TOKEN);
                        localStorage.removeItem("user");
                        context.commit(DESTROY_USER_INFO);
                        resolve(response);
                    })
                    .catch(error => {
                        localStorage.removeItem("access_token");
                        context.commit(DESTROY_TOKEN);
                        localStorage.removeItem("user");
                        context.commit(DESTROY_USER_INFO);
                        reject(error);
                    });
            });
        }
    },
    retrieveToken(context, credentials) {
        /*
        once user provide username / password we handle the recieve of the access_token

         */
        return new Promise((resolve, reject) => {
            axios
                .post("login", {
                    username: credentials.username,
                    password: credentials.password
                })
                .then(response => {
                    console.log(response);
                    const token = response.data.access_token;

                    localStorage.setItem("access_token", token);
                    context.commit(RETRIEVE_TOKEN, token);
                    resolve(response);
                })
                .catch(error => {
                    console.log(error);
                    reject(error);
                });
        });
    },
    getUserInfo(context) {
        /*
        once user provide username / password we handle the recieve of the access_token

         */
        return new Promise((resolve, reject) => {
            axios.get("user", {
                params: {}, headers: {
                    Authorization: "Bearer " + context.state.token,
                    Accept: "application/json"
                }
            })
                .then(response => {
                    const user = response.data.data;
                    localStorage.setItem("user", JSON.stringify(user));
                    context.commit(GET_USER_INFO, user);
                    resolve(response);
                })
                .catch(error => {
                    console.log(error);
                    reject(error);
                });
        });
    },

    checkout(context, data) {
        /*
        checkout token

         */
        //Empty Cart in session storage and in state


        return new Promise((resolve, reject) => {
            axios
                .post(
                    "/checkout/auth",
                    {
                        stripetoken: data.stripetoken,
                        amount: data.amount,
                        meta: data.meta,
                    },
                    {
                        headers: {
                            Authorization: "Bearer " + context.state.token,
                            Accept: "application/json",
                        }

                    }
                )
                .then(response => {
                    console.log(response);
                    sessionStorage.removeItem("cart");
                    context.commit(EMPTY_CART);
                    resolve(response);
                })
                .catch(error => {
                    console.log(error);
                    reject(error);
                });
        });
    },
    checkoutNonAuth(context, data) {
        /*
        checkout token

         */



        return new Promise((resolve, reject) => {
            axios
                .post("/checkout", {
                    email: data.email,
                    phonenumber: data.phonenumber,
                    stripetoken: data.stripetoken,
                    amount: data.amount,
                    meta: data.meta,
                })
                .then(response => {
                    console.log(response);
                    //Empty Cart in session storage and in state
                    sessionStorage.removeItem("cart");
                    context.commit(EMPTY_CART);
                    resolve(response);
                })
                .catch(error => {
                    console.log(error);
                    reject(error);
                });
        });
    },
    register(context, data) {
        return new Promise((resolve, reject) => {
            axios
                .post("register", {
                    name: data.name,
                    email: data.email,
                    password: data.password
                })
                .then(response => {
                    resolve(response);
                })
                .catch(error => {
                    reject(error);
                });
        });
    },

    allClient({commit}) {
        commit(ALL_CLIENTS)
        axios.get(`clients`).then(response => {
            commit(ALL_CLIENTS_SUCCESS, response.data)
        })
    }
}

import {ADD_QUANTITY_TO_CART,REMOVE_QUANTITY_FROM_CART,ADD_PRODUCT,ADD_PRODUCT_SUCCESS,PRODUCT_BY_ID,PRODUCT_BY_ID_SUCCESS,UPDATE_PRODUCT,UPDATE_PRODUCT_SUCCESS,REMOVE_PRODUCT,REMOVE_PRODUCT_SUCCESS,ADD_TO_CART,REMOVE_FROM_CART,ALL_PRODUCTS,ALL_PRODUCTS_SUCCESS,ERROR_MSG,DESTROY_TOKEN,RETRIEVE_TOKEN
} from './mutation-types'

export const productMutations = {
  [ALL_PRODUCTS] (state) {
    state.showLoader = true
  },
  [ALL_PRODUCTS_SUCCESS] (state, payload) {
    state.showLoader = false
    state.products = payload
  },
  [PRODUCT_BY_ID] (state) {
    state.showLoader = true
  },
  [PRODUCT_BY_ID_SUCCESS] (state, payload) {
    state.showLoader = false
    state.product = payload
  },
  [ADD_PRODUCT]: (state) => {
    state.showLoader = true
  },
  [ADD_PRODUCT_SUCCESS]: (state, payload) => {
    state.showLoader = false
    state.products.push(payload)
  },
  [UPDATE_PRODUCT]: (state) => {
    state.showLoader = true
  },
  [UPDATE_PRODUCT_SUCCESS]: (state, payload) => {
    state.showLoader = false
    state.products = state.products.map(p => {
      if (p._id === payload._id) {
        payload = {...payload, manufacturer: state.manufacturers.filter(x => x._id === payload.manufacturer)[0]}
        return payload
      }
      return p
    })
  },
  [REMOVE_PRODUCT]: (state) => {
    state.showLoader = true
  },
  [REMOVE_PRODUCT_SUCCESS]: (state, payload) => {
    state.showLoader = false
    const index = state.products.findIndex(p => p._id === payload)
    state.products.splice(index, 1)
  },
  [ERROR_MSG] () {}
}

export const cartMutations = {
  [ADD_TO_CART]: (state, payload) => {
    if(state.cart.some(recipe => recipe.id == payload.id)){
        state.cart.find((recipe) => { return recipe.id === payload.id }).quantity++
    }
    else{
        payload.quantity = 1
        state.cart.push(payload)
    }
  },
  [REMOVE_FROM_CART]: (state, payload) => {
    const index = state.cart.findIndex(p => p._id === payload.id)
    state.cart.splice(index, 1)
  },
  [ADD_QUANTITY_TO_CART]: (state, payload) => {
    state.cart.find((recipe) => { return recipe.id === payload.id }).quantity++
  },
  [REMOVE_QUANTITY_FROM_CART]: (state, payload) => {
      if(payload.quantity == 1){
        const index = state.cart.findIndex(p => p._id === payload.id)
        state.cart.splice(index, 1)
      }
      else{
        state.cart.find((recipe) => { return recipe.id === payload.id }).quantity--
      }
  }
}

export const authMutations = {
    // this mutation it's trigger when logout component it's created
    [DESTROY_TOKEN] (state) {
        state.token = null;
    },
    // it does receive a state and destroy token saved in local storage
    //  PS : I have later on to hash the access token or store it safely but for the time being we have to stick with that
    [RETRIEVE_TOKEN] (state,token){
        state.token = token;
    }


}

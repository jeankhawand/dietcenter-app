<template>
  <div v-if="cart.length > 0">
    <div class="title">
      <h1><i class="fa fa-shopping-cart"></i> Your Cart</h1>
    </div>
    <template>
        <div>
            <v-container class="my-5">
                <v-layout row wrap>
                    <v-flex xs12 sm6 md4 v-for="product in cart" :key="product.id">
                        <RecipeItem :product="product" />
                    </v-flex>
                </v-layout>
            </v-container>
        </div>
    </template>
  </div>
  <div v-else class="title"><h1><i class="fa fa-shopping-cart"></i> Your Cart is Empty</h1></div>
</template>

<script>
  import RecipeItem from "../recipe/RecipeItem";
  export default {
    data () {
      return {
        cart: this.$store.state.cart
      }
    },
    components: {
        RecipeItem
    }
  }
</script>

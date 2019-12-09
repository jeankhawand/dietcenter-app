<template>
  <div v-if="cart.length > 0">
      <template>
          <v-stepper v-model="e1" :vertical="vertical"
                     :alt-labels="altLabels">
              <v-stepper-header>
                  <v-stepper-step :editable="editable" :complete="e1 > 1" step="1">Cart</v-stepper-step>

                  <v-divider></v-divider>

                  <v-stepper-step :editable="editable" :complete="e1 > 2" step="2">Fill Your Info</v-stepper-step>

                  <v-divider></v-divider>

                  <v-stepper-step :editable="editable" step="3">Checkout</v-stepper-step>
              </v-stepper-header>

              <v-stepper-items>
                  <v-stepper-content step="1">
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
                      <v-btn
                          color="primary"
                          @click="e1 = 2"
                      >
                          Continue
                      </v-btn>
                  </v-stepper-content>

                  <v-stepper-content step="2">
                      <v-btn
                          color="primary"
                          @click="e1 = 3"
                      >
                          Continue
                      </v-btn>
                  </v-stepper-content>

                  <v-stepper-content step="3">

                  </v-stepper-content>
              </v-stepper-items>
          </v-stepper>
      </template>

  </div>
  <div v-else class="title"><h1><i class="fa fa-shopping-cart"></i> Your Cart is Empty</h1></div>
</template>

<script>
    import RecipeItem from "../recipe/RecipeItem";

    export default {
    data () {
      return {
        cart: this.$store.state.cart,
          e1: 0,
          altLabels: false,
          editable: true,
      }
    },
    components: {
        RecipeItem
    }
  }
</script>

<template>
  <div v-if="cart.length > 0">
      <template>
          <v-stepper v-model="e1"
                     :alt-labels="altLabels">
              <v-stepper-header>
                  <v-stepper-step :editable="editable" :complete="e1 > 1" step="1">Cart</v-stepper-step>

                  <v-divider></v-divider>

                  <v-stepper-step :editable="editable" :complete="e1 > 2" step="2">Checkout</v-stepper-step>

              </v-stepper-header>

              <v-stepper-items>
                  <v-stepper-content step="1">
                    <div style="text-align:right;fontSize:1.5em"><b>SubTotal :</b> ${{getSubtotal}}</div>
                      <template>
                          <div>
                              <v-container class="my-5">
                                  <v-layout row wrap>
                                      <v-flex xs12 sm6 md4 v-for="product in cart" :key="product.id">
                                          <RecipeCart :product="product" />
                                      </v-flex>
                                      
                                  </v-layout>
                                  <v-btn
                          color="primary"
                          @click="e1 = 2"
                      >
                          Continue
                      </v-btn>
                              </v-container>
                          </div>
                      </template>
                
                      
                      
                  </v-stepper-content>

                  <v-stepper-content step="2">
                      <PaymentForm></PaymentForm>
                  </v-stepper-content>

              </v-stepper-items>
          </v-stepper>
      </template>

  </div>
  <div v-else class="title empty"><h1><v-icon size="80">mdi-cart-remove</v-icon> Your Cart is Empty</h1></div>
</template>

<script>
    import RecipeCart from "../recipe/RecipeCart";
    import PaymentForm from "../Payment/PaymentForm";

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
        PaymentForm,
        RecipeCart
    },
        computed:{
             getSubtotal() {
      return this.$store.getters.cartTotalProductsCost;
   }

        }
  }
</script>

<style scoped>
 .empty{
    position: absolute;
  margin: auto;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  width: 430px;
  height: 100px;
 }
</style>

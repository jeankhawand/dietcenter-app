<template>
  <div v-if="cart.length > 0">
      <template>
          <v-stepper v-model="e1"
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
                                          <RecipeCart :product="product" />
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
                      <CardForm
                          :form-data="formData"
                          @input-card-number="updateCardNumber"
                          @input-card-name="updateCardName"
                          @input-card-month="updateCardMonth"
                          @input-card-year="updateCardYear"
                          @input-card-cvv="updateCardCvv"
                      />
                  </v-stepper-content>
              </v-stepper-items>
          </v-stepper>
      </template>

  </div>
  <div v-else class="title empty"><h1><v-icon size="80">mdi-cart-remove</v-icon> Your Cart is Empty</h1></div>
</template>

<script>
    import RecipeCart from "../recipe/RecipeCart";
    import CardForm from "../Card/CardForm";

    export default {
    data () {
      return {
        cart: this.$store.state.cart,
          e1: 0,
          altLabels: false,
          editable: true,
          formData: {
              cardName: '',
              cardNumber: '',
              cardMonth: '',
              cardYear: '',
              cardCvv: ''
          }
      }
    },
    components: {
        RecipeCart,
        CardForm
    },
        methods:{
            updateCardNumber (val) {
            },
            updateCardName (val) {
            },
            updateCardMonth (val) {
            },
            updateCardYear (val) {
            },
            updateCardCvv (val) {
            }
        }
  }
</script>
<style lang="scss">
    //  @import '../Card/style.scss';
    .empty{
    position: absolute;
    width: 40%;
    height: 40%;
    top: 30%;
    left: 30%;
    }
</style>

<template>
<v-container>
        <v-layout align-center >
            <v-flex xs12 sm6 offset-sm3>
                <v-card class="elevation-12" >
                     <v-toolbar dark color="green">

                <v-toolbar-title>Fill Your Info</v-toolbar-title>

                <v-spacer></v-spacer>



              </v-toolbar>
    <v-card-text>
        <v-alert id="card-errors" ref="message" role="alert" v-if="errorMessage" :type="errorType">
            {{errorMessage}}
        </v-alert>
        <v-text-field
            v-if="!loggedIn"
            label="First Name"
            v-model="firstname" :rules="firstnameRules" required></v-text-field>
        <v-text-field
            v-if="!loggedIn"
            label="Last Name"
            v-model="lastname" :rules="lastnameRules" required></v-text-field>
        <v-text-field
            v-if="!loggedIn"
            label="Phone Number"
            v-model="phonenumber" :rules="phonenumberRules" required></v-text-field>
        <v-text-field
            v-if="!loggedIn"
            label="Email"
            v-model="email" :rules="emailRules" type="email" required></v-text-field>

        <card class='stripe-card mb-5 mt-2'
              :class='{ complete }'
              stripe='pk_test_4S7dtz39zfwDh1YkcvBQfPs300tsPZAiB9'
              :options='stripeOptions'
              @change='complete = $event.complete || change($event)'
        />

        <v-btn
            color="primary"
            @click='pay();overlay = !overlay;'
            :disabled='!complete'
            >
            Checkout
        </v-btn>
        <v-overlay :value="overlay">

            <v-card
                class="mx-auto text-center"
                max-width="600"
                color="rgba(0, 0, 0, 0.0)"
                flat
            >
                <v-icon color="green" size="300">mdi-check-circle</v-icon>
                <v-divider></v-divider>
                <v-card-text>
                    <v-btn to="/" color="black"
                           class="white--text">
                        BACK TO SHOP
                    </v-btn>
                </v-card-text>

            </v-card>
        </v-overlay>
    </v-card-text>
                </v-card>
            </v-flex>
        </v-layout>
</v-container>
</template>

<script>
    import {Card, createToken} from 'vue-stripe-elements-plus'

    let result;
    export default {
        components: {Card},
        data() {
            return {
                overlay: false,
                firstname: '',
                lastname: '',
                phonenumber: '',
                email: '',
                cart: this.$store.state.cart,
                complete: false,
                errorMessage: '',
                errorType: 'error',
                emailRules: [
                    v => !!v || 'E-mail is required',
                    v => /.+@.+\..+/.test(v) || 'E-mail must be valid',
                ],
                firstnameRules: [
                    v => !!v || 'First Name is required',
                    v => /^[A-Za-z]+$/.test(v) || 'First Name must be valid',
                ],
                lastnameRules: [
                    v => !!v || 'Last Name is required',
                    v => /^[A-Za-z]+$/.test(v) || 'Last Name must be valid',
                ],

                phonenumberRules: [
                    v => !!v || 'Phone Number is required',
                    v => /^[0-9]{8,10}$/.test(v) || 'Phone Number must be valid',
                ],

                stripeOptions: {
                    // see https://stripe.com/docs/stripe.js#element-options for details
                    style: {
                        base: {
                            color: '#32325d',
                            lineHeight: '18px',
                            fontFamily: '"Raleway", Helvetica, sans-serif',
                            fontSmoothing: 'antialiased',
                            fontSize: '16px',
                            '::placeholder': {
                                color: '#aab7c4'
                            }
                        },
                        invalid: {
                            color: '#fa755a',
                            iconColor: '#fa755a'
                        }
                    },
                    hidePostalCode: true
                }
            }
        },
        mounted() {
            function replacer(key,value)
            {
                if (key=="image") return undefined;
                else if (key=="description") return undefined;
                else return value;
            }
            // console.log(this.cart[0].description);
            result = JSON.stringify(this.cart,replacer);
        },
        computed:{
            loggedIn() {
                return this.$store.getters.loggedIn;
            },
        },
        methods: {


            getSubtotal() {
                return this.$store.getters.cartTotalProductsCost;
            },
            pay() {
                console.log(this.cart);
                console.log(this.getSubtotal());
                var options = {
                    name: this.firstname + ' '+this.lastname,
                    address_country: 'LB',
                }
                createToken(options)
                    .then(data => {
                        console.log(data.token.id);
                        console.log(result);
                        console.log(this.loggedIn);
                        if (this.loggedIn){
                            console.log('loggedin');
                            this.$store.dispatch("checkout", {
                                amount: this.getSubtotal(),
                                stripetoken: data.token.id,
                                meta: result,
                            }).then(response => {
                                // console.log(response);

                                console.log(this.$refs);
                                this.errorType = 'success';
                                this.errorMessage = response.data;
                                // this.loading = false;
                                // this.$router.push({ name: "Success" });
                            }).catch(error => {
                                // console.log(error.response.data),

                                this.errorMessage = error.response.data;

                            })
                        }else if(!this.loggedIn){
                            console.log('not logged'),
                            this.$store.dispatch("checkoutNonAuth", {
                                email: this.email,
                                phonenumber: this.phonenumber,
                                amount: this.getSubtotal(),
                                stripetoken: data.token.id,
                                meta: result,
                            }).then(response => {
                                // console.log(response);

                                console.log(this.$refs);
                                this.errorType = 'success';
                                this.errorMessage = response.data;
                                // this.loading = false;
                                // this.$router.push({ name: "Success" });
                            }).catch(error => {
                                // console.log(error.response.data),

                                this.errorMessage = error.response.data;

                            })
                        }



                    }).catch(error => {
                    // console.log(error.response.data),

                        (this.errorMessage = error.response.data);
                    // this.loading = false;
                });
            },
            change(event) {
                // if (event.error) {
                //   this.errorMessage = event.error.message;
                // } else {
                //   this.errorMessage = ''
                // }
                this.errorType = 'error';
                this.errorMessage = event.error ? event.error.message : ''
            },

        }
    }
</script>

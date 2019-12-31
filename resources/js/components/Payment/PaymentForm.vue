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
            label="First Name"
            v-model="firstname" required></v-text-field>
        <v-text-field
            label="Last Name"
            v-model="lastname" required></v-text-field>
        <v-text-field
            label="Phone Number"
            v-model="phonenumber" required></v-text-field>
        <v-text-field
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
   

    export default {
        components: {Card},
        data() {
            return {
                overlay: false,
                firstname: '',
                lastname: '',
                phonenumber: '',
                email: '',
                complete: false,
                errorMessage: '',
                errorType: 'error',
                emailRules: [
                    v => !!v || 'E-mail is required',
                    v => /.+@.+\..+/.test(v) || 'E-mail must be valid',
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
        methods: {
       
            pay() {
                var options = {
                    name: this.firstname + ' ' + this.lastname,
                }
                // createToken returns a Promise which resolves in a result object with
                // either a token or an error key.
                // See https://stripe.com/docs/api#tokens for the token object.
                // See https://stripe.com/docs/api#errors for the error object.
                // More general https://stripe.com/docs/stripe.js#stripe-create-token.
                createToken(options)
                    .then(data => {
                        console.log(data.token.id)
                        this.$store.dispatch("checkout", {
                            email: this.email,
                            stripetoken: data.token.id,
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

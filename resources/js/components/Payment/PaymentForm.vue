<template>
    <div>
        <v-alert id="card-errors" ref="message" role="alert" v-if="errorMessage" type="error">
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

        <card class='stripe-card'
              :class='{ complete }'
              stripe='pk_test_4S7dtz39zfwDh1YkcvBQfPs300tsPZAiB9'
              :options='stripeOptions'
              @change='complete = $event.complete || change($event)'
        />

        <v-btn
            color="primary"
            @click='pay'
            :disabled='!complete'
        >
            Checkout
        </v-btn>

    </div>
</template>

<script>
    import {Card, createToken} from 'vue-stripe-elements-plus'

    export default {
        components: {Card},
        data() {
            return {
                firstname: '',
                lastname: '',
                phonenumber: '',
                email: '',
                complete: false,
                errorMessage: '',
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
                            // this.$refs.message.setAttribute("type","success");
                            this.errorMessage = response.data;
                            // this.loading = false;
                            // this.$router.push({ name: "Home" });
                        }).catch(error => {
                            // console.log(error.response.data),
                            // this.$refs.message.setAttribute("type","error");
                                this.errorMessage = error.response.data;
                            // this.loading = false;
                        })
                        // console.log(data.token)

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
                this.errorMessage = event.error ? event.error.message : ''
            }
        }
    }
</script>

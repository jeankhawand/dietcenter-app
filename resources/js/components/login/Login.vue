<template>
    <v-container>
        <v-layout row>
            <v-flex xs12 sm6 offset-sm3>
                <v-card>
                    <v-card-text>
                        <v-container>
                            <form @submit.prevent="login">
                                <v-layout row>
                                    <v-flex xs12>
                                        <v-text-field
                                            name="email"
                                            label="Email/Username"
                                            id="email"
                                            v-model="email"
                                            type="email"
                                            required
                                        ></v-text-field>
                                    </v-flex>
                                </v-layout>
                                <v-layout row>
                                    <v-flex xs12>
                                        <v-text-field
                                            name="password"
                                            label="Password"
                                            id="password"
                                            v-model="password"
                                            type="password"
                                            required
                                        ></v-text-field>
                                    </v-flex>
                                </v-layout>

                                <v-layout row>
                                    <v-flex xs12>
                                        <v-btn type="submit">Login</v-btn>
                                    </v-flex>
                                </v-layout>
                            </form>
                        </v-container>
                    </v-card-text>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
export default {
    data() {
        return {
            email: "",
            password: ""
        };
    },
    computed: {
        loggedIn() {
            return this.$store.getters.loggedIn;
        }
    },
    methods: {
        login() {
            this.$store
                .dispatch("retrieveToken", {
                    username: this.email,
                    password: this.password
                })
                .then(response => {
                    console.log(response);
                    this.$router.push({ name: "Home" });
                })
                .catch(error => {
                    console.log(error.response.data),
                        (this.errorMessage = error.response.data),
                        (this.password = "");
                });
        }
    }
};
</script>

<template>
    <v-card color="grey lighten-4" flat height="50px" tile>
        <v-toolbar dense>
           

            <v-toolbar-title @click="goBack()">Diet Center</v-toolbar-title>
            <v-btn @click="goDashboard()" v-if="loggedIn" icon>
                <v-icon>mdi-account-badge-horizontal-outline</v-icon>
            </v-btn>
            <v-spacer></v-spacer>

            <v-btn v-if="!loggedIn" @click="loginIn()" class="ma-2" color="indigo" dark>Login
                <v-icon dark right>fas fa-lock</v-icon>
            </v-btn>
            <v-avatar v-if="loggedIn">
                <img
                    src="https://cdn.vuetifyjs.com/images/john.jpg"
                    alt="John"
                />
            </v-avatar>
            <v-btn @click="logout()" v-if="loggedIn" icon>
                <v-icon>mdi-export</v-icon>
            </v-btn>
        </v-toolbar>
    </v-card>
</template>
<script>
export default {
    name: "Navbar",
    computed: {
        loggedIn(){
            return this.$store.getters.loggedIn
        }
    },
    methods:{
        logout() {
            this.$router.push({name: 'Logout'});
        },
        loginIn() {
            this.$router.push({name: 'Login'});
        },
        goBack(){
            this.$router.push({name: 'Home'});
        },
        goDashboard(){
               this.$router.push({name: 'AdminDashboard'});
        }

    }
};
</script>

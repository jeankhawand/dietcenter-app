<template>

  <v-app>

    <v-navigation-drawer v-if="loggedIn"

      v-model="primaryDrawer.model"

      :clipped="primaryDrawer.clipped"

      :floating="primaryDrawer.floating"

      :mini-variant="primaryDrawer.mini"

      :permanent="primaryDrawer.type === 'permanent'"

      :temporary="primaryDrawer.type === 'temporary'"

      app

      overflow

    >
      <v-list dense>

        <v-list-item @click="goDashboard()">

          <v-list-item-action>

            <v-icon>mdi-home</v-icon>

          </v-list-item-action>

          <v-list-item-content>

            <v-list-item-title>Home</v-list-item-title>

          </v-list-item-content>

        </v-list-item>

        <v-list-item link>

          <v-list-item-action>

            <v-icon>mdi-contact-mail</v-icon>

          </v-list-item-action>

          <v-list-item-content>

            <v-list-item-title>Contact</v-list-item-title>

          </v-list-item-content>

        </v-list-item>
         

            <v-switch class="py-0"

                      v-model="$vuetify.theme.dark"

                      primary

                      label="Dark"

                    />

      </v-list>
    </v-navigation-drawer>



    <v-app-bar

      :clipped-left="primaryDrawer.clipped"

      app

    >

      <v-app-bar-nav-icon

        v-if="primaryDrawer.type !== 'permanent' && loggedIn"

        @click.stop="primaryDrawer.model = !primaryDrawer.model"

      />

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

    </v-app-bar>



    


    <v-footer
      absolute
      class="font-weight-medium"
    >
      <v-col
        class="text-center"
        cols="12"
      >
        {{ new Date().getFullYear() }} — <strong>Vuetify</strong>
      </v-col>
    </v-footer>

  </v-app>

</template>



<script>

  export default {
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

    },

    data: () => ({

      primaryDrawer: {

        model: null,

        type: 'temporary',

        clipped: false,

        floating: false,

        mini: false,

      },

      footer: {

        inset: true,

      },

    }),

  }

</script>


 

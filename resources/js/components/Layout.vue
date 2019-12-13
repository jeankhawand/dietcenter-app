<template>
  <v-app>
    <v-navigation-drawer
      v-model="drawer"
      app
      disable-route-watcher
      expand-on-hover
      v-if="loggedIn"
    >
      <v-list dense>
        <v-list-item to="/dashboard">
          <v-list-item-action>
            <v-icon>mdi-home</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Dashboard</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item to="/revenue">
          <v-list-item-action>
            <v-icon>mdi-contact-mail</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Revenue</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>
        

    <v-app-bar
      app
      color="green"
      dark
    >
      <v-app-bar-nav-icon @click.stop="drawer = !drawer" v-if="loggeIn"/>
      <v-toolbar-title @click="goBack()" >Diet Center</v-toolbar-title>
       <v-spacer></v-spacer>
        <v-text-field
            v-model="search"
            clearable
            flat
            solo-inverted
            hide-details
            label="Search"
        ></v-text-field>
      <v-spacer></v-spacer>
 
      <v-btn v-if="!loggedIn" @click="goCart()" text class="ma-2" color="indigo" dark>
        <span class="hidden-sm-and-down">Cart</span>
        <v-badge>
          <template v-slot:badge>{{ cartItems }}</template>
          <v-icon dark right>fas fa-shopping-cart</v-icon>
        </v-badge>
      </v-btn>

      <v-btn v-if="!loggedIn" text @click="loginIn()" class="ma-2" color="indigo" dark>
          <span class="hidden-sm-and-down">Login</span>
        <v-icon dark right>fas fa-lock</v-icon>
      </v-btn>
      <v-avatar v-if="loggedIn">
        <img src="https://cdn.vuetifyjs.com/images/john.jpg" alt="John" />
      </v-avatar>
      <v-btn @click="logout()" v-if="loggedIn" icon>
        <v-icon>mdi-export</v-icon>
      </v-btn>
    </v-app-bar>
        <v-content>
            <v-container>
              <router-view></router-view>
            </v-container>
          </v-content>
    <v-footer
      color="green"
      app
    >
      <span class="white--text">&copy; 2019</span>
    </v-footer>
  </v-app>
</template>

<script>

  export default {
    props: {
      source: String,
    },
    data: () => ({
      drawer: null,
       search: '',
    }),
     computed: {
    loggedIn() {
      return this.$store.getters.loggedIn;
    },
    cartItems() {
        return this.$store.state.cart.length;
    }
  },
  methods: {
    logout() {
      this.$router.push({ name: "Logout" });
    },
    loginIn() {
      this.$router.push({ name: "Login" });
    },
    goBack() {
      this.$router.push({ name: "Home" });
    },
    goCart() {
      this.$router.push({ name: "Cart" });
    }
  }
  }
</script>
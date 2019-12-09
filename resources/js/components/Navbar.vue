<template>
  <v-card color="grey lighten-4" flat height="50px" tile>
    <v-toolbar dense>
      <v-app-bar-nav-icon v-if="loggedIn"></v-app-bar-nav-icon>

      <v-toolbar-title @click="goBack()">Diet Center</v-toolbar-title>
        <v-spacer></v-spacer>
        <v-text-field
            v-model="search"
            clearable
            flat
            solo-inverted
            hide-details
            prepend-inner-icon="search"
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
    </v-toolbar>
  </v-card>
</template>
<script>
export default {
  name: "Navbar",
    data () {
      return {
          search: '',
      }
    },
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
};
</script>

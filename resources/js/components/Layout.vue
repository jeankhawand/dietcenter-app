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
        <v-list-item to="/dashboard/revenue">
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
      <v-app-bar-nav-icon @click.stop="drawer = !drawer" v-if="loggedIn"/>
      <v-toolbar-title @click="goBack()" >Diet Center</v-toolbar-title>
       <v-spacer></v-spacer>
        <v-text-field
            class="hidden-md-and-down"
            v-model="search"
            clearable
            flat
            solo-inverted
            hide-details
            label="Search"
        @keyup.enter="searchit"></v-text-field>
      <v-spacer></v-spacer>
        <v-btn  class="d-lg-none d-md" icon>
            <v-icon>mdi-magnify</v-icon>
        </v-btn>
        <v-btn v-if="loggedIn" class="hidden-sm-and-down" icon @click="handleFullScreen()">
            <v-icon>mdi-fullscreen</v-icon>
        </v-btn>
      <v-btn icon @click="goCart()" >
        <v-badge color="red" overlap >
          <template v-slot:badge>{{ cartItems }}</template>
          <v-icon dark medium>mdi-cart</v-icon>
        </v-badge>
      </v-btn>

      <v-btn v-if="!loggedIn" icon @click="loginIn()" >
        <v-icon dark medium>fas fa-lock</v-icon>
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
    },

  },
  methods: {
        searchit(){
            console.log('searching ..');
        },

      handleFullScreen() {

              let doc = window.document;
              let docEl = doc.documentElement;

              let requestFullScreen = docEl.requestFullscreen || docEl.mozRequestFullScreen || docEl.webkitRequestFullScreen || docEl.msRequestFullscreen;
              let cancelFullScreen = doc.exitFullscreen || doc.mozCancelFullScreen || doc.webkitExitFullscreen || doc.msExitFullscreen;

              if (!doc.fullscreenElement && !doc.mozFullScreenElement && !doc.webkitFullscreenElement && !doc.msFullscreenElement) {
                  requestFullScreen.call(docEl);
              }
              else {
                  cancelFullScreen.call(doc);
              }
      },
    logout() {

      this.$router.push({ name: "Logout" });
    },
    loginIn() {
        if(this.$router.history.current.path === '/login'){
            return;
        }
      this.$router.push({ name: "Login" });
    },
    goBack() {
        if(this.$router.history.current.path === '/'){
            return;
        }
      this.$router.push({ name: "Home" });
    },
    goCart() {
        if(this.$router.history.current.path === '/cart'){
        return;
        }
      this.$router.push({ name: "Cart" });
    }
  }
  }
</script>

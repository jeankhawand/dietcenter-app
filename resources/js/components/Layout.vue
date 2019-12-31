<template>
  <v-app>
    <v-navigation-drawer v-model="drawer" color="green" app disable-route-watcher expand-on-hover v-if="loggedIn">
      <v-list dense>
        <v-list-item class="drawer" to="/admin/dashboard">
          <v-list-item-action>
            <v-icon color="white">mdi-home</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title style="color:white">Dashboard</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item to="/admin/revenue">
          <v-list-item-action>
            <v-icon color="white">mdi-currency-usd</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title style="color:white">Revenue</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item to="/client/client_dashboard">
          <v-list-item-action>
            <v-icon color="white" >mdi-home</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title style="color:white">Dashboard</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>
      <template v-slot:append>



        <v-list-item class="pa-2" icon @click="logout()">
          <v-list-item-action>
            <v-btn text >
              <v-icon color="white">mdi-export</v-icon>
            </v-btn>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title style="color:white">Logout</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </template>
    </v-navigation-drawer>

    <v-app-bar  inset color="green" fixed app dark>
      <v-app-bar-nav-icon @click.stop="drawer = !drawer" v-if="loggedIn" />
      <v-toolbar-title @click="goBack()">Diet Center</v-toolbar-title>
      <v-spacer></v-spacer>
      <v-text-field
        class="hidden-md-and-down"
        v-model="search"
        clearable
        flat
        solo-inverted
        hide-details
        label="Search"
        @keyup.enter="searchit"
      ></v-text-field>
      <v-spacer></v-spacer>
      <v-btn class="d-lg-none d-md" icon>
        <v-icon>mdi-magnify</v-icon>
      </v-btn>
      <v-btn v-if="loggedIn" class="hidden-sm-and-down" icon @click="handleFullScreen()">
        <v-icon>mdi-fullscreen</v-icon>
      </v-btn>
      <v-btn icon @click="goCart()">
        <v-badge color="red" overlap>
          <template v-slot:badge>{{ cartItems }}</template>
          <v-icon dark medium>mdi-cart</v-icon>
        </v-badge>
      </v-btn>

      <v-btn v-if="!loggedIn" icon @click="loginIn()">
        <v-icon dark medium>fas fa-lock</v-icon>
      </v-btn>
      <div class="text-center">
    <v-menu
      v-model="menu"
      :close-on-content-click="false"
      :nudge-width="200"
      offset-x
    >
      <template v-slot:activator="{ on }">
        <v-btn
          flat
          v-on="on"
          icon
        >
          <v-icon>mdi-account</v-icon>
        </v-btn>
      </template>

      <v-card>
        <v-list>
          <v-list-item>
            <v-list-item-avatar>
              <img src="https://cdn.vuetifyjs.com/images/john.jpg" alt="John">
            </v-list-item-avatar>

            <v-list-item-content>
              <v-list-item-title>Toni Haydamous</v-list-item-title>
              <v-list-item-subtitle>Diet Center</v-list-item-subtitle>
            </v-list-item-content>

          </v-list-item>
        </v-list>

        <v-divider></v-divider>

        <v-list>
          <v-list-item>

            <v-list-item-action>
          <v-switch v-model="$vuetify.theme.dark" inset color="black" />
            </v-list-item-action>
            <v-list-item-title>Dark Mode</v-list-item-title>
          </v-list-item>

          <v-list-item to="/editprofile">
            <v-list-item-action>
              <v-icon>mdi-account-edit</v-icon>
            </v-list-item-action>
            <v-list-item-title>Edit Profile</v-list-item-title>
          </v-list-item>
        </v-list>

        <v-card-actions>
          <v-spacer></v-spacer>

          <v-btn color="primary" text @click="menu = false">Done</v-btn>
        </v-card-actions>
      </v-card>
    </v-menu>
  </div>
    </v-app-bar>
    <v-content>
      <router-view></router-view>
    </v-content>
     <v-footer
    absolute
    padless
    app
    inset
  >
    <v-card
      class="flex"
      flat
      tile
    >
      <v-card-title class="green">
        <strong class="subheading white--text">Get connected with us on social networks!</strong>

        <v-spacer></v-spacer>

        <v-btn
          class="mx-4"
          dark
          icon
          href="https://www.youtube.com/channel/UC2YlJ0G0L9DTlj-9pSA-BrQ?view_as=subscriber" target="_blank"
        >
          <v-icon size="24px" class="fab fa-youtube"></v-icon>
        </v-btn>
         <v-btn
          class="mx-4"
          dark
          icon
          href="https://linkedin.com/company/kwalka" target="_blank"
        >
           <v-icon size="24px" class="fab fa-linkedin"></v-icon>
         </v-btn>
            <v-btn
          class="mx-4"
          dark
          icon
         href="https://www.instagram.com/kwalkacom/" target="_blank"
        >
            <v-icon size="24px" class="fab fa-instagram"></v-icon>
            </v-btn>
            <v-btn
          class="mx-4"
          dark
          icon
        href="https://blog.kwalka.com" target="_blank"
        >
            <v-icon size="24px" class="fas fa-pen-square"></v-icon>
            </v-btn>

      </v-card-title>

      <v-card-text class="py-2  text-center">
        {{ new Date().getFullYear() }} — <strong>Kwalka</strong>
      </v-card-text>
    </v-card>
  </v-footer>
  </v-app>
</template>

<script>
export default {
  props: {
    source: String
  },
  data: () => ({
    drawer: null,
    search: "",
    fav: true,
      menu: false,
      message: false,
      hints: true,
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
    searchit() {
      console.log("searching ..");
    },

    handleFullScreen() {
      let doc = window.document;
      let docEl = doc.documentElement;

      let requestFullScreen =
        docEl.requestFullscreen ||
        docEl.mozRequestFullScreen ||
        docEl.webkitRequestFullScreen ||
        docEl.msRequestFullscreen;
      let cancelFullScreen =
        doc.exitFullscreen ||
        doc.mozCancelFullScreen ||
        doc.webkitExitFullscreen ||
        doc.msExitFullscreen;

      if (
        !doc.fullscreenElement &&
        !doc.mozFullScreenElement &&
        !doc.webkitFullscreenElement &&
        !doc.msFullscreenElement
      ) {
        requestFullScreen.call(docEl);
      } else {
        cancelFullScreen.call(doc);
      }
    },
    logout() {
      this.$router.push({ name: "Logout" });
    },
    loginIn() {
      if (this.$router.history.current.path === "/login") {
        return;
      }
      this.$router.push({ name: "Login" });
    },
    goBack() {
      if (this.$router.history.current.path === "/") {
        return;
      }
      this.$router.push({ name: "Home" });
    },
    goCart() {
      if (this.$router.history.current.path === "/cart") {
        return;
      }
      this.$router.push({ name: "Cart" });
    }
  }
};
</script>

<style scoped>

.drawer{
  margin-top: 60px;
}

</style>

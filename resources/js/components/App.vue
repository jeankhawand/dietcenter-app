<template>
  <v-app>
    <Navbar />
    <v-content>
      <router-view></router-view>
    </v-content>
    <Footer />
  </v-app>
</template>

<script>
import Navbar from "./Navbar.vue";
import Footer from "./Footer";
import {LOAD_SESSION_STORAGE_CART} from '../store/mutation-types'
export default {
  name: "App",
  components: {
    Navbar,
    Footer
  },
  created() {
    if (sessionStorage.cart) {
      this.$store.commit(LOAD_SESSION_STORAGE_CART);
    }
  }
};
</script>

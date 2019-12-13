<template>
    <v-app>
        <Layout />
    </v-app>
</template>

<script>
import Layout from "./Layout.vue";
import {LOAD_SESSION_STORAGE_CART} from '../store/mutation-types'

export default {
    name: "App",
    components: {
        Layout,


    },
  created() {
    if (sessionStorage.cart) {
      this.$store.commit(LOAD_SESSION_STORAGE_CART);
    }
  }
};
</script>

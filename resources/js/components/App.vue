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
export default {
    name: "App",
    components: {
        Navbar,
        Footer
    }
};
</script>

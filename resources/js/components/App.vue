<template>
    <v-app>
        <Navbar />
        <v-content>
            <RecipeList />
        </v-content>
        <Footer />
    </v-app>
</template>

<script>
import Navbar from "./Navbar.vue";
import Footer from "./Footer";
import RecipeList from "./recipe/RecipeList";
export default {
    name: "App",
    components: {
        Navbar,
        Footer,
        RecipeList
    }
};
</script>

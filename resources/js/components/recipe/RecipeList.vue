<template>
    <div>
        <v-container class="my-5">
            <v-layout row wrap>
                <v-flex xs12 sm6 md4 v-for="product in products.data" :key="product.id">
                    <RecipeItem :product="product" />
                </v-flex>
            </v-layout>
        </v-container>
    </div>
</template>
<script>
import RecipeItem from "./RecipeItem";
export default {
    created() {
        if (this.products.length === 0) {
            this.$store.dispatch("allProducts");
        }
    },
    computed: {
        products() {
            return this.$store.getters.allProducts;
        }
    },
    data() {
        return {};
    },
    components: {
        RecipeItem
    }
};
</script>

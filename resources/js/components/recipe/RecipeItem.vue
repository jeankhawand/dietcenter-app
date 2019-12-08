<template>
    <v-card :loading="loading" class="mx-auto my-4" max-width="374">
        <v-img height="250" :src="product.image"></v-img>

        <v-card-title>{{ product.name }}</v-card-title>

        <v-card-text>
            <v-row align="center" class="mx-0">
                <v-rating
                    :value="4.5"
                    color="amber"
                    dense
                    half-increments
                    readonly
                    size="14"
                ></v-rating>

                <div class="grey--text ml-4">4.5 (413)</div>
            </v-row>

            <div class="my-4 subtitle-1 black--text">
                $ • Italian, Cafe
            </div>

            <div>
                {{ product.description }}
            </div>
        </v-card-text>

        <v-divider class="mx-4"></v-divider>

        <v-card-actions>
            <v-btn color="deep-purple accent-4" text @click="reserve">
                Add To Cart
            </v-btn>
        </v-card-actions>
    </v-card>
</template>
<script>
export default {
    props: ["product"],
    data: () => ({
        loading: false,
        selection: 1
    }),
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

    methods: {
        reserve() {
            this.loading = true;

            setTimeout(() => (this.loading = false), 2000);
        }
    }
};
</script>

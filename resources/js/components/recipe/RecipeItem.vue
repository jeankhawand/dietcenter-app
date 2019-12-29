<template>
  <v-card :loading="loading" class="mx-auto my-4" max-width="374">
    <v-img height="250" :src="product.image"></v-img>

    <v-card-title>{{ product.name }}</v-card-title>

    <v-card-text>
      <v-row align="center" class="mx-0">
        <v-rating :value="4.5" color="amber" dense half-increments readonly size="14"></v-rating>

        <div class="grey--text ml-4">4.5 (413)</div>
      </v-row>

      <div class="my-4 subtitle-1 black--text">${{product.price}} • Italian, Cafe</div>

      <div>{{ product.description }}</div>
    </v-card-text>

    <v-divider class="mx-4"></v-divider>

    <v-card-actions>
      <v-btn v-if="isNotAdded" color="deep-purple accent-4" text @click="addToCart">Add To Cart</v-btn>
      <div v-else>
        <v-btn color="deep-purple accent-4" text @click="removeFromCart">Remove From Cart</v-btn>
        <v-btn color="deep-purple accent-4" text @click="removeQuantityFromCart">-</v-btn>
        <span style="color:#6200ea">{{ product.quantity }}</span>
        <v-btn color="deep-purple accent-4" text @click="addQuantityToCart">+</v-btn>
      </div>
    </v-card-actions>
  </v-card>
</template>
<script>
import {
  ADD_TO_CART,
  REMOVE_FROM_CART,
  ADD_QUANTITY_TO_CART,
  REMOVE_QUANTITY_FROM_CART
} from "../../store/mutation-types";
export default {
  props: ["product"],
  data: () => ({
    loading: false,
    selection: 1
  }),

  computed: {
    isNotAdded() {
      return this.$store.state.cart.indexOf(this.product) < 0;
    }
  },

  methods: {
    addToCart() {
      this.loading = true;
      this.$store.dispatch("addToCart", this.product);
      this.loading = false;
    },
    removeFromCart() {
      this.loading = true;
      this.$store.dispatch("removeFromCart", this.product.id);
      this.loading = false;
    },
    addQuantityToCart() {
      this.loading = true;
      this.$store.dispatch("addQuantityToCart", this.product);
      this.loading = false;
    },
    removeQuantityFromCart() {
      this.loading = true;
      this.$store.dispatch("removeQuantityFromCart", this.product);
      this.loading = false;
    }
  }
};
</script>

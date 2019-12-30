<template>

<v-container fluid fill-height>
  <v-card :loading="loading" class="mx-auto my-4" max-width="400">
    <v-list-item>
      <v-list-item-avatar tile size="90">
        <v-img :src="product.image"></v-img>
      </v-list-item-avatar>
      <v-list-item-content>
        <div class="text-left mb-7">{{ product.name }}</div>
        <div class="text-right mb-6">${{ product.price }}</div>
        <div>
          <v-btn text @click="removeQuantityFromCart">-</v-btn>
          <span>{{ product.quantity }}</span>
          <v-btn  text @click="addQuantityToCart">+</v-btn>
          <v-btn  text @click="removeFromCart">
            <v-icon >mdi-delete</v-icon>
          </v-btn>
        </div>
      </v-list-item-content>
    </v-list-item>
  </v-card>
</v-container>

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
    selection: 1,
    data: {
      product:[],
    },
  }),

  computed: {
    isNotAdded() {
      return this.$store.state.cart.indexOf(this.product) < 0;
    },
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

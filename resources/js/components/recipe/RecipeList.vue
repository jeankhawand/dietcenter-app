<template>
  <div>
    <v-container fill-height
                     fluid  
                      grid-list-xl
                     class="my-5">
      <v-layout row wrap>
        <v-flex xs12 sm6 md3 lg3 v-for="product in products.data" :key="product.id">
          <RecipeItem :product="product" />
        </v-flex>
      </v-layout>
    </v-container>
  </div>
</template>
<script>
import RecipeItem from "./RecipeItem";
import { PRODUCT_PAGE_INDEX } from "../../store/mutation-types";
export default {
  created() {
    if (this.products.length === 0) {
      this.$store.dispatch("allProducts");
    }
  },
  computed: {
    products() {
      return this.$store.getters.allProducts;
    },
    productsPageIndex() {
      return this.$store.getters.productsPageIndex;
    }
  },
  components: {
    RecipeItem
  },
  methods: {
    scroll(person) {
      window.onscroll = () => {
        let bottomOfWindow =
          document.documentElement.scrollTop + window.innerHeight >=
          document.documentElement.offsetHeight - 1;
        if (bottomOfWindow) {
          this.$store.commit(PRODUCT_PAGE_INDEX);
          this.$store.dispatch("allProductsNextPage", this.productsPageIndex);
        }
      };
    }
  },
  mounted() {
    this.scroll(this.person);
  }
};
</script>

<template>
  <v-container fill-height fluid grid-list-xl>
    <v-layout wrap>
      <v-flex lg12>
        <v-card class="mb-2">
          <v-data-table
            :headers="headers"
            :items="recipes"
            :items-per-page="itemsPerPage"
            :search="search"
            sort-by="firstname"
            class="elevation-1"
          >
            <template v-slot:top>
              <v-toolbar flat color="white">
                <v-toolbar-title>Recipes</v-toolbar-title>
                <v-divider class="mx-4" inset vertical></v-divider>
                <v-text-field
                  v-model="search"
                  append-icon="mdi-magnify"
                  label="Search"
                  single-line
                  hide-details
                ></v-text-field>
                <v-spacer></v-spacer>
                <v-dialog v-model="dialog" max-width="500px">
                  <template v-slot:activator="{ on }" v-if="isChef">
                    <v-btn color="primary" dark class="mb-2" v-on="on">New Recipe</v-btn>
                  </template>
                  <v-card>
                    <v-card-title>
                      <span class="headline">{{ formTitle }}</span>
                    </v-card-title>

                    <v-card-text>
                      <v-container>
                        <v-row>
                          <v-col cols="12" sm="6" md="4">
                            <v-text-field
                              type="text"
                              v-model="editedItem.name"
                              label="Full Name"
                              :rules="nameRules"
                              required
                            ></v-text-field>
                          </v-col>
                          <v-col cols="12" sm="6" md="4">
                            <v-text-field
                              type="numeric"
                              v-model="editedItem.price"
                              label="Price"
                              :rules="priceRules"
                              required
                            ></v-text-field>
                          </v-col>
                          <v-col cols="12" sm="6" md="4">
                            <v-text-field
                              :rules="descriptionRules"
                              type="text"
                              v-model="editedItem.description"
                              label="Description"
                              required
                            ></v-text-field>
                          </v-col>
                        </v-row>
                      </v-container>
                    </v-card-text>

                    <v-card-actions>
                      <v-spacer></v-spacer>
                      <v-btn color="blue darken-1" text @click="close">Cancel</v-btn>
                      <v-btn color="blue darken-1" text @click="save">Save</v-btn>
                    </v-card-actions>
                  </v-card>
                </v-dialog>
              </v-toolbar>
            </template>
            <template v-slot:item.action="{ item }" v-if="isChef">
              <v-icon small class="mr-2" @click="editItem(item)" :disabled="isDisabled">mdi-pencil</v-icon>
              <v-icon small @click="deleteItem(item)" :disabled="isDisabled">mdi-delete</v-icon>
            </template>
            <template v-slot:no-data>
              <v-btn color="primary" @click="initialize">Reset</v-btn>
            </template>
          </v-data-table>
        </v-card>
      </v-flex>
    </v-layout>
  </v-container>
</template>


<script>
export default {
  data() {
    return {
      dialog: false,
      search: "",
      editedItem: {
        name: "",
        price: "",
        description: ""
      },
      nameRules: [
        v => !!v || "Name is required",
        v => /[a-zA-Z]/.test(v) || "Name must be valid"
      ],
      priceRules: [
        v => !!v || "Price is required",
        v => /^\d*(\.\d{1,2})?$/.test(v) || "price must be valid"
      ],
      descriptionRules: [v => !!v || "Description is required"],
      itemsPerPage: 5,
      editedIndex: -1,
      search: "",
      selected: [],
      recipes: [],
      headers: [
        {
          text: "Avatar",
          align: "left",
          sortable: false,
          value: "avatar"
        },
        { text: "Name", value: "name" },
        { text: "Price", value: "price" },
        { text: "Description", value: "description" },
        { text: "Actions", value: "action", sortable: false }
      ]
    };
  },
  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "New Recipe" : "Edit Recipe";
    },
    isManager(state) {
        return this.$store.getters.isManager;
    },
    isChef(state) {
        return this.$store.getters.isChef;
    },
    isDietitian(state) {
        return this.$store.getters.isDietitian;
    }
  },
  beforeMount() {
    return new Promise((resolve, reject) => {
      axios
        .get("recipes", {
          params: {},
          headers: {
            Authorization: "Bearer " + this.$store.state.token,
            Accept: "application/json"
          }
        })
        .then(response => {
          this.recipes = response.data.data;
          resolve(response);
        })
        .catch(error => {
          console.log(error);
          reject(error);
        });
    });
  },
  methods: {
    editItem(item) {
      this.editedIndex = this.recipes.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },

    deleteItem(item) {
      const index = this.recipes.indexOf(item);
      confirm("Are you sure you want to delete this item?") &&
        this.recipes.splice(index, 1);
    },
    close() {
      this.dialog = false;
      setTimeout(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      }, 300);
    },
    save() {
      if (this.editedIndex > -1) {
        Object.assign(this.clients[this.editedIndex], this.editedItem);
      } else {
        this.recipes.push(this.editedItem);
      }
      this.close();
    },
    initialize() {}
  }
};
</script>



<template>
  <v-app>
    <v-container fill-height fluid grid-list-xl>
      <v-layout wrap>
        <v-flex md12 sm12 lg4>
          <v-card class="mx-auto" max-width="344" shaped elevation="2">
            <v-list-item three-line>
              <v-list-item-avatar size="80" color="green">
                <v-icon size="40" color="white">mdi-book-plus</v-icon>
              </v-list-item-avatar>
              <v-list-item-content>
                <div class="category grey--text font-weight-light text-right">Total Appointments</div>
                <div class="display-1 mb-2 font-weight-light text-right">34</div>
              </v-list-item-content>
            </v-list-item>
          </v-card>
        </v-flex>
        <v-flex md12 sm12 lg4>
          <v-card class="mx-auto" max-width="344" shaped elevation="2">
            <v-list-item three-line>
              <v-list-item-avatar size="80" color="#25A032">
                <v-icon size="40" color="white">mdi-account</v-icon>
              </v-list-item-avatar>
              <v-list-item-content>
                <div class="category grey--text font-weight-light text-right">Total Clients</div>
                <div class="display-1 mb-2 font-weight-light text-right">3</div>
              </v-list-item-content>
            </v-list-item>
          </v-card>
        </v-flex>
        <v-flex md12 sm12 lg4>
          <v-card class="mx-auto" max-width="344" shaped elevation="2">
            <v-list-item three-line>
              <v-list-item-avatar size="80" color="#006727">
                <v-icon size="40" color="white">mdi-currency-usd</v-icon>
              </v-list-item-avatar>
              <v-list-item-content>
                <div class="category grey--text font-weight-light text-right">Revenue</div>
                <div class="display-1 mb-2 font-weight-light text-right">4,000$</div>
              </v-list-item-content>
            </v-list-item>
          </v-card>
        </v-flex>

  <v-flex lg12>
                    <v-card class="mb-2"> 
                        <v-data-table
                            :headers="headers"
                            :items="clients"
                            :items-per-page="itemsPerPage"
                            :search="search"
                            sort-by="firstname"
                            class="elevation-1"
                        >
                            <template v-slot:top>
                                <v-toolbar flat color="white">
                                    <v-toolbar-title>Clients</v-toolbar-title>
                                    <v-divider
                                        class="mx-4"
                                        inset
                                        vertical
                                    ></v-divider>
                                    <v-text-field
                                        v-model="search"
                                        append-icon="mdi-magnify"
                                        label="Search"
                                        single-line
                                        hide-details
                                    ></v-text-field>
                                    <v-spacer></v-spacer>
                                    <v-dialog v-model="dialog" max-width="500px">
                                        <template v-slot:activator="{ on }">
                                            <v-btn color="primary" dark class="mb-2" v-on="on">New Client</v-btn>
                                        </template>
                                        <v-card>
                                            <v-card-title>
                                                <span class="headline">{{ formTitle }}</span>
                                            </v-card-title>

                                            <v-card-text>
                                                <v-container>
                                                    <v-row>
                                                        <v-col cols="12" sm="6" md="4">
                                                            <v-text-field type="text" v-model="editedItem.name"
                                                                          label="Full Name" :rules="nameRules" required></v-text-field>
                                                        </v-col>
                                                        <v-col cols="12" sm="6" md="4">
                                                            <v-text-field type="email" v-model="editedItem.email"
                                                                          label="Email" :rules="emailRules" required></v-text-field>
                                                        </v-col>
                                                        <v-col cols="12" sm="6" md="4">
                                                            <v-text-field :rules="phoneRules" type="numeric"
                                                                          v-model="editedItem.phonenumber"
                                                                          label="Phone Number"  required></v-text-field>
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
                            <template v-slot:item.action="{ item }">
                                <v-icon
                                    small
                                    class="mr-2"
                                    @click="editItem(item)"
                                >
                                    mdi-pencil
                                </v-icon>
                                <v-icon
                                    small
                                    @click="deleteItem(item)"
                                >
                                    mdi-delete
                                </v-icon>
                            </template>
                            <template v-slot:no-data>
                                <v-btn color="primary" @click="initialize">Reset</v-btn>
                            </template>
                        </v-data-table>
                    </v-card>
                </v-flex>
     
      </v-layout>
    </v-container>
  </v-app>
</template>

<script>
export default {
  data() {
    return {
      dialog: false,
      search: "",
      editedItem: {
        name: "",
        email: "",
        phonenumber: ""
      },
      emailRules: [
        v => !!v || "E-mail is required",
        v => /.+@.+\..+/.test(v) || "E-mail must be valid"
      ],
      phoneRules: [
        v => !!v || "Phone Number is required",
        v => /^(0|[1-9][0-9]*)$/.test(v) || "Phone Number must be valid"
      ],
      nameRules: [
        v => !!v || "Name is required",
        v => /[a-zA-Z]/.test(v) || "Name must be valid"
      ],
      itemsPerPage: 5,
      editedIndex: -1,
      search: "",
      selected: [],
      clients: [],
      headers: [
        {
          text: "Avatar",
          align: "left",
          sortable: false,
          value: "avatar"
        },
        { text: "Name", value: "name" },
        { text: "Email", value: "email" },
        { text: "Phone Number", value: "phonenumber" },
        { text: "Actions", value: "action", sortable: false }
      ]
    };
  },
  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "New Client" : "Edit Client";
    }
  },
  methods: {
    editItem(item) {
      this.editedIndex = this.clients.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },

    deleteItem(item) {
      const index = this.clients.indexOf(item);
      confirm("Are you sure you want to delete this item?") &&
        this.clients.splice(index, 1);
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
        this.clients.push(this.editedItem);
      }
      this.close();
    },
    initialize() {}
  }
};
</script>

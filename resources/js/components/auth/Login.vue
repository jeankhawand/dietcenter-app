<template>
  <v-container>
    <v-layout align-center>
      <v-flex xs12 sm6 offset-sm3>
        <v-card class="elevation-12">
          <v-toolbar dark color="green">
            <v-toolbar-title>Login To Your Profile</v-toolbar-title>

            <v-spacer></v-spacer>
          </v-toolbar>
          <v-card-text>
            <v-container>
              <v-progress-linear
                :active="loading"
                :indeterminate="loading"
                absolute
                bottom
                color="deep-purple accent-4"
              ></v-progress-linear>
              <form @submit.prevent="login">
                <v-layout row>
                  <v-flex xs12>
                    <v-alert v-if="errorMessage" type="error">{{errorMessage}}</v-alert>
                    <v-text-field
                      prepend-icon="mdi-account"
                      name="email"
                      label="Email/Username"
                      id="email"
                      v-model="email"
                      type="email"
                      :rules="emailRules"
                      required
                    ></v-text-field>
                  </v-flex>
                </v-layout>
                <v-layout row>
                  <v-flex xs12>
                    <v-text-field
                      prepend-icon="mdi-lock"
                      name="password"
                      label="Password"
                      id="password"
                      v-model="password"
                      :rules="passwordRules"
                      type="password"
                      required
                    ></v-text-field>
                  </v-flex>
                </v-layout>

                <v-layout row>
                  <v-flex xs12>
                    <v-btn type="submit">Login</v-btn>
                  </v-flex>
                </v-layout>
              </form>
            </v-container>
          </v-card-text>
        </v-card>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
export default {
  data() {
    return {
      email: "",
      password: "",
      errorMessage: "",
      loading: false,
      passwordRules: [
        v => !!v || "Password is required",
        v => (v && v.length <= 10) || "Password must be less than 10 characters"
      ],
      emailRules: [
        v => !!v || "E-mail is required",
        v => /.+@.+\..+/.test(v) || "E-mail must be valid"
      ]
    };
  },
  computed: {
    loggedIn() {
      return this.$store.getters.loggedIn;
    }
  },
  methods: {
    login() {
      this.loading = true;
      this.$store
        .dispatch("retrieveToken", {
          username: this.email,
          password: this.password
        })
        .then(response => {
          // console.log(response);
          alert("GetUserInfo");
          this.$store
            .dispatch("getUserInfo")
            .catch(error => {
              (this.errorMessage = error.response.data), (this.password = "");
              this.loading = false;
            });
          this.loading = false;
          this.$router.push({ name: "Home" });
        })
        .catch(error => {
          // console.log(error.response.data),
          (this.errorMessage = error.response.data), (this.password = "");
          this.loading = false;
        });
    }
  }
};
</script>

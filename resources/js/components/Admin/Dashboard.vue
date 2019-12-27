
<template>
<v-app>
<v-container  fill-height
    fluid
    grid-list-xl
    >
       <v-layout wrap>
     <v-flex
        md12
        sm12
        lg4
      >
       <v-card
    class="mx-auto"
    max-width="344"
    shaped
    elevation="2"
  >
    <v-list-item three-line>
      <v-list-item-avatar

        size="80"
        color="green"
        >
        <v-icon
        size="40"
        color="white"
      >
      mdi-store
       </v-icon>
      </v-list-item-avatar>
      <v-list-item-content>
        <div class="category grey--text font-weight-light text-right">Revenue</div>
        <div class="display-1 mb-2 font-weight-light text-right">34,000$</div>

      </v-list-item-content>


    </v-list-item>
  </v-card>
    </v-flex>
      <v-flex
        md12
        sm12
        lg4
      >
       <v-card
    class="mx-auto"
    max-width="344"
    shaped
    elevation="2"
  >
    <v-list-item three-line>
      <v-list-item-avatar

        size="80"
        color="#25A032"
        >
        <v-icon
        size="40"
        color="white"
      >
      mdi-store
       </v-icon>
      </v-list-item-avatar>
      <v-list-item-content>
        <div class="category grey--text font-weight-light text-right">Revenue</div>
        <div class="display-1 mb-2 font-weight-light text-right">34,000$</div>

      </v-list-item-content>


    </v-list-item>
  </v-card>
    </v-flex>
      <v-flex
        md12
        sm12
        lg4
      >
       <v-card
    class="mx-auto"
    max-width="344"
    shaped
    elevation="2"
  >
    <v-list-item three-line>
      <v-list-item-avatar

        size="80"
        color="#006727"
        >
        <v-icon
        size="40"
        color="white"
      >
      mdi-store
       </v-icon>
      </v-list-item-avatar>
      <v-list-item-content>
        <div class="category grey--text font-weight-light text-right">Revenue</div>
        <div class="display-1 mb-2 font-weight-light text-right">34,000$</div>

      </v-list-item-content>


    </v-list-item>
  </v-card>
    </v-flex>


        <v-flex lg12>
          <v-card-text>
      <div class="display-1 font-weight-thin">Clients </div>
    </v-card-text>
          <v-card >
            <v-toolbar card color="green">
              <v-text-field
                flat
                solo
                prepend-icon="account-search"
                placeholder="Type something"
                v-model="search"
                hide-details
                class="hidden-sm-and-down"
              ></v-text-field>
              <v-btn icon>
                <v-icon color="black">filter-variant</v-icon>
              </v-btn>
            </v-toolbar>
            <v-divider></v-divider>
            <v-card-text class="pa-0">
              <v-data-table
                :headers="complex.headers"
                :search="search"
                :items="complex.items"
                :rows-per-page-items="[10,25,50,{text:'All','value':-1}]"
                class="elevation-1"
                item-key="name"
                select-all
                v-model="complex.selected"
              >
                <template slot="items" slot-scope="props">
                  <td>
                    <v-checkbox
                      primary
                      hide-details
                      v-model="props.selected"
                    ></v-checkbox>
                  </td>
                  <td>
                    <v-avatar size="32">
                      <img :src="props.item.avatar" alt="">
                    </v-avatar>
                  </td>
                  <td>{{ props.item.name }}</td>
                  <td>{{ props.item.email }}</td>
                  <td>{{ props.item.phone }}</td>
                  <td>
                    <v-btn depressed outline icon fab dark color="primary" small>
                      <v-icon>edit</v-icon>
                    </v-btn>
                    <v-btn depressed outline icon fab dark color="pink" small>
                      <v-icon>delete</v-icon>
                    </v-btn>
                  </td>
                </template>
              </v-data-table>
            </v-card-text>
          </v-card>
        </v-flex>

       </v-layout>
</v-container>
</v-app>
</template>

<script>
    import {Items as Users} from '../../Users/user';

    export default {
    data () {
      return {
      search: '',
        complex: {
          selected: [],
          headers: [
            {
              text: 'Avatar',
              value: 'avatar'
            },
            {
              text: 'Name',
              value: 'name'
            },
            {
              text: 'Email',
              value: 'email'
            },
            {
              text: 'Phone',
              value: 'phone'
            },
            {
              text: 'Action',
              value: ''
            },
          ],
          items: Users
        },
      }
    },
  }
</script>

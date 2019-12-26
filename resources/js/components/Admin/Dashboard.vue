
<template>
<v-app>
<v-container class="grey lighten-5">
    <v-row no-gutters>
      <v-col
        v-for="n in 3"
        :key="n"
        cols="12"
        sm="4"
      >
        <v-card
    class="mx-auto"
    max-width="344"
    outlined
  >
    <v-list-item three-line>
      <v-list-item-content>
        <div class="overline mb-4">OVERLINE</div>
        <v-list-item-title class="headline mb-1">Headline 5</v-list-item-title>
        <v-list-item-subtitle>Greyhound divisely hello coldly fonwderfully</v-list-item-subtitle>
      </v-list-item-content>


    </v-list-item>
  </v-card>
      </v-col>
    </v-row>
  </v-container>
  <v-row>
      <v-col justify-self="end">
  <v-simple-table fixed-header height="300px">
    <template v-slot:default>
      <thead>
        <tr>
          <th class="text-center">Name</th>
          <th class="text-center">appointments</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="item in clients" :key="item.name">
          <td class="text-center">{{ item.name }}</td>
          <td class="text-center">{{ item.appointments }}</td>
        </tr>
      </tbody>
    </template>
  </v-simple-table>
      </v-col>
  </v-row>
</v-app>
</template>

<script>
  export default {
    data () {
      return {
        clients: [
          {
            name: 'Sa3doun',
            appointments: 159,
          },
          {
            name: 'Sergio',
            appointments: 237,
          },
          {
            name: 'Jean',
            appointments: 262,
          },
          {
            name: 'Toni',
            appointments: 305,
          },
         
        ],
      }
    },
  }
</script>
<template>
<v-container>
  <v-row>
    <v-col>
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
    <v-col>
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
     <v-flex
        sm6
        xs12
        md6
        lg3
      >
        <material-stats-card
          color="green"
          icon="mdi-store"
          title="Revenue"
          value="$34,245"
          sub-icon="mdi-calendar"
          sub-text="Last 24 Hours"
        />
      </v-flex>
  </v-row>
<v-row>
  <v-col>
  <v-card  
    color="white"
    dark
    max-width="600">
  <div class="donut">
      <apexchart type=donut width=380 :options="chartOptions" :series="series" />
    </div>
 
  </v-card>
   </v-col>
   <v-col>
  <v-card
    class="mx-auto text-center"
    color="green"
    dark
    max-width="600"
  >

    <v-card-text>
      <v-sheet color="rgba(0, 0, 0, .12)">
        <v-sparkline
          :value="value"
          color="rgba(255, 255, 255, .7)"
          height="100"
          padding="24"
          stroke-linecap="round"
          smooth
        >
          <template v-slot:label="item">
            ${{ item.value }}
          </template>
        </v-sparkline>
      </v-sheet>
    </v-card-text>

    <v-card-text>
      <div class="display-1 font-weight-thin">Sales Last 24h</div>
    </v-card-text>

      
  </v-card>
  </v-col>
</v-row>
</v-container>
</template>

<script>
import Vue from 'vue'
import VueApexCharts from 'vue-apexcharts'
Vue.use(VueApexCharts)
  export default {
   components: {
        apexchart: VueApexCharts,
   },
   data(){
     return{
        series: [44, 55, 41, 17, 15],
        chartOptions: {
          responsive: [{
            breakpoint: 350,
            options: {
              chart: {
                width: 200
              },
              legend: {
                position: 'bottom'
              }
            }
          }]
        },
         value: [
        423,
        446,
        675,
        510,
        590,
        610,
        760,
      ],
     }
   },
  }
  
</script>

<style scoped>
</style>
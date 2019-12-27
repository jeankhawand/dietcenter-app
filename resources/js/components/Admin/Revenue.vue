<template>
<v-container fill-height
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

<v-flex
        md12
        sm12
        lg6
      >
  <v-card
    class="mx-auto text-center"
    max-width="600"
  >



      <apexchart type=line height=350 :options="LinechartOptions" :series="Lineseries" />

<v-divider></v-divider>
    <v-card-text>
      <div class="display-1 font-weight-thin" >Sales Last Year</div>
    </v-card-text>


  </v-card>
 </v-flex>

 <v-flex
        md12
        sm12
        lg6
      >
  <v-card
  class="mx-auto text-center"

    max-width="600">
  <div class="donut">
      <apexchart type=donut width=380 :options="DonutchartOptions" :series="Donutseries" />
    </div>
<v-divider></v-divider>
    <v-card-text>
      <div class="display-1 font-weight-thin">Orders Breakdown</div>
    </v-card-text>


  </v-card>
 </v-flex>

     </v-layout>
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
          Lineseries: [{
            name: "revenue",
            data: [10, 41, 35, 51, 49, 62, 69, 91, 148]
        }],
        LinechartOptions: {
          chart: {
                height: 350,
                zoom: {
                    enabled: false
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'straight'
            },

            colors: ["#2ed72e"],
            title: {
                text: '',
                align: 'left'
            },
            grid: {
                row: {
                    colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                    opacity: 0.5
                },
            },
            xaxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
            }
        },
        Donutseries: [44, 55, 41, 17, 15],
        DonutchartOptions: {
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
          }],
           title: {
                text: '',
                align: 'left'
            },
           colors: ["#014422","#006727","#248823" , "#25A032"],
        },

     }
   },
  }

</script>

<style scoped>
</style>

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
    class="mx-auto text-center"

    max-width="600"
  >
    <div id="radial">
      <apexchart type=radialBar height=350 :options="chartOptions" :series="series" />
    </div>
    <v-divider></v-divider>
    <v-card-text>
      <div class="display-1 font-weight-thin" >Protein Intake</div>
    </v-card-text>
  </v-card>

      <v-card
    class="mx-auto mt-4 text-center"


    max-width="600"
  >
    <div id="radial">
      <apexchart type=radialBar height=350 :options="chartOptions2" :series="series2" />
    </div>
    <v-divider></v-divider>
    <v-card-text>
      <div class="display-1 font-weight-thin" >Carbs Intake</div>
    </v-card-text>
  </v-card>
</v-flex>
<v-flex
        md12
        sm12
        lg4
      >
      <v-card
    class="mx-auto text-center"

    max-width="600"
  >
    <div id="radial">
      <apexchart type=radialBar height=350 :options="chartOptions3" :series="series3" />
    </div>
    <v-divider></v-divider>
    <v-card-text>
      <div class="display-1 font-weight-thin" >Sugar Intake</div>
    </v-card-text>
  </v-card>
      <v-card
    class="mx-auto mt-4 text-center"


    max-width="600"
  >
    <div id="radial">
      <apexchart type=radialBar height=350 :options="chartOptions4" :series="series4" />
    </div>
    <v-divider></v-divider>
    <v-card-text>
      <div class="display-1 font-weight-thin">Calories Intake</div>
    </v-card-text>
  </v-card>
</v-flex>

<v-flex md12
        sm12
        lg4
        >
        <v-data-table
    :headers="headers"
    :items="desserts"
    :items-per-page="5"
    class="elevation-1"
  ></v-data-table>
</v-flex>
   </v-layout>
</v-container>
</template>

<script>
    import VueApexCharts from 'vue-apexcharts'

    export default {
    components: {
        apexchart: VueApexCharts,
   },
    data() {
    return {
        series2: [76],
        chartOptions2: {
          chart: {
            offsetY: -20
          },
          plotOptions: {
            radialBar: {
              startAngle: -90,
              endAngle: 90,
              track: {

                background: "#e7e7e7",
                strokeWidth: '97%',
                margin: 5, // margin is in pixels
                shadow: {
                  enabled: true,
                  top: 2,
                  left: 0,
                  color: '#04cd04',
                  opacity: 1,
                  blur: 2
                }
              },
              dataLabels: {
                name: {
                  show: false
                },
                value: {
                  offsetY: -2,
                  fontSize: '22px'
                }
              }
            }
          },
          fill: {
            type: 'gradient',
            gradient: {
              shade: 'light',
              shadeIntensity: 0.0,
              inverseColors: true,
              opacityFrom: 1,
              opacityTo: 1,
              stops: [0, 50, 53, 91]
            },
          },
          labels: ['Per Day'],
          colors : ['#04cd04']
        },

  series3: [20],
        chartOptions3: {
          chart: {
            offsetY: -20
          },
          plotOptions: {
            radialBar: {
              startAngle: -90,
              endAngle: 90,
              track: {

                background: "#e7e7e7",
                strokeWidth: '97%',
                margin: 5, // margin is in pixels
                shadow: {
                  enabled: true,
                  top: 2,
                  left: 0,
                  color: '#04cd04',
                  opacity: 1,
                  blur: 2
                }
              },
              dataLabels: {
                name: {
                  show: false
                },
                value: {
                  offsetY: -2,
                  fontSize: '22px'
                }
              }
            }
          },
          fill: {
            type: 'gradient',
            gradient: {
              shade: 'light',
              shadeIntensity: 0.0,
              inverseColors: true,
              opacityFrom: 1,
              opacityTo: 1,
              stops: [0, 50, 53, 91]
            },
          },
          labels: ['Average Results'],
          colors : ['#04cd04']
        },

 series4: [100],
        chartOptions4: {
          chart: {
            offsetY: -20
          },
          plotOptions: {
            radialBar: {
              startAngle: -90,
              endAngle: 90,
              track: {

                background: "#e7e7e7",
                strokeWidth: '97%',
                margin: 5, // margin is in pixels
                shadow: {
                  enabled: true,
                  top: 2,
                  left: 0,
                  color: '#04cd04',
                  opacity: 1,
                  blur: 2
                }
              },
              dataLabels: {
                name: {
                  show: false
                },
                value: {
                  offsetY: -2,
                  fontSize: '22px'
                }
              }
            }
          },
          fill: {
            type: 'gradient',
            gradient: {
              shade: 'light',
              shadeIntensity: 0.0,
              inverseColors: true,
              opacityFrom: 1,
              opacityTo: 1,
              stops: [0, 50, 53, 91]
            },
          },
          labels: ['Average Results'],
          colors : ['#04cd04']
        },

         series: [45],
        chartOptions: {
          chart: {
            offsetY: -20
          },
          plotOptions: {
            radialBar: {
              startAngle: -90,
              endAngle: 90,
              track: {

                background: "#e7e7e7",
                strokeWidth: '97%',
                margin: 5, // margin is in pixels
                shadow: {
                  enabled: true,
                  top: 2,
                  left: 0,
                  color: '#04cd04',
                  opacity: 1,
                  blur: 2
                }
              },
              dataLabels: {
                name: {
                  show: false
                },
                value: {
                  offsetY: -2,
                  fontSize: '22px'
                }
              }
            }
          },
          fill: {
            type: 'gradient',
            gradient: {
              shade: 'light',
              shadeIntensity: 0.0,
              inverseColors: true,
              opacityFrom: 1,
              opacityTo: 1,
              stops: [0, 50, 53, 91]
            },
          },
          labels: ['Average Results'],
          colors : ['#04cd04']
        },

        headers: [
          {
            text: 'Dessert (100g serving)',
            align: 'left',
            sortable: false,
            value: 'name',
          },
          { text: 'Calories', value: 'calories' },
          { text: 'Fat (g)', value: 'fat' },
          { text: 'Carbs (g)', value: 'carbs' },
          { text: 'Protein (g)', value: 'protein' },
          { text: 'Iron (%)', value: 'iron' },
        ],
        desserts: [
          {
            name: 'Frozen Yogurt',
            calories: 159,
            fat: 6.0,
            carbs: 24,
            protein: 4.0,
            iron: '1%',
          },
          {
            name: 'Ice cream sandwich',
            calories: 237,
            fat: 9.0,
            carbs: 37,
            protein: 4.3,
            iron: '1%',
          },
          {
            name: 'Eclair',
            calories: 262,
            fat: 16.0,
            carbs: 23,
            protein: 6.0,
            iron: '7%',
          },
          {
            name: 'Cupcake',
            calories: 305,
            fat: 3.7,
            carbs: 67,
            protein: 4.3,
            iron: '8%',
          },
          {
            name: 'Gingerbread',
            calories: 356,
            fat: 16.0,
            carbs: 49,
            protein: 3.9,
            iron: '16%',
          },
          {
            name: 'Jelly bean',
            calories: 375,
            fat: 0.0,
            carbs: 94,
            protein: 0.0,
            iron: '0%',
          },
          {
            name: 'Lollipop',
            calories: 392,
            fat: 0.2,
            carbs: 98,
            protein: 0,
            iron: '2%',
          },
          {
            name: 'Honeycomb',
            calories: 408,
            fat: 3.2,
            carbs: 87,
            protein: 6.5,
            iron: '45%',
          },
          {
            name: 'Donut',
            calories: 452,
            fat: 25.0,
            carbs: 51,
            protein: 4.9,
            iron: '22%',
          },
          {
            name: 'KitKat',
            calories: 518,
            fat: 26.0,
            carbs: 65,
            protein: 7,
            iron: '6%',
          },
        ],

    }
    }

}
</script>

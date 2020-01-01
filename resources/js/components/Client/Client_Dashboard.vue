<template>
  <v-container fill-height fluid grid-list-xl>
    <v-layout wrap>
      <v-flex md12 sm12 lg4>
        <v-card class="mx-auto text-center" max-width="600">
          <div id="radial">
            <apexchart type="radialBar" height="350" :options="chartOptions" :series="series" />
          </div>
          <v-divider></v-divider>
          <v-card-text>
            <div class="display-1 font-weight-thin">Protein Intake</div>
          </v-card-text>
        </v-card>

        <v-card class="mx-auto mt-4 text-center" max-width="600">
          <div id="radial">
            <apexchart type="radialBar" height="350" :options="chartOptions2" :series="series2" />
          </div>
          <v-divider></v-divider>
          <v-card-text>
            <div class="display-1 font-weight-thin">Carbs Intake</div>
          </v-card-text>
        </v-card>
      </v-flex>
      <v-flex md12 sm12 lg4>
        <v-card class="mx-auto text-center" max-width="600">
          <div id="radial">
            <apexchart type="radialBar" height="350" :options="chartOptions3" :series="series3" />
          </div>
          <v-divider></v-divider>
          <v-card-text>
            <div class="display-1 font-weight-thin">Sugar Intake</div>
          </v-card-text>
        </v-card>
        <v-card class="mx-auto mt-4 text-center" max-width="600">
          <div id="radial">
            <apexchart type="radialBar" height="350" :options="chartOptions4" :series="series4" />
          </div>
          <v-divider></v-divider>
          <v-card-text>
            <div class="display-1 font-weight-thin">Calories Intake</div>
          </v-card-text>
        </v-card>
      </v-flex>

      <v-flex md12 sm12 lg4>
        <v-data-table :headers="headers" :items="user" :items-per-page="5" class="elevation-1"></v-data-table>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
import VueApexCharts from "vue-apexcharts";

export default {
  components: {
    apexchart: VueApexCharts
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
              strokeWidth: "97%",
              margin: 5, // margin is in pixels
              shadow: {
                enabled: true,
                top: 2,
                left: 0,
                color: "#04cd04",
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
                fontSize: "22px"
              }
            }
          }
        },
        fill: {
          type: "gradient",
          gradient: {
            shade: "light",
            shadeIntensity: 0.0,
            inverseColors: true,
            opacityFrom: 1,
            opacityTo: 1,
            stops: [0, 50, 53, 91]
          }
        },
        labels: ["Per Day"],
        colors: ["#04cd04"]
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
              strokeWidth: "97%",
              margin: 5, // margin is in pixels
              shadow: {
                enabled: true,
                top: 2,
                left: 0,
                color: "#04cd04",
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
                fontSize: "22px"
              }
            }
          }
        },
        fill: {
          type: "gradient",
          gradient: {
            shade: "light",
            shadeIntensity: 0.0,
            inverseColors: true,
            opacityFrom: 1,
            opacityTo: 1,
            stops: [0, 50, 53, 91]
          }
        },
        labels: ["Average Results"],
        colors: ["#04cd04"]
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
              strokeWidth: "97%",
              margin: 5, // margin is in pixels
              shadow: {
                enabled: true,
                top: 2,
                left: 0,
                color: "#04cd04",
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
                fontSize: "22px"
              }
            }
          }
        },
        fill: {
          type: "gradient",
          gradient: {
            shade: "light",
            shadeIntensity: 0.0,
            inverseColors: true,
            opacityFrom: 1,
            opacityTo: 1,
            stops: [0, 50, 53, 91]
          }
        },
        labels: ["Average Results"],
        colors: ["#04cd04"]
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
              strokeWidth: "97%",
              margin: 5, // margin is in pixels
              shadow: {
                enabled: true,
                top: 2,
                left: 0,
                color: "#04cd04",
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
                fontSize: "22px"
              }
            }
          }
        },
        fill: {
          type: "gradient",
          gradient: {
            shade: "light",
            shadeIntensity: 0.0,
            inverseColors: true,
            opacityFrom: 1,
            opacityTo: 1,
            stops: [0, 50, 53, 91]
          }
        },
        labels: ["Average Results"],
        colors: ["#04cd04"]
      },

      headers: [
        {
          text: "Name",
          align: "left",
          sortable: false,
          value: "name"
        },
        { text: "email", value: "email" },
        { text: "ID", value: "id" },
        { text: "Phone Number", value: "phonenumber" }
      ],
      user: []
    };
  },
  beforeMount(){
      return new Promise((resolve, reject) => {
            axios.get("employees", {params:{}, headers: {
                Authorization: "Bearer " + this.$store.state.token,
                Accept: "application/json"
            } })
                .then(response => {
                    this.user = response.data.data;
                    resolve(response);
                })
                .catch(error => {
                    console.log(error);
                    reject(error);
                });
        });
  }
};
</script>

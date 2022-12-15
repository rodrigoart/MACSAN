
<script>
import { Bar } from 'vue-chartjs'

import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js'

ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale)

export default {
  name: 'BarChart',
  components: { Bar },
  props: {
    count_problemas_month: Array,
    chartId: {
      type: String,
      default: 'bar-chart'
    },
    datasetIdKey: {
      type: String,
      default: 'label'
    },
    width: {
      type: Number,
      default: 400
    },
    height: {
      type: Number,
      default: 400
    },
    cssClasses: {
      default: '',
      type: String
    },
    styles: {
      type: Object,
      default: () => {}
    },
    plugins: {
      type: Object,
      default: () => {}
    }
  },
  data() {
    return {
      chartData: {
      labels: [
        'Enero',
        'Febrero',
        'Marzo',
        'Abril',
        'Mayo',
        'Junio',
        'Julio',
        'Agosto',
        'Septiembre',
        'Octubre',
        'Noviembre',
        'Diciembre'
      ],
datasets: [{
          label: 'Problemas solucionados este año',
          backgroundColor: '#f87979',
          data: this.meses(),
        }]
      },
      chartOptions: {
        responsive: true
      }
    }
  },
  methods: {
      meses(){
          let meses_array = [];
          for(let i=1; i<= 12; i++){
              meses_array.push(0);
          }
          for(let i=0; i<= 11; i++){
              if(this.count_problemas_month[i]){
                  meses_array[this.count_problemas_month[i]['month']-1] = this.count_problemas_month[i]['problemas_solucionados'];
              }

          }
          return meses_array;
      },
  }
}

</script>

<template>
  <Bar
      :chart-options="chartOptions"
      :chart-data="chartData"
      :chart-id="chartId"
      :dataset-id-key="datasetIdKey"
      :plugins="plugins"
      :css-classes="cssClasses"
      :styles="styles"
      :width="width"
      :height="height"
  />
</template>

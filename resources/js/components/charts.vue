<template>
    <div class="container">
 <line-chart :data="chartdata" :option="options"></line-chart>/>

    </div>
</template>

<script>
import Chart from 'chart.js';
import { Bar } from 'vue-chartjs'

export default {
    name : 'charts',
  extends: Bar,
  data() {
       return{
           
       }
     },

  mounted () {
    this.renderChart(this.chartdata, this.options)
  }
}</script>

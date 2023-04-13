<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head} from '@inertiajs/vue3';
import "https://cdn.plot.ly/plotly-2.20.0.js"
import PrimaryButton from "@/Components/PrimaryButton.vue";

const props = defineProps({
  headers: Object,
  data: Object,
});

function plot() {
  // remove the buttton with id plot-btn
  document.getElementById("plot-btn").remove();

  const chartData = {
    type: 'parcoords',
    dimensions: props.headers.map(header => {
      return {
        label: header,
        values: props.data.map(row => row[header])
      }
    }),
    line: {
      color: 'blue'
    }
  };

  Plotly.newPlot("chart", [chartData]);
}
</script>

<template>
  <Head title="Dataset"/>
  <AuthenticatedLayout>
    <h1 class="text-4xl font-bold tracking-tighter mb-8 px-12 2xl:p-0">Dataset</h1>

    <div id="chart"/>
    <PrimaryButton id="plot-btn" @click="plot()">Plot</PrimaryButton>
    <!--    <table>-->
    <!--      <thead>-->
    <!--      <tr>-->
    <!--        <th v-for="header in props.headers">-->
    <!--          {{ header }}-->
    <!--        </th>-->
    <!--      </tr>-->
    <!--      </thead>-->
    <!--      <tbody>-->
    <!--      <tr v-for="row in props.data">-->
    <!--        <td v-for="cell in row">-->
    <!--          {{ cell }}-->
    <!--        </td>-->
    <!--      </tr>-->
    <!--      </tbody>-->
    <!--    </table>-->

  </AuthenticatedLayout>
</template>

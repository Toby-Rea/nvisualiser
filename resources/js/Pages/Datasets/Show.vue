<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head} from '@inertiajs/vue3';
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {ref} from "vue";

import "https://cdn.plot.ly/plotly-2.20.0.js"

const props = defineProps({
  headers: Object,
  data: Object,
});

const numRecords = ref(props.data.length);

function plot() {
  // document.getElementById("chart-options").remove();

  // Remove SEQN from headers
  const dimensions = props.headers.filter(header => header !== "SEQN");

  // Randomly select records
  const randomRows = props.data
    .map((row, index) => ({index, row}))
    .sort(() => Math.random() - 0.5)
    .slice(0, numRecords.value)
    .map(({row}) => row);

  const chartData = {
    type: 'parcoords',
    dimensions: dimensions.map(header => {
      return {
        label: header,
        values: randomRows.map(row => row[header])
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

    <div class="flex flex-col space-y-8" id="chart-options">
      <div>
        <label for="num-records">Number of records to plot (defaults to total number)</label>
        <input class="ml-2" type="number" v-model="numRecords" min="1" :max="props.data.length"/>
      </div>

      <PrimaryButton id="plot-btn" @click="plot()">Plot</PrimaryButton>
    </div>

    <div id="chart"/>

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

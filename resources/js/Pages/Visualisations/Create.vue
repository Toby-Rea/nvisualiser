<script setup>
  import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
  import {ref, watch} from "vue";
  import {newPlot} from "plotly.js-dist";
  import PrimaryButton from "@/Components/PrimaryButton.vue";
  import {Head} from "@inertiajs/vue3";
  import {debounce} from "lodash";

  //create an array which holds the available datasets
  const availableDatasets = ref();
  axios.get("/api/available_datasets")
    .then((response) => {
      availableDatasets.value = response.data.datasets.map(dataset => ({ name: dataset }));
    })
    .catch((error) => {
      console.log(error);
    }
  );

  // create a ref to hold the selected datasets
  const selectedDataset = ref();

  const totalRecords = ref(0);
  const rows = ref([]);
  const headers = ref([]);
  const chartType = ref();

  // watch the value of selectedDataset and if it changes, pull the data in
  watch(selectedDataset, (value) => {
    // make a get request to the api to get the data for the selected dataset
    axios.get(`/api/datasets/${value}`)
      .then((response) => {
        rows.value = response.data.rows;
        headers.value = response.data.headers;
        totalRecords.value = response.data.rows.length;
      })
      .catch((error) => {
        console.log(error);
      });
  });

  const selectedHeaders = ref([]);
  const selectedRows = ref([]);
  const rowVisualisationCount = ref(totalRecords.value);

  // Randomly select rows to display when not displaying all
  watch(rowVisualisationCount, debounce((value) => {
    if (value < totalRecords.value) {
      selectedRows.value = rows.value
        .map((row, index) => ({index, row}))
        .sort(() => Math.random() - 0.5)
        .slice(0, value)
        .map(({row}) => row);
    } else {
      selectedRows.value = rows.value;
    }
  }), 300);

  function plot() {
    // switch chart type and call respective function
    switch (chartType.value) {
      case "parcoords":
        plot_paracords();
        break;
      case "scatter":
        plot_scatter();
        break;
    }
  }

  function plot_paracords() {
    const chartData = {
      type: chartType.value,
      dimensions: selectedHeaders.value.map(header => {
        return {
          label: header,
          values: selectedRows.value.map(row => row[header])
        }
      }),
    };

    newPlot("chart", [chartData]);
  }

  function plot_scatter() {
    const chartData = {
      type: chartType.value,
      x: selectedRows.value.map(row => row[selectedHeaders.value[0]]),
      y: selectedRows.value.map(row => row[selectedHeaders.value[1]]),
      mode: 'markers',
    }
    const layout = {
      xaxis: {
        title: {
          text: selectedHeaders.value[0],
        },
      },
      yaxis: {
        title: {
          text: selectedHeaders.value[1],
        }
      }
    };

    newPlot("chart", [chartData], layout);
  }
</script>

<template>
  <Head title="New Visualisation"/>

  <AuthenticatedLayout title="New Visualisation"
                       description="Select the datasets you are interested in and set the visualisation options accordingly.">

    <h1 class="text-xl font-bold tracking-tight my-4">Select the Dataset</h1>
    <select v-model="selectedDataset">
      <option v-for="dataset in availableDatasets" :value="dataset.name">
        {{ dataset.name }}
      </option>
    </select>

    <div v-if="selectedDataset" class="flex flex-col">
      <h1 class="text-xl font-bold tracking-tight my-4">Set the Chart Type</h1>
      <select v-model="chartType">
        <option value="parcoords">Parallel Coordinates</option>
        <option value="scatter">Scatter Plot</option>
      </select>
    </div>

    <div v-if="chartType" class="flex flex-col gap-4">
      <h1 class="text-xl font-bold tracking-tight my-4">Set the Chart Options</h1>
      <h2 class="tracking-tight font-semibold">Select the Headers</h2>
      <select v-model="selectedHeaders" multiple>
        <option v-for="header in headers" :value="header">{{ header }}</option>
      </select>

      <h2 class="tracking-tight font-semibold">Select number of rows to visualise (randomised)</h2>
      <div class="flex gap-8">
        <input type="range" min="0" :max="totalRecords" v-model="rowVisualisationCount" class="w-11/12">
        <input type="number" min="0" :max="totalRecords" v-model="rowVisualisationCount" class="w-1/12">
      </div>

    </div>

    <PrimaryButton v-if="chartType" @click="plot()" class="my-4">Plot</PrimaryButton>

    <div id="chart"/>

  </AuthenticatedLayout>
</template>

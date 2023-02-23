<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/vue3';
import {ref, watch} from 'vue';

const props = defineProps({
  datasets: Array,
});

// Reverse chronological order, showing the newest data first
let datasets = ref(props.datasets.sort((a, b) => parseInt(b.years.split('-')[1]) > parseInt(a.years.split('-')[1])))
let query = ref('')

// Filter datasets functionality
watch(query, () => {
  datasets = props.datasets.filter((dataset) => {
    return Object.values(dataset).toString().toLowerCase().includes(query.value.trim().toLowerCase());
  })
})
</script>

<template>
  <Head title="Datasets"/>
  <AuthenticatedLayout>
      <h1 class="text-4xl font-bold tracking-tighter mb-12 px-12 2xl:p-0">Datasets</h1>
      <div class="flex flex-col flex-none gap-12 bg-white rounded-xl px-12 2xl:border-2 2xl:py-12">
        <input type="text" placeholder="Search..." v-model="query"
               class="w-full rounded-lg border-neutral-300 px-6 py-3 hover:scale-[1.01] hover:border-neutral-400 focus:scale-[1.01] focus:ring-0 focus:border-neutral-600 transition-all">
        <table class="table-fixed text-sm font-light">
          <thead class="border-b w-full">
          <tr class="text-left text-neutral-600 [&>*]:px-4 [&>*]:py-2">
            <th class="w-32">Years</th>
            <th class="w-48">Component</th>
            <th class="w-72">Description</th>
            <th class="w-72">Documentation URL</th>
            <th class="w-72">Download URL</th>
          </tr>
          </thead>
          <tbody class="text-sm">
          <tr v-for="dataset in datasets" class="border-b transition-all hover:bg-gray-50 [&>*]:px-4 [&>*]:py-2">
            <td>{{ dataset["years"] }}</td>
            <td>{{ dataset["component"] }}</td>
            <td>{{ dataset["description"] }}</td>
            <td><a :href="dataset.docs_url" class="text-blue-500 underline hover:opacity-80">{{
                dataset["docs_url"]
              }}</a>
            </td>
            <td><a :href="dataset.data_url" class="text-blue-500 underline hover:opacity-80">{{
                dataset["data_url"]
              }}</a>
            </td>
          </tr>
          </tbody>
        </table>
      </div>
  </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head} from '@inertiajs/vue3';

const props = defineProps({
  data: Object,
  headers: Object,
});
</script>

<template>
  <Head title="Dataset"/>
  <AuthenticatedLayout>
    <h1 class="text-4xl font-bold tracking-tighter mb-8 px-12 2xl:p-0">Dataset</h1>

    <table>
      <thead>
      <tr>
        <th v-for="header in props.headers">
          {{ header }}
        </th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="row in props.data">
        <td v-for="cell in row">
          {{ cell }}
        </td>
      </tr>
      </tbody>
    </table>

  </AuthenticatedLayout>
</template>

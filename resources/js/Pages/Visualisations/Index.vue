<script setup>
  import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
  import {Link, Head} from '@inertiajs/vue3';
</script>

<template>
  <Head title="Visualisations"/>

  <AuthenticatedLayout title="Visualisations" description="Create new visualisations or view existing ones.">
    <Link :href="route('visualisations.create')" class="text-blue-500">Create</Link>
  </AuthenticatedLayout>
</template>

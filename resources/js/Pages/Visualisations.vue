<script setup>
  import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
  import {router, Head, Link} from '@inertiajs/vue3';
</script>

<template>
  <AuthenticatedLayout title="Visualisations" description="Get started with creating visualisations.">
    <Head title="Visualisations"/>

    <Link href="/visualisations/create" class="p-2 bg-neutral-100 text-sm hover:scale-105 hover:bg-neutral-200 rounded-md transition-all">
      <p class="font-semibold">Create a new visualisation</p>
    </Link>
  </AuthenticatedLayout>
</template>

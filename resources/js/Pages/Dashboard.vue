<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/vue3';
</script>

<template>
  <Head title="Dashboard"/>
  <AuthenticatedLayout>
    <h1 class="text-2xl font-bold tracking-tighter">Dashboard</h1>
  </AuthenticatedLayout>
</template>

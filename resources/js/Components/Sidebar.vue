<script setup>
import {usePage, Link} from '@inertiajs/vue3'
import {computed} from 'vue'

const user = computed(() => usePage().props.auth.user)
</script>

<template>
  <div class="flex flex-none flex-col justify-between sticky top-0 h-screen border-r-2 px-8 py-6">
    <h1 class="font-extrabold text-3xl tracking-tight text-center">NVisualiser</h1>
    <nav class="flex flex-col gap-4 text-sm font-semibold">
      <Link :href="route('dashboard')" class="py-2 border-b hover:border-b-rose-800 hover:scale-105 transition-all" :class="{'border-rose-800': $page.url.startsWith('/dashboard')}">Dashboard</Link>
      <Link :href="route('datasets.index')" class="py-2 border-b hover:border-b-rose-800 hover:scale-105 transition-all" :class="{'border-rose-800': $page.url.startsWith('/datasets')}">Datasets</Link>
      <Link :href="route('visualisations.index')" class="py-2 border-b hover:border-b-rose-800 hover:scale-105 transition-all" :class="{'border-rose-800': $page.url.startsWith('/visualisations')}">Visualisations</Link>
    </nav>
    <Link :href="route('profile.edit')" class="p-2 bg-neutral-100 text-sm hover:scale-105 hover:bg-neutral-200 rounded-md transition-all">
      <p class="font-semibold">{{ user.name }}</p>
      <p>{{ user.email }}</p>
    </Link>
  </div>
</template>
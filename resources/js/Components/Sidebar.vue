<script setup>
import {usePage, Link} from '@inertiajs/vue3'
import {computed} from 'vue'

const user = computed(() => usePage().props.auth.user)
</script>

<template>
  <div class="flex flex-none flex-col bg-neutral-50 justify-between sticky top-0 h-screen border-r border-neutral-100 px-8 py-6">
    <div class="flex flex-col gap-8">
      <h1 class="font-extrabold text-2xl tracking-tight">NVisualiser</h1>
      <nav class="flex flex-col gap-4 tracking-tight font-semibold text-slate-500">
        <Link :href="route('dashboard')" class="p-2.5 rounded-md hover:bg-slate-100 transition-all" :class="{'bg-slate-200 text-slate-600': $page.url.startsWith('/dashboard')}">Dashboard</Link>
        <Link :href="route('datasets.index')" class="p-2.5 rounded-md hover:bg-slate-100 transition-all" :class="{'bg-slate-200 text-slate-600': $page.url.startsWith('/datasets')}">Datasets</Link>
        <Link :href="route('visualisations.index')" class="p-2.5 rounded-md hover:bg-slate-100 transition-all" :class="{'bg-slate-200 text-slate-600': $page.url.startsWith('/visualisations')}">Visualisations</Link>
      </nav>
    </div>

    <Link :href="route('profile.edit')" class="p-4 bg-white border text-sm hover:scale-105 hover:bg-neutral-200 rounded-md transition-all">
      <p class="font-semibold">{{ user.name }}</p>
      <p class="text-xs text-neutral-500">{{ user.email }}</p>
    </Link>
  </div>
</template>

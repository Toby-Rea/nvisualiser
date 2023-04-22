<script setup>
  import {usePage, Link} from '@inertiajs/vue3'
  import {computed} from 'vue'
  import { Icon } from '@iconify/vue';

  const user = computed(() => usePage().props.auth.user)
</script>

<template>
  <div class="hidden md:block bg-neutral-50 sticky top-0 h-screen border-r border-neutral-100 p-8 shadow-sm max-w-[288px]">
    <div class="flex flex-col gap-8">
      <img src="/nvisualiser.svg" alt="NVisualiser" class="w-3/4 mx-auto">
      <nav class="flex flex-col gap-4 tracking-tight font-semibold text-slate-500">
        <Link :href="route('dashboard')" class="flex items-center gap-2 p-2.5 rounded-md hover:bg-slate-100 hover:scale-[1.02] transition-all" :class="{'shadow-sm bg-slate-200 text-slate-600': $page.url.startsWith('/dashboard')}">
          <Icon icon="octicon:home-16" />
          Dashboard
        </Link>
        <Link :href="route('datasets.index')" class="flex items-center gap-2 p-2.5 rounded-md hover:bg-slate-100 hover:scale-[1.02] transition-all" :class="{'shadow-sm bg-slate-200 text-slate-600': $page.url.startsWith('/datasets')}">
          <Icon icon="octicon:database-16" />
          Datasets
        </Link>
        <Link :href="route('visualisations.index')" class="flex items-center gap-2 p-2.5 rounded-md hover:bg-slate-100 hover:scale-[1.02] transition-all" :class="{'shadow-sm bg-slate-200 text-slate-600': $page.url.startsWith('/visualisations')}">
          <Icon icon="octicon:graph-16" />
          Visualisations
        </Link>
      </nav>
    </div>

    <Link :href="route('profile.edit')" class="absolute bottom-0 left-0 right-0 flex flex-col justify-center rounded-md bg-white border p-4 m-6 hover:opacity-40 transition-all">
      <p class="font-semibold">{{ user.name }}</p>
      <p class="text-xs text-neutral-500 truncate">{{ user.email }}</p>
    </Link>
  </div>
</template>

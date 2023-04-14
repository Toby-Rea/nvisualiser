<script setup>
  import Sidebar from "@/Components/Sidebar.vue";

  const props = defineProps({
    title: String,
    description: String,
  });
</script>

<template>
  <div class="w-screen h-full flex">
    <Sidebar/>

    <div class="flex flex-col m-16 w-full">
      <section class="flex flex-col gap-4 mb-12">
        <h1 class="text-3xl font-bold tracking-tighter">{{ title }}</h1>
        <p class="font-medium text-neutral-500">{{ description }}</p>
      </section>

      <slot/>
    </div>
  </div>
</template>

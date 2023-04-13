<script setup>
  import Sidebar from "@/Components/Sidebar.vue";
</script>

<template>
  <div class="w-screen h-full flex">
    <Sidebar/>

    <div class="flex flex-col m-16 w-full">
      <slot/>
    </div>
  </div>
</template>

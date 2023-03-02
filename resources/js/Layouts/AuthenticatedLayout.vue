<template>
  <div class="w-screen h-full flex">
    <Sidebar/>

    <div class="flex flex-col mx-auto my-8">
      <slot/>
    </div>
  </div>
</template>
<script setup>
import Sidebar from "@/Components/Sidebar.vue";
</script>

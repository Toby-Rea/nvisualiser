<script setup>
import {Link, Head} from '@inertiajs/vue3';
import { Icon } from '@iconify/vue';

defineProps({
  auth: Object,
})
</script>

<template>
  <Head title="Welcome"/>

  <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen">
    <section class="bg-white">
      <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
        <div class="text-center tracking-tighter">
          <h1 class="text-4xl font-extrabold sm:text-5xl md:text-6xl">
            Welcome to NVisualiser, the NHANES Data Explorer
          </h1>
          <p class="mt-8 sm:mt-16 text-lg sm:text-2xl text-neutral-500">
            This site provides you with a host of tools to visualise data from the&nbsp;
            <a class="font-medium underline text-blue-500 hover:opacity-80"
               href="https://www.cdc.gov/nchs/nhanes/about_nhanes.htm">
              National Health and Nutrition Examination Survey (NHANES)
            </a>
          </p>
        </div>
      </div>
      <div class="mt-2 sm:mt-8 flex justify-center">
        <div v-if="auth.user">
          <Link href="/dashboard"
                class="flex items-center gap-4 font-semibold max-w-md py-3 px-12 rounded-md text-center text-neutral-800 bg-neutral-200 hover:bg-neutral-300">
            Get back into it
            <Icon icon="octicon:arrow-right-16" />
          </Link>
        </div>
        <div v-else>
          <Link href="/login"
                class="flex items-center gap-4 font-semibold max-w-md py-3 px-12 rounded-md text-center text-neutral-800 bg-neutral-200 hover:bg-neutral-300">
            Get Started
            <Icon icon="octicon:arrow-right-16" />
          </Link>
        </div>
      </div>
    </section>
  </div>
</template>

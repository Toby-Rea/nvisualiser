<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {router, Head, Link} from '@inertiajs/vue3';
import {ref, watch} from 'vue';
import {Icon} from '@iconify/vue';
import {debounce} from 'lodash';

const props = defineProps({
  datasets: Object,
  filters: Object,
});

let search = ref(props.filters.search)
watch(search, debounce((value) => {
  router.get(
    '/datasets',
    {search: value},
    {
      preserveState: true,
      replace: true
    }
  )
}, 150))

const download = (id) => {
  router.get('/datasets/' + id)
}
</script>

<template>
  <Head title="Datasets"/>
  <AuthenticatedLayout>
    <h1 class="text-4xl font-bold tracking-tighter mb-8 px-12 2xl:p-0">Datasets</h1>
    <div class="flex flex-col flex-none bg-white rounded-xl px-12 2xl:border-2 2xl:py-8">
      <input type="text" placeholder="Search..." v-model="search"
             class="w-full rounded-lg border-neutral-300 mb-12 px-6 py-3 hover:scale-[1.01] hover:border-neutral-400 focus:scale-[1.01] focus:ring-0 focus:border-neutral-600 transition-all">
      <table class="table-fixed text-sm font-light">
        <thead class="border-b w-full">
        <tr class="text-left text-neutral-600 [&>*]:px-4 [&>*]:py-2">
          <th class="w-32">Years</th>
          <th class="w-40">Component</th>
          <th class="w-80">Description</th>
          <th class="w-72">Documentation URL</th>
          <th class="w-24">Status</th>
          <th class="w-60">Actions</th>
        </tr>
        </thead>
        <tbody class="text-sm">
        <tr v-for="dataset in props.datasets.data"
            class="border-b transition-all hover:bg-gray-50 [&>*]:px-4 [&>*]:py-2">
          <td>{{ dataset["start_year"] }}-{{ dataset["end_year"] }}</td>
          <td>{{ dataset["component"] }}</td>
          <td>{{ dataset["description"] }}</td>
          <td>
            <a :href="dataset['docs_url']" class="text-blue-500 underline hover:opacity-80">
              {{ dataset["docs_url"] }}
            </a>
          </td>
          <td>
            <div class="items-center">
              <p v-if="dataset['downloaded']">Downloaded</p>
              <p v-else>Available</p>
            </div>
          </td>
          <td>
            <button v-if="!dataset['downloaded']" type="button"
                    class="items-center p-2 bg-neutral-800 rounded-md text-white font-semibold hover:opacity-80"
                    @click="download(dataset['id'])">
              <Icon icon="iconoir:download" class="w-6 h-6"/>
            </button>
          </td>
        </tr>
        </tbody>
      </table>

      <div class="flex items-center justify-center gap-4 mt-6">
        <template v-for="(link, key) in props.datasets.links" :key="key">
          <div v-if="link.url === null" class="px-4 py-2 text-sm border rounded" v-html="link.label"/>
          <Link v-else
                class="px-4 py-2 text-sm border rounded hover:bg-neutral-200"
                :class="{ 'bg-neutral-100': link.active }" :href="link.url" v-html="link.label"/>
        </template>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

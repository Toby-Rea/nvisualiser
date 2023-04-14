<script setup>
  import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
  import {router, Head, Link} from '@inertiajs/vue3';
  import {ref, watch} from 'vue';
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

  let selectedIds = ref([])
</script>

<template>
  <Head title="Datasets"/>
  <AuthenticatedLayout title="Datasets" description="View all the datasets available through NHANES.">

    <div class="flex flex-col flex-none">
      <input type="text" placeholder="Search..." v-model="search"
             class="block w-full rounded-lg border-neutral-300 px-6 py-3 hover:scale-[1.01] focus:scale-[1.01] focus:ring-0 focus:border-neutral-600 transition-all">
      <table class="mt-12 table-fixed text-sm font-light">
        <thead class="border-b w-full">
        <tr class="text-left text-neutral-600 [&>*]:px-4 [&>*]:py-2">
          <th class="w-36">Years</th>
          <th class="w-40">Component</th>
          <th class="w-80">Description</th>
          <th class="w-72">Documentation URL</th>
          <th class="w-72">Dataset URL</th>
        </tr>
        </thead>
        <tbody class="text-sm">
        <tr v-for="dataset in props.datasets.data"
            class="border-b transition-all hover:bg-gray-50 [&>*]:px-4 [&>*]:py-2">
          <td>
            <input type="checkbox"
                   class="mr-2 w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2"
                   :value="dataset.id" v-model="selectedIds">
            <label :for="dataset.id" class="w-full py-4 ml-2">
              {{ dataset["start_year"] }}-{{ dataset["end_year"] }}
            </label>
          </td>
          <td>{{ dataset["component"] }}</td>
          <td>{{ dataset["description"] }}</td>
          <td>
            <a :href="dataset['docs_url']" class="text-blue-500 underline hover:opacity-80">
              {{ dataset["docs_url"] }}
            </a>
          </td>
          <td>
            <a :href="dataset['data_url']" class="text-blue-500 underline hover:opacity-80">
              {{ dataset["data_url"] }}
            </a>
          </td>
        </tr>
        </tbody>
      </table>

      <!-- Pagination -->
      <div class="flex items-center justify-center gap-4 mt-6">
        <template v-for="(link, key) in props.datasets.links" :key="key">
          <div v-if="link.url === null" class="px-4 py-2 text-sm border rounded cursor-default hidden"
               v-html="link.label"/>
          <Link v-else
                class="px-4 py-2 text-sm border rounded hover:bg-neutral-200"
                :class="{ 'bg-neutral-100': link.active }" :href="link.url" v-html="link.label"/>
        </template>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

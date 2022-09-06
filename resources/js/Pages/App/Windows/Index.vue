<template>
  <Head>
    <title>Windows</title>
  </Head>
  <div class="mx-5 flex justify-between">
    <Breadcrumb :links="[
      {
        label: 'Windows',
        to: '#', 
      }
    ]" />
    <Link href="windows/create" class="rounded p-2 font-semibold text-lg bg-sky-600 text-white hover:bg-sky-500 hover:cursor-pointer">Create</Link>
  </div>

  <div class="m-5 p-3 grid grid-cols-4 gap-4">
    <template v-if="windows.length">
      <div class="flex justify-center" v-for="(window, i) in windows" :key="i">
        <div class="w-full block p-6 rounded-lg shadow-lg bg-white max-w-sm transition duration-100 hover:bg-sky-100">
          <div class="mb-2 flex justify-between items-center">
            <h5 class="text-xl leading-tight font-medium mb-2" v-text="window.name + ' (' + window.transaction + ')'"/>
            <Link :href="`windows/${window.id}/edit`" class="rounded p-2 shadow transition duration-100 hover:bg-white text-sky-500">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
              </svg>
            </Link>
          </div>
          <p class="text-base mb-4" v-text="window.description"/>
        </div>
      </div>
    </template>
    <template v-else>
      <p class="text-3xl">No created windows yet.</p>
    </template>
  </div>
</template>

<script>
import AdminLayout from '../../../Layouts/Admin.vue'
import Breadcrumb from '../../../Components/Breadcrumb.vue'

export default {
  layout: AdminLayout,

  components: {
    Breadcrumb,
  },

  props: {
    windows: Array,
  }
}
</script>

<style>

</style>
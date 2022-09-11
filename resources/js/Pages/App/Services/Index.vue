<template>
  <Head>
    <title>Transactions</title>
  </Head>
  <div class="mx-5 flex justify-between">
    <Breadcrumb :links="[
      {
        label: 'Services',
        to: '#'
      }
    ]" />
    <Link href="services/create" class="rounded p-2 font-semibold text-lg bg-sky-600 text-white hover:bg-sky-500 hover:cursor-pointer">Create</Link>
  </div>

  <template v-if="services.length">
    <div class="m-5 p-3 grid grid-cols-4 gap-4">
        <div class="flex justify-center w-full" v-for="(service, i) in services" :key="i">
          <div class="w-full block p-6 rounded-lg shadow-lg bg-white max-w-sm transition duration-100 hover:bg-sky-100">
            <div class="mb-2 flex justify-between items-center">
              <h5 class="text-xl leading-tight font-medium mb-2" v-text="service.type"/>
              <Link :href="`services/${service.id}/edit`" class="rounded p-2 shadow transition duration-100 hover:bg-white text-sky-500">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                </svg>
              </Link>
            </div>
            <p class="text-base mb-4" v-text="service.description"/>
          </div>
        </div>
    </div>
  </template>
  <template v-else>
    <div class="m-6 pt-6 flex flex-col justifty-center items-center">
      <div class="w-1/2">
        <Vue3Lottie :animationData="emptyLottie" class="w-1/2"/>
      </div>
      <p class="text-3xl">No created windows yet.</p>
    </div>
  </template>
  
</template>

<script>
import AdminLayout from '@/Layouts/Admin.vue'
import Breadcrumb from '@/Components/Breadcrumb.vue'

import { Vue3Lottie } from 'vue3-lottie'
import 'vue3-lottie/dist/style.css'
import emptyLottie from '@/../json/empty.json'



export default {
  layout: AdminLayout,

  components: {
    Breadcrumb,
    Vue3Lottie,
  },

  data() {
    return {
      emptyLottie,
    }
  },

  props: {
    services: Array,
  }
}
</script>

<style>

</style>
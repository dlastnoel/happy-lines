<template :auth="auth" :window="window">
  <Head>
    <title>{{window.name}}</title>
  </Head>
  <div class="mx-5">
    <Breadcrumb :links="[
      {
        label: window.name,
        to: '#',
      },
    ]" />
  </div>
  <div class="m-5 p-3 grid grid-cols-2 gap-4"> 
    <table class="w-full table-auto shadow">
      <thead>
        <tr class="text-xs text-left text-gray-500 bg-gray-100 border-b-2">
            <th class="p-3 text-center">Queue Number</th>
            <th class="p-3 text-center">Fullname</th>
            <th class="p-3">
            </th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(patient, i) in patients" :key="i">
          <td class="p-3 text-center">{{patient.number}}</td>
          <td class="p-3 text-center">{{patient.fullname}}</td>
          <td class="p-3">
             <Link :href="`/queues/${window.id}/${patient.id}/next`" class="rounded p-1 font-semibold text-sm bg-sky-600 text-white hover:bg-sky-500 hover:cursor-pointer">Next</Link>
          </td>
        </tr>
      </tbody>
    </table>
    <div class="bg-gray-100 shadow p-3">
      <h3 class="text-3xl text-center">Serving</h3>
    </div>
  </div>
</template>

<script>
import AdminLayout from '@/Layouts/Admin.vue'
import Breadcrumb from '@/Components/Breadcrumb.vue'

export default {

  components: {
    Breadcrumb,
  },

  props: {
    auth: Object,
    window: {
      type: Object,
      required: true,
      default: {
        id: '',
        name: '',
      }
    },
    patients: Object,
  },

  layout: AdminLayout
}
</script>

<style>

</style>
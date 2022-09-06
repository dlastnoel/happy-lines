<template>
  <Head>
    <title>Staffs</title>
  </Head>
  <div class="mx-5 flex justify-between">
    <Breadcrumb :links="[
      {
        label: 'Staffs',
        to: '#', 
      }
    ]" />
    <Link href="staffs/register" class="rounded p-2 font-semibold text-lg bg-sky-600 text-white hover:bg-sky-500 hover:cursor-pointer">Register</Link>
  </div>
  <!-- {{users}} -->
  <div class="m-5 p-3">
    <table class="w-full table-auto border-2 shadow">
      <thead>
        <tr class="text-xs capitalize text-left text-gray-500 bg-gray-100">
            <th class="p-3">Staff Name</th>
            <th class="p-3">Contact Number</th>
            <th class="p-3">Email</th>
            <th class="p-3">Username</th>
            <th class="p-3">Status</th>
            <th class="p-3"></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(user, i) in users" :key="i">
          <td class="p-3">{{user.fullname}}</td>
          <td class="p-3">{{user.contact_no}}</td>
          <td class="p-3">{{user.email}}</td>
          <td class="p-3">{{user.username}}</td>
          <td class="p-3">{{user.status}}</td>
          <td class="p-3">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
              <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import AdminLayout from '@/Layouts/Admin.vue'
import Breadcrumb from '@/Components/Breadcrumb.vue'

export default {
  layout: AdminLayout,

  components: {
    Breadcrumb,
  },

  props: {
    users: Object
  }
}

</script>

<style>

</style>
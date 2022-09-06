<template>
  <Head>
    <title>Windows</title>
  </Head>
  <div class="mx-5">
    <Breadcrumb :links="[
      {
        label: 'Windows',
        to: '/windows',
      },
      {
        label: window.name,
        to: '#',
      }
    ]" />
  </div>

  <div class="m-5 p-3 shadow rounded bg-white">
    <form @submit.prevent="handleSubmit()">
      <div>
        <div class="my-2">
          <p class="text-xl font-semibold">Window Information</p>
          <hr>
        </div>
        <div class="mt-2 w-full flex flex-col gap-3 p-2">
          <label for="name">
            <span>Window Name</span>
            <input 
              type="text" name="name" id="name" placeholder="Window Name" 
              class="block w-full rounded px-3 py-2 border border-sky-600"
              v-model="window.name">
            <div v-if="errors.name">
              <p class="text-sm text-red-700">{{errors.name}}</p>
            </div>
          </label>
          <label for="transaction">
            <span>Window For</span>
            <select 
              name="transaction" id="transaction" 
              class="block w-full bg-white px-3 p-2 rounded border border-sky-600"
              v-model="window.transaction_id">
              <option :value="null" disabled>Select Transaction Type</option>
              <option :value="window.transaction_id">{{window.transaction_type}}</option>
              <template v-for="(transaction, i) in transactions" :key="i">
                <option :value="transaction.id">{{transaction.type}}</option>
              </template>
            </select>
            <div v-if="errors.transaction_id">
              <p class="text-sm text-red-700">{{errors.transaction_id}}</p>
            </div>
          </label>
          <label for="Description">
            <span>Description</span>
            <textarea 
              name="description" id="description" placeholder="Description" 
              cols="30" rows="5" class="block w-full rounded px-3 py-2 border border-sky-600"
              v-model="window.description"/>
            <div v-if="errors.description">
              <p class="text-sm text-red-700">The transaction type field is required.</p>
            </div>
          </label>
          <div class="flex justify-between items-start">
            <label for="status">
              <input
                type="checkbox" name="status" id="status" 
                class="border-sky-600" v-model="window.is_active">
              <span class="ml-1">Set as Active</span>
            </label>
            <div class="flex justify-center items-center gap-2 p-2">
              <!-- <button type="reset" class="block rounded p-3 font-semibold text-lg bg-gray-200 text-black hover:bg-gray-100 hover:cursor-pointer">Clear Fields</button> -->
              <button type="submit" class="block rounded p-3 font-semibold text-lg bg-sky-600 text-white hover:bg-sky-500 hover:cursor-pointer">Update Window</button>
            </div>
          </div>
        </div>
      </div>
    </form>
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
    transactions: Object,
    window: Object,
    errors: Object
  },

  data() {
    return {
      submitted: false,
    }
  },

  methods: {
    handleSubmit() {
      this.submitted = true
      this.$inertia.put(`/windows/${this.window.id}`, this.window, {
        onError: () => {
          this.showToast('Error updated window', 'error')
        },
        onSuccess: () => {
          this.showToast('Succesfully updated window', 'success')
        }
      })
      this.submitted = false
    },

    // clearFields() {
    //   this.window = {
    //     name: '',
    //     transaction_id: null,
    //     description: '',
    //     is_active: false,
    //   }
    // }
  }
}
</script>

<style>

</style>
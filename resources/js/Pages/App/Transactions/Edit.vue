<template>
  <Head>
    <title>Transactions</title>
  </Head>
  <div class="mx-5">
    <Breadcrumb :links="[
      {
        label: 'Transactions',
        to: '/transactions',
      },
      {
        label: transaction.type,
        to: '#',
      }
    ]" />
  </div>

  <div class="m-5 p-3 shadow rounded bg-white">
    <form @submit.prevent="handleSubmit()">
      <div>
        <div class="my-2">
          <p class="text-xl font-semibold">Transaction Information</p>
          <hr>
        </div>
        <div class="mt-2 w-full flex flex-col gap-3 p-2">
          <label for="type">
            <span>Transaction Type</span>
            <input 
              type="text" name="type" id="type" placeholder="Transaction Type" 
              class="block w-full rounded px-3 py-2 border border-sky-600"
              v-model="transaction.type">
            <div v-if="errors.type">
              <p class="text-sm text-red-700">{{errors.type}}</p>
            </div>
          </label>
          <label for="Description">
            <span>Description</span>
            <textarea
              name="description" id="description" placeholder="Description" cols="30" 
              rows="5" class="block w-full rounded px-3 py-2 border border-sky-600"
              v-model="transaction.description" />
            <div v-if="errors.type">
              <p class="text-sm text-red-700">{{errors.description}}</p>
            </div>
          </label>
          <div class="flex justify-end items-center">
            <div class="flex justify-center items-center gap-2 p-2">
              <!-- <button type="reset" class="block rounded p-3 font-semibold text-lg bg-gray-200 text-black hover:bg-gray-100 hover:cursor-pointer" @click="clearFields()">Clear Fields</button> -->
              <button :disabled="submitted" type="submit" class="block rounded p-3 font-semibold text-lg bg-sky-600 text-white hover:bg-sky-500 hover:cursor-pointer">Update Transaction</button>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
import AdminLayout from '../../../Layouts/Admin.vue'
import Breadcrumb from '../../../Components/Breadcrumb.vue'


export default {
  layout: AdminLayout,

  props: {
    transaction: Object,
    errors: Object,
  },

  components: {
    Breadcrumb,
  },

  data() {
    return {
      submitted: false,
    }
  },

  methods: {
    handleSubmit() {
      this.submitted = true
      this.$inertia.put(`/transactions/${this.transaction.id}`, this.transaction, {
        onError: () => {
          this.showToast('Error updating transaction', 'error')
        },
        onSuccess: () => {
          this.showToast('Successfully updated transaction', 'success')
        }
      })
      this.submitted = false
    },

    // clearFields() {
    //   this.transaction = {
    //     type: '',
    //     description: '',
    //   }
    // }
  }
}
</script>

<style>

</style>
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
        label: 'Create',
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
        <div class="w-full flex flex-col gap-3 p-2">
          <label for="name">
            <span>Window Name</span>
            <input 
              type="text" name="name" id="name" placeholder="Window Name" 
              class="block w-full rounded px-3 py-2 border"
              :class="v$.window.name.$error ? 'border-red-500' : 'border-sky-600'"
              v-model="window.name">
            <div v-if="v$.window.name.$error">
              <p class="text-md text-red-700">{{v$.window.name.$errors[0].$message}}</p>
            </div>
          </label>
          <label for="transaction">
            <span>Window For</span>
            <select 
              name="transaction" id="transaction" 
              class="block w-full bg-white px-3 p-2 rounded border"
              :class="v$.window.transaction_id.$error ? 'border-red-500' : 'border-sky-600'"
              v-model="window.transaction_id">
              <option :value="null" disabled>Select Transaction Type</option>
              <template v-for="(transaction, i) in transactions" :key="i">
                <option :value="transaction.id">{{transaction.type}}</option>
              </template>
            </select>
            <div v-if="v$.window.transaction_id.$error">
              <p class="text-md text-red-700">{{v$.window.transaction_id.$errors[0].$message}}</p>
            </div>
          </label>
          <label for="Description">
            <span>Description</span>
            <textarea 
              name="description" id="description" placeholder="Description" 
              cols="30" rows="5" class="block w-full rounded px-3 py-2 border"
              :class="v$.window.description.$error ? 'border-red-500' : 'border-sky-600'"
              v-model="window.description"/>
            <div v-if="v$.window.description.$error">
              <p class="text-md text-red-700">{{v$.window.description.$errors[0].$message}}</p>
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
              <button type="reset" class="block rounded p-3 font-semibold text-lg bg-gray-200 text-black hover:bg-gray-100 hover:cursor-pointer">Clear Fields</button>
              <button type="submit" :disabled="submitted" class="block rounded p-3 font-semibold text-lg bg-sky-600 text-white hover:bg-sky-500 hover:cursor-pointer">Add Window</button>
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
import useVuelidate from '@vuelidate/core'
import { required, minLength, numeric, minValue } from '@vuelidate/validators'

export default {
  layout: AdminLayout,

  components: {
    Breadcrumb,
  },

  data() {
    return {
      v$: useVuelidate(),
      window: {
        name: '',
        transaction_id: null,
        description: '',
        is_occupied: false,
        is_active: true,
      },
      submitted: false,
    }
  },

  validations() {
    return {
      window: {
        name: {
          required,
          minLength: minLength(3),
        },
        transaction_id: {
          required,
          numeric,
          minValue: minValue(1),
        },
        description: {
          required,
          minLength: minLength(5),
        },
      }
    }
  },

  methods: {
    handleSubmit() {
      this.submitted = true
      this.v$.$validate()
      if(!this.v$.$error) {
        this.$inertia.post('/windows', this.window, {
          onError: (errors) => {
             for(const error in errors) {
              this.showToast(`${errors[error]}`, 'error')  
            }
            this.showToast('Error creating window', 'error')
          },
          onSuccess: () => {
            this.showToast('Succesfully created window', 'success')
          }
        })
      }
      this.submitted = false
    },

    clearFields() {
      this.window = {
        name: '',
        transaction_id: null,
        description: '',
        is_active: false,
      }
    }
  }
}
</script>

<style>

</style>
<template>
  <Head>
    <title>Transactions</title>
  </Head>
  <div class="mx-5">
    <Breadcrumb :links="[
      {
        label: 'Services',
        to: '/services',
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
          <p class="text-xl font-semibold">Service Information</p>
          <hr>
        </div>
        <div class="mt-2 w-full flex flex-col gap-3 p-2">
          <label for="type">
            <span>Service Type</span>
            <input 
              type="text" name="type" id="type" placeholder="Service Type" 
              class="block w-full rounded px-3 py-2 border"
              :class="v$.service.type.$error ? 'border-red-500' : 'border-sky-600'"
              v-model="service.type">
            <div v-if="v$.service.type.$error">
              <p class="text-md text-red-500" v-text="v$.service.type.$errors[0].$message" />
            </div>
          </label>
          <label for="Description">
            <span>Description</span>
            <textarea
              name="description" id="description" placeholder="Description" cols="30" 
              rows="5" class="block w-full rounded px-3 py-2 border border-sky-600"
              :class="v$.service.description.$error ? 'border-red-500' : 'border-sky-600'"
              v-model="service.description" />
            <div v-if="v$.service.description.$error">
              <p class="text-md text-red-500" v-text="v$.service.description.$errors[0].$message" />
            </div>
          </label>
          <div class="flex justify-end items-center">
            <div class="flex justify-center items-center gap-2 p-2">
              <!-- <button type="reset" class="block rounded p-3 font-semibold text-lg bg-gray-200 text-black hover:bg-gray-100 hover:cursor-pointer" @click="clearFields()">Clear Fields</button> -->
              <button :disabled="submitted" type="submit" class="block rounded p-3 font-semibold text-lg bg-sky-600 text-white hover:bg-sky-500 hover:cursor-pointer">Update Service</button>
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
import useVuelidate from '@vuelidate/core'
import { required, minLength } from '@vuelidate/validators'


export default {
  layout: AdminLayout,

  props: {
    transaction: Object,
  },

  components: {
    Breadcrumb,
  },

  data() {
    return {
      v$: useVuelidate(),
      submitted: false,
    }
  },

  validations() {
    return {
      service: {
        type: {
          required,
          minLength: minLength(3),
        },
        description: {
          required,
          minLength: minLength(5),
        }
      }
    }
  },

  methods: {
    handleSubmit() {
      this.submitted = true
      this.v$.$validate()
      if(!this.v$.error) {
        this.$inertia.put(`/transactions/${this.transaction.id}`, this.transaction, {
          onError: (errors) => {
            for(const error in errors) {
              this.showToast(`${errors[error]}`, 'error')  
            }
            this.showToast('Error updating service', 'error')
          },
          onSuccess: () => {
            this.showToast('Successfully updated service', 'success')
          }
        })
      }
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
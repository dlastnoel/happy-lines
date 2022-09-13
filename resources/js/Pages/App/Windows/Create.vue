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
    {{services}}
    <br>
    <br>
    {{users}}
    <br>
    <br>
    {{window}}
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
          <!-- <label for="transaction">
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
          </label> -->
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
          <div>
            <span>Window Staff</span>
            <div 
              class="p-2 flex justify-start items-center gap-3 border"
              :class="v$.window.user_id.$error ? 'border-red-500' : 'border-sky-600'">
              <button 
                v-for="(staff, i) in users" :key="i"
                class="p-2 rounded transition duration-75"
                :class="staff.selected ? 
                'text-white bg-green-500 hover:brightness-110' : 'text-black bg-gray-300 hover:brightness-95'"
                @click.prevent="selectStaff(staff)">
                {{staff.fullname}}
              </button>
            </div>
            <div v-if="v$.window.user_id.$error">
              <p class="text-md text-red-700">{{v$.window.user_id.$errors[0].$message}}</p>
            </div>
          </div>
          <div>
            <span>Window Services</span>
            <div
              class="p-2 flex justify-start items-center gap-3 border"
              :class="v$.window.services.$error ? 'border-red-500' : 'border-sky-600'">
              <button 
                v-for="(service, i) in services" :key="i"
                class="p-2 rounded transition duration-75"
                :class="service.selected ? 
                'text-white bg-green-500 hover:brightness-110' : 'text-black bg-gray-300 hover:brightness-95'"
                @click.prevent="selectService(service)">
                {{service.type}}
              </button>
            </div>
            <div v-if="v$.window.services.$error">
              <p class="text-md text-red-700">{{v$.window.services.$errors[0].$message}}</p>
            </div>
          </div>
          
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
import { required, minLength, numeric } from '@vuelidate/validators'

export default {
  layout: AdminLayout,

  props: {
    users: Object,
    services: Object,
  },

  components: {
    Breadcrumb,
  },

  data() {
    return {
      v$: useVuelidate(),
      window: {
        name: 'Window 1',
        description: 'Window 1',
        is_active: true,
        user_id: '',
        services: [],
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
        description: {
          required,
          minLength: minLength(5),
        },
        user_id: { required, numeric },
        services: { required, },
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

    selectStaff(staff) {
      // loop through users object
       for(const user in this.users) {

        // check if current user in object matches param
        if(this.users[user] === staff) {
          // set current user with the other value of the param
          this.users[user].selected = !staff.selected
          
          // checks if the current user is now selected
          if(this.users[user].selected) {
            // sets window user to the value of the current user selected
            this.window.user_id = this.users[user].id
          } else {
            // if not clear the window user value
            this.window.user_id = ''
          }
        } else {
          // deselect the current user
           this.users[user].selected = false
        }
       }
    },

    selectService(serviceItem) {
      // loop through the services object
      for(const service in this.services) {

        // check if current service in object matches param
        if(this.services[service] === serviceItem) {
          // set current service with the other value of the param
          this.services[service].selected = !serviceItem.selected

          // checks if the current service is now selected
          if(this.services[service].selected) {
            // add service to window services
            this.window.services.push(this.services[service].id)
          } else {
            // remove current service from window services
            this.window.services = this.window.services.filter(function(value) {
              return value != serviceItem.id
            })
          }
        }
       }
    },

    clearFields() {
      this.window = {
        name: '',
        description: '',
        is_active: true,
        user_id: '',
        services: [],
      }
    }
  }
}
</script>

<style>

</style>








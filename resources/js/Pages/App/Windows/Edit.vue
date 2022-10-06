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

          <!-- window name -->
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
          <label for="Description">
            <span>Description</span>
            <textarea 
              name="description" id="description" placeholder="Description" 
              cols="30" rows="5" class="block w-full rounded px-3 py-2 border border-sky-600"
               :class="v$.window.description.$error ? 'border-red-500' : 'border-sky-600'"
              v-model="window.description"/>
            <div v-if="v$.window.description.$error">
              <p class="text-md text-red-700">{{v$.window.description.$errors[0].$message}}</p>
            </div>
          </label>

          <div>
            <div 
              class="p-2 border rounded"
              :class="v$.window.user_id.$error ? 'border-red-500' : 'border-sky-600'">
              <!-- staff -->
              <template v-if="staffCount > 0">
                <span>Window Staff</span>
                <div class="flex justify-start items-center gap-3">
                  <template v-for="(staff, i) in users" :key="i">
                    <template v-if="staff.role === 'staff' || staff.role === 'admin'">
                      <button 
                        class="p-2 rounded transition duration-75"
                        :class="staff.selected ? 
                        'text-white bg-green-500 hover:brightness-110' : 'text-black bg-gray-300 hover:brightness-95'"
                        @click.prevent="selectStaff(staff)">
                        {{staff.fullname}}
                      </button>
                    </template>
                  </template>
                </div>
              </template>

              <!-- doctor -->
              <template v-if="doctorCount > 0">
                <span class="block mt-3">Window Doctor</span>
                <div class="flex justify-start items-center gap-3">
                  <template v-for="(staff, i) in users" :key="i">
                    <template v-if="staff.role === 'doctor'">
                      <button 
                        class="p-2 rounded transition duration-75"
                        :class="staff.selected ? 
                        'text-white bg-green-500 hover:brightness-110' : 'text-black bg-gray-300 hover:brightness-95'"
                        @click.prevent="selectStaff(staff)">
                        {{staff.fullname}}
                      </button>
                    </template>
                  </template>
                </div>
              </template>
            </div>
            <div>
              <div v-if="v$.window.user_id.$error">
                <p class="text-md text-red-700">{{v$.window.user_id.$errors[0].$message}}</p>
              </div>
            </div>
          </div>

          <!-- services -->
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

          <!--  -->
          <div class="flex justify-between items-start">
          <!-- status/set as active -->
            <label for="status">
              <input
                type="checkbox" name="status" id="status" 
                class="border-sky-600" v-model="window.is_active">
              <span class="ml-1">Set as Active</span>
            </label>
            <!-- action buttons -->
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
import useVuelidate from '@vuelidate/core';
import { required, minLength, numeric, minValue } from '@vuelidate/validators'

export default {
  layout: AdminLayout,

  components: {
    Breadcrumb,
  },

  props: {
    user: Object,
    users: Object,
    services: Object,
    window: Object,
  },

  computed: {
    staffCount() {
      let x=0
      for(const user in this.users) {
        if(this.users[user].role === 'staff' || this.users[user].role === 'admin') {
          x++
          }
      }
      return x
    },

    doctorCount() {
      let y=0
      for(const user in this.users) {
        if(this.users[user].role === 'doctor') {
          y++
          }
      }
      return y
    }
  },

  data() {
    return {
      v$: useVuelidate(),
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
        this.$inertia.put(`/windows/${this.window.id}`, this.window, {
          onError: (errors) => {
            for(const error in errors) {
              this.showToast(`${errors[error]}`, 'error')
            }
            this.showToast('Error updated window', 'error')
          },
          onSuccess: () => {
            this.showToast('Succesfully updated window', 'success')
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

            // check if user id doctor
            if(this.users[user].role === 'doctor') {
              // apply doctor to window
              this.window.has_doctor = true
            } else {
              // remove doctor from window
              this.window.has_doctor = false;
            }
          } else {
            // if not clear the window user value
            this.window.user_id = ''
          }
        } else {
          // deselect the current user
           this.users[user].selected = false
          // remove doctor from window
          this.window.has_doctor = false;
        }
       }
    },

    selectService(serviceItem) {
      // loop through the services object
      for(const service in this.services) {

        // check if current service in object matches param
        if(this.services[service] === serviceItem) {
          // set current user with the other value of the param
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
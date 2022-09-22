<template :auth="auth" :window="window">
  <Head>
    <title>Staffs</title>
  </Head>
  <div class="mx-5">
    <Breadcrumb :links="[
      {
        label: 'Staffs',
        to: '/staffs',
      },
      {
        label: 'Register',
        to: '#',
      }
    ]" />
  </div>

  <div class="m-5 p-3 shadow rounded bg-white">
    <form @submit.prevent="handleSubmit()">
      <!-- personal information -->
      <div>
        <div class="my-2">
          <p class="text-xl font-semibold">Personal Information</p>
          <hr>
        </div>
        <div class="w-full grid grid-cols-2 gap-3 p-2">
          <label for="firstname">
            <span>First Name</span>
            <input
              type="text" name="firstname" id="firstname" placeholder="First Name"
              class="block w-full rounded px-3 py-2 border"
              :class="v$.staff.firstname.$error ? 'border-red-500' : 'border-sky-600'"
              v-model="staff.firstname">
            <div v-if="v$.staff.firstname.$error">
              <p class="text-md text-red-700">{{v$.staff.firstname.$errors[0].$message}}</p>
            </div>
          </label>
          <label for="lastname">
          <span>Last Name</span>
            <input
              type="text" name="lastname" id="lastname" placeholder="Last Name"
              class="block w-full rounded px-3 py-2 border border-sky"
              :class="v$.staff.lastname.$error ? 'border-red-500' : 'border-sky-600'"
              v-model="staff.lastname">
            <div v-if="v$.staff.lastname.$error">
              <p class="text-md text-red-700">{{v$.staff.lastname.$errors[0].$message}}</p>
            </div>
          </label>
        </div>
        <div class="w-full grid grid-cols-2 gap-3 p-2">
          <label for="contact_no">
            <span>Contact Number</span>
            <input
              type="text" name="contact_no" id="contact_no" placeholder="Contact Number"
              class="block w-full rounded px-3 py-2 border" maxlength="11"
              :class="v$.staff.contact_no.$error ? 'border-red-500' : 'border-sky-600'"
              v-model="staff.contact_no">
            <div v-if="v$.staff.contact_no.$error">
              <p class="text-md text-red-700">{{v$.staff.contact_no.$errors[0].$message}}</p>
            </div>
          </label>
          <label for="Email Address">
            <span>Email Address</span>
            <input
              type="email" name="email" id="email" placeholder="Email Address"
              class="block w-full rounded px-3 py-2 border"
              :class="v$.staff.email.$error ? 'border-red-500' : 'border-sky-600'"
              v-model="staff.email">
            <div v-if="v$.staff.email.$error">
              <p class="text-md text-red-700">{{v$.staff.email.$errors[0].$message}}</p>
            </div>
          </label>
        </div>
      </div>
      <!--  -->

      <!-- login credentials -->
      <div>
        <div class="my-2">
          <p class="text-xl font-semibold">Account</p>
          <hr>
        </div>
        <div class="mt-2 w-full grid grid-cols-2 gap-3 p-2">
          <label for="username">
            <span>Username</span>
            <input
              type="text" name="username" id="username" placeholder="Username"
              class="block w-full rounded px-3 py-2 border"
              :class="v$.staff.username.$error ? 'border-red-500' : 'border-sky-600'"
              v-model="staff.username">
            <div v-if="v$.staff.username.$error">
              <p class="text-md text-red-700">{{v$.staff.username.$errors[0].$message}}</p>
            </div>
          </label>
          <label for="status">
            <span>Account Status</span>
            <select 
              name="status" id="status" class="block w-full bg-white px-3 p-2 rounded border border-sky-700">
              <option value="active">Active</option>
              <option value="deactivated">Deactivated</option>
            </select>
          </label>
        </div>
        <div class="w-full grid grid-cols-2 gap-3 p-2">
          <label for="password">
            <span>Password</span>
              <div class="relative">
              <input
                :type="isPasswordVisible ? 'text' : 'password'" name="password" id="password" placeholder="Password"
                class="block w-full rounded px-3 py-2 border"
                :class="v$.staff.password.$error ? 'border-red-500' : 'borders-sky-600'"
                v-model="staff.password">
                <span 
                  class="absolute right-2 top-3 rounded hover:bg-gray-100 hover:cursor-pointer"
                  @click="isPasswordVisible = !isPasswordVisible">
                  <template v-if="isPasswordVisible">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                      <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                  </template>
                  <template v-else>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                    </svg>
                  </template>
                </span>
              </div>
            <div v-if="v$.staff.password.$error">
              <p class="text-md text-red-700">{{v$.staff.password.$errors[0].$message}}</p>
            </div>
          </label>
          <label for="password_confirmation">
            <span>Confirm Password</span>
            <div class="relative">
              <input
                :type="isPasswordVisible ? 'text' : 'password'" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password"
                class="block w-full rounded px-3 py-2 border"
                :class="v$.staff.password_confirmation.$error ? 'border-red-500' : 'borders-sky-600'"
                v-model="staff.password_confirmation">
                <span 
                  class="absolute right-2 top-3 rounded hover:bg-gray-100 hover:cursor-pointer"
                  @click="isPasswordVisible = !isPasswordVisible">
                  <template v-if="isPasswordVisible">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                      <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                  </template>
                  <template v-else>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                    </svg>
                  </template>
                </span>
            </div>
            <div v-if="v$.staff.password_confirmation.$error">
              <p class="text-md text-red-700">{{v$.staff.password_confirmation.$errors[0].$message}}</p>
            </div>
          </label>
        </div>
        <!--  -->

        <!-- action buttons -->
        <div class="w-full flex justify-end items-center gap-2 p-2">
          <button @click.prevent="clearFields()" type="reset" class="block rounded p-3 font-semibold text-lg bg-gray-200 text-black hover:bg-gray-100 hover:cursor-pointer" >Clear Fields</button>
          <button type="submit" :disabled="submitted" class="block rounded p-3 font-semibold text-lg bg-sky-600 text-white hover:bg-sky-500 hover:cursor-pointer">Add Staff</button>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
import AdminLayout from '@/Layouts/Admin.vue'
import Breadcrumb from '@/Components/Breadcrumb.vue'
import useVuelidate from '@vuelidate/core'
import { required, minLength, email, alphaNum, numeric, sameAs, maxLength } from '@vuelidate/validators'

export default {
  layout: AdminLayout,

  components: {
    Breadcrumb,
  },

  props: {
    auth: Object,
    window: {
      type: Object,
      required: false,
      default: {
        id: '',
        name: '',        
      }
    },
    errors: Object,
  },

  data() {
    return {
      v$: useVuelidate(),
      staff: {
        firstname: 'Reinard Sam',
        lastname: 'Boado',
        contact_no: '09987654322',
        email: 'reinardsam@happylines.com',
        username: 'reinardsam',
        role: 'staff',  
        status: 'active',
        password: 'ilovehappypatient',
        password_confirmation: 'ilovehappypatient',
      },
      submitted: false,
      isPasswordVisible: false,
    }
  },

  validations() {
    return {
      staff: {
        firstname: { required },
        lastname: {required },
        contact_no: {
          required,
          numeric,
          minLength: minLength(11),
          maxLength: maxLength(11),
        },
        email: {
          required,
          email,
        },
        username: {
          required,
          alphaNum,
          minLength: minLength(3),
        },
        password: {
          required,
          minLength: minLength(8),
        },
        password_confirmation: {
          required,
          minLength: minLength(8),
          sameAs: sameAs(this.staff.password),
        }
      },
    }
  },

  methods: {
    handleSubmit() {
      this.submitted = true
      this.v$.$validate()
      if(!this.v$.$error) {
        this.$inertia.post('/staffs', this.staff, {
          onError: (errors) => {
            for(const error in errors) {
              this.showToast(`${errors[error]}`, 'error')  
            }
            this.showToast('Error registering staff', 'error')
          },
          onSuccess: () => {
            this.showToast('Successfully registered staff', 'success')
          }
        })
      }
      this.submitted = false
    },

    clearFields() {
      this.staff =  {
        firstname: '',
        lastname: '',
        contact_no: '',
        email: '',
        status: 'active',
        username: '',
        role: 'staff',        
        password: 'st@ffpw2k22',
      }
    }
  }
}
</script>

<style>

</style>
<template>
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
              class="block w-full rounded px-3 py-2 border border-sky-600"
              v-model="staff.firstname">
            <div v-if="errors.firstname">
              <p class="text-sm text-red-700">{{errors.firstname}}</p>
            </div>
          </label>
          <label for="lastname">
          <span>Last Name</span>
            <input
              type="text" name="lastname" id="lastname" placeholder="Last Name"
              class="block w-full rounded px-3 py-2 border border-sky-600"
              v-model="staff.lastname">
            <div v-if="errors.lastname">
              <p class="text-sm text-red-700">{{errors.lastname}}</p>
            </div>
          </label>
        </div>
        <div class="w-full grid grid-cols-2 gap-3 p-2">
          <label for="contact_no">
            <span>Contact Number</span>
            <input
              type="number" name="contact_no" id="contact_no" placeholder="Contact Number"
              class="block w-full rounded px-3 py-2 border border-sky-600" maxlength="11"
              v-model="staff.contact_no">
            <div v-if="errors.contact_no">
              <p class="text-sm text-red-700">{{errors.contact_no}}</p>
            </div>
          </label>
          <label for="Email Address">
            <span>Email Address</span>
            <input
              type="email" name="email" id="email" placeholder="Email Address"
              class="block w-full rounded px-3 py-2 border border-sky-600"
              v-model="staff.email">
            <div v-if="errors.email">
              <p class="text-sm text-red-700">{{errors.email}}</p>
            </div>
          </label>
        </div>
      </div>
      <!--  -->

      <!-- login credentials -->
      <div>
        <div class="my-2">
          <p class="text-xl font-semibold">Login Credentials</p>
          <hr>
        </div>
        <div class="mt-2 w-full grid grid-cols-2 gap-3 p-2">
          <label for="status">
            <span>Account Status</span>
            <select 
              name="status" id="status" class="block w-full bg-white px-3 p-2 rounded border border-sky-600"
              v-model="staff.status">
              <option value="active">Active</option>
              <option value="deactivated">Deactivated</option>
            </select>
            <div v-if="errors.status">
              <p class="text-sm text-red-700">{{errors.status}}</p>
            </div>
          </label>
        </div>
        <div class="w-full grid grid-cols-2 gap-3 p-2">
          <label for="username">
            <span>Username</span>
            <input
              type="text" name="username" id="username" placeholder="Username"
              class="block w-full rounded px-3 py-2 border border-sky-600"
              v-model="staff.username">
            <div v-if="errors.username">
              <p class="text-sm text-red-700">{{errors.username}}</p>
            </div>
          </label>
          <label for="password">
            <span>Password</span>
            <input
              type="password" name="password" id="password" placeholder="Password"
              class="block w-full rounded px-3 py-2 border border-sky-600"
              v-model="staff.password">
            <div v-if="errors.password">
              <p class="text-sm text-red-700">{{errors.password}}</p>
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

export default {
  layout: AdminLayout,

  components: {
    Breadcrumb,
  },

  props: {
    errors: Object,
  },

  data() {
    return {
      staff: {
        firstname: '',
        lastname: '',
        contact_no: '',
        email: '',
        status: 'active',
        username: '',
        role: 'staff',  
        password: 'st@ffpw2k22',
      },
      submitted: false,
    }
  },

  methods: {
    handleSubmit() {
      this.submitted = true
      this.$inertia.post('/staffs', this.staff, {
        onError: () => {
          this.showToast('Error registering staff', 'error')
        },
        onSuccess: () => {
          this.showToast('Successfully registered staff', 'success')
        }
      })
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
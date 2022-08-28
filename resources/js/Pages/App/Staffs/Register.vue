<template>
  <div>
    <div class="m-5 p-3 shadow rounded bg-white">
      <form action="">
        <!-- personal information -->
        <div>
          <div class="my-2">
            <p class="text-xl font-semibold">Personal Information</p>
            <hr>
          </div>
          <div class="mt-2 w-full grid grid-cols-2 gap-3 p-2">
            <label for="firstname">
              <span>First Name</span>
              <input type="text" name="firstname" id="firstname" placeholder="First Name" class="block w-full rounded px-3 py-2 border-[1px] border-sky-600">
            </label>
            <label for="lastname">
              <span>Last Name</span>
              <input type="text" name="lastname" id="lastname" placeholder="Last Name" class="block w-full rounded px-3 py-2 border-[1px] border-sky-600">
            </label>
          </div>
          <div class="mt- w-full grid grid-cols-2 gap-3 p-2">
            <label for="contact_no">
              <span>Contact Number</span>
              <input type="number" name="contact_no" id="contact_no" placeholder="Contact Number" class="block w-full rounded px-3 py-2 border-[1px] border-sky-600">
            </label>
          </div>
        </div>
        <!--  -->

        <!-- professional information -->
        <div>
          <div class="my-2">
            <p class="text-xl font-semibold">Professional Infomration</p>
            <hr>
          </div>
          <div class="mt-2 w-full grid grid-cols-2 gap-3 p-2">
            <label for="department">
              <span>Department</span>
              <input type="text" name="department" id="department" placeholder="Department" class="block w-full rounded px-3 py-2 border-[1px] border-sky-600">
            </label>
            <label for="specialization">
              <span>Specialization</span>
              <input type="text" name="specialization" id="specialization" placeholder="Specialization" class="block w-full rounded px-3 py-2 border-[1px] border-sky-600">
            </label>
          </div>
          <div class="mt- w-full grid grid-cols-2 gap-3 p-2">
            <label for="license_no">
              <span>License Number</span>
              <input type="number" name="license_no" id="license_no" placeholder="License Number" class="block w-full rounded px-3 py-2 border-[1px] border-sky-600">
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
          <div class="mt- w-full grid grid-cols-2 gap-3 p-2">
            <label for="username">
              <span>Username</span>
              <input type="text" name="username" id="username" placeholder="Username" class="block w-full rounded px-3 py-2 border-[1px] border-sky-600">
            </label>
          </div>
          <div class="mt-2 w-full grid grid-cols-2 gap-3 p-2">
            <label for="password">
              <span>Password</span>
              <input type="password" name="password" id="password" placeholder="Password" class="block w-full rounded px-3 py-2 border-[1px] border-sky-600">
            </label>
            <label for="specialization">
              <span>Confirm Password</span>
              <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" class="block w-full rounded px-3 py-2 border-[1px] border-sky-600">
            </label>
          </div>
          <!--  -->

          <!-- action buttons -->
          <div class="mt-2 w-full flex justify-end items-center gap-2 p-2">
            <button type="reset" class="block rounded p-3 font-semibold text-lg bg-gray-200 text-black hover:bg-gray-100 hover:cursor-pointer">Clear Fields</button>
            <button type="submit" class="block rounded p-3 font-semibold text-lg bg-sky-600 text-white hover:bg-sky-500 hover:cursor-pointer">Add User</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import AdminLayout from '../../../Layouts/Admin.vue'

export default {
  layout: AdminLayout
}
</script>

<style>

</style>
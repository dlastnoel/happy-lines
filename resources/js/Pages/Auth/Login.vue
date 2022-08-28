<template>
  <div class="h-screen grid place-content-center gap-5 bg-sky-600">
    <div class="h-[85vh] w-[90vw] grid lg:grid-cols-2 rounded-lg shadow-lg bg-white ">
      <div class="p-5 hidden lg:grid place-content-center ">
        <Vue3Lottie :animationData="doctorLottie" class="h-full w-full" />
      </div>
      <div class="h-full grid place-content-center gap-5">
        <h1 class="text-6xl text-center">Happy Lines</h1>
        <form action="" class="mt-4">
          <div>
            <label for="username">
              <span class="text-md">Username</span>
              <input type="text" class="block rounded p-3 mt-1 w-[350px] border-2 border-sky-600" name="username" id="username" placeholder="Username">
            </label>
          </div>
          <div class="mt-3">
            <label for="password">
              <span class="text-md">Password</span>
              <input type="password" class="block rounded p-3 mt-1 w-[350px] border-2 border-sky-600" name="password" id="password" placeholder="Password">
          </label>
          <div class="mt-5">
            <input type="submit" class="block rounded p-3 w-[350px] font-semibold text-lg bg-sky-600 text-white" value="Login">
          </div>
          </div>
        </form>
      </div>
    </div>
    <div>
      <div class="flex justify-between items-center flex-col md:flex-row">
        <h6 class="font-semibold text-white">Copyright &copy; 2022 Happy Lines</h6>
        <h6 class="font-semibold text-white">Happy Patient Queuing Management System</h6>
      </div>
    </div>
  </div>
</template>

<script>
import { Vue3Lottie } from 'vue3-lottie'
import 'vue3-lottie/dist/style.css'
import doctorLottie from '../../../json/doctor.json'

export default {
    components: {
      Vue3Lottie
    },
    data() {
      return {
        doctorLottie
      }
    }
  }
</script>

<style>

</style>
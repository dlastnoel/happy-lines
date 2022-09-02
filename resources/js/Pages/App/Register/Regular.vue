<template>
  <Head>
    <title>Registration</title>
  </Head>
  <div class="h-screen grid place-content-center gap-5 bg-sky-600">
    <div class="h-[85vh] w-[90vw] grid md:grid-cols-2 rounded-lg shadow-lg bg-white ">
      <div class="p-5 hidden md:grid place-content-center ">
        <Vue3Lottie :animationData="doctorLottie" class="h-full w-full" />
      </div>
      <div class="h-full flex flex-col justify-center items-center gap-3">
        <div class="md:hidden w-1/2 grid  place-content-center">
          <Vue3Lottie :animationData="doctorLottie"/>
        </div>
        <h1 class="text-6xl text-center">Welcome!</h1>
        <h3 class="text-4xl text-center">Register Here (Regular)</h3>
        <form action="" class="mt-4">
          <div>
            <label for="fullname">
              <span class="text-md">Full Name</span>
              <input type="text" class="block rounded p-3 mt-1 w-[400px] md:w-[350px] lg:w-[400px] border-2 border-sky-600" name="fullname" id="fullname" placeholder="Full Name">
            </label>
          </div>
           
          <div class="mt-5">
            <input type="submit" class="block rounded p-3 w-[400px] md:w-[350px] lg:w-[400px] font-semibold text-lg bg-sky-600 text-white" value="Register">
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
import doctorLottie from '../../../../json/doctor.json'

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
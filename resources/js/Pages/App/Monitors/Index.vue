<template>
  <Head>
    <title>Login</title>
  </Head>
  <div class="h-screen grid place-content-center gap-5 bg-sky-600">

    <div class="h-[85vh] w-[90vw] grid md:grid-cols-2 rounded-lg shadow-lg bg-white ">

      <div class="p-5 hidden md:grid place-content-center w-full ">
        <Vue3Lottie :animationData="doctorLottie" class="h-full w-full" />
      </div>
      <!--  -->
      <div class="h-full w-full flex flex-col justify-center items-center gap-5">
        <div class="md:hidden w-1/2 grid  place-content-center">
          <Vue3Lottie :animationData="doctorLottie"/>
        </div>
        <div class="h-full w-full flex flex-col justify-center items-center">
          <div class="h-[90%] w-full flex justify-center items-center">
            <div class="grid place-content-center gap-3">
              <h1 class="text-6xl text-center">Welcome to Happy Lines!</h1>
              <h3 class="text-4xl text-center">Select Window</h3>
              <div class="flex justify-center items-center gap-2">
                <template v-for="(window, i) in windows" :key="i">
                  <Link 
                    class="p-2 rounded shadow text-lg text-white bg-sky-600 transition duration-75 hover:bg-sky-500"
                    :href="`/monitors/window/${window.id}`"> 
                    {{window.name}}
                  </Link>
                </template>
              </div>
            </div>
          </div>
          <!--  -->
          <div class="w-full h-[10%] flex justify-end items-end gap-2 p-2">
            <Link href="/login" class="block rounded p-2 shadow text-sm bg-sky-600 text-white hover:bg-sky-500 hover:cursor-pointer">
              Back to Login
            </Link>
          </div>
        </div>
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
import doctorLottie from '@/../json/doctor.json'

export default {
  components: {
    Vue3Lottie
  },

  props: {
    windows: Object,
  },

  data() {
    return {
      doctorLottie,
    }
  },
}
</script>

<style>

</style>
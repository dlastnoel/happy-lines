<template>
  <Head>
    <title>Serving</title>
  </Head>
  <div class="h-screen grid place-content-center gap-5 bg-sky-600">
    <div class="h-[85vh] w-[90vw] grid md:grid-cols-2 rounded-lg shadow-lg bg-white ">
      <div class="p-5">
        <h3 class="text-6xl text-center">On Queue</h3>
        <div class="grid grid-cols-2 h-full w-full">
          <div class="flex flex-col justify-start items-center">
            <h3 class="text-6xl">Priority</h3>
            <ul>
              <li class="text-6xl font-bold">1</li>
              <li class="text-6xl font-bold">2</li>
              <li class="text-6xl font-bold">3</li>
              <li class="text-6xl font-bold">4</li>
              <li class="text-6xl font-bold">5</li>
            </ul>
          </div>
          <div class="flex flex-col justify-start items-center">
            <h3 class="text-4xl">Regular</h3>
            <ul>
              <li class="text-6xl font-bold">1</li>
              <li class="text-6xl font-bold">2</li>
              <li class="text-6xl font-bold">3</li>
              <li class="text-6xl font-bold">4</li>
              <li class="text-6xl font-bold">5</li>
            </ul>
          </div>
        </div>
      </div>
      <div class="h-full w-full flex flex-col justify-center items-center gap-5">
        <div class="hidden w-1/2 md:grid  place-content-center">
          <Vue3Lottie :animationData="doctorLottie"/>
        </div>
        <h3 class="text-4xl text-center">Happy Lines</h3>
        <h1 class="text-8xl">Now Serving</h1>
        <hr class="border-2 border-sky-600 w-[80%]">
        <div>
          <p class="text-9xl text-center font-semibo">P-25</p>
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
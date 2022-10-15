<template>
  <Head>
    <title>Serving</title>
  </Head>
  <div class="h-screen grid place-content-center gap-5 bg-sky-600">
    <div class="h-[85vh] w-[90vw] grid md:grid-cols-2 rounded-lg shadow-lg bg-white ">
      <div class="p-5">
        <h3 class="text-6xl text-center">On Queue</h3>
        <div class="h-full w-full">
          <template v-if="patients.length">
            <ul>
              <li class="text-3xl" v-for="(patient, i) in patients" :key="i">
                {{`(${patient.number}) ${patient.fullname}`}}
              </li>
            </ul>
          </template>
          <template v-else>
            <p class="text-4xl text-center">No patients at the moment</p>
          </template>
        </div>
      </div>
      <div class="h-full w-full flex flex-col justify-center items-center gap-5">
        <div class="hidden w-1/2 md:grid  place-content-center">
          <Vue3Lottie :animationData="doctorLottie"/>
        </div>
        <h3 class="text-4xl text-center">Happy Lines</h3>
        <h1 class="text-8xl">Now Serving</h1>
        <hr class="border-2 border-sky-600 w-[80%]">
        <div 
          v-if="serving_patient != 0"
          class="mt-3 p-5 grid place-content-center ">
          <p class="text-7xl text-center ">{{serving_patient.number}}</p>
          <p class="text-5xl text-center ">{{serving_patient.fullname}}</p>
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
    props: {
      window: {
          type: Object,
          required: true,
          default: {
              id: '',
              name: '',
          },
      },
      patients: Object,
      serving_patient: {
        type: Object,
        required: true,
        default: String,
      },
    },

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
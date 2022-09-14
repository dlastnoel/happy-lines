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
        <div class="h-full w-full flex flex-col justify-center items-center">
          <div class="h-[90%] w-full flex justify-center items-center">
            <div>
              <h1 class="text-6xl text-center" v-text="window.name" />
              <h3 class="text-4xl text-center">Register Here</h3>
              <!-- {{patient}} -->
              <form class="mt-4 grid grid-cols-2 gap-3" @submit.prevent="handleSubmit()">
                <!-- unique_id -->
                <div class="mt-3">
                  <label for="unique_id">
                    <div class="flex justify-start items-center gap-2">
                      <span class="text-md">ID</span>
                      <button
                        type="submit" :disabled="!hasId"
                        class="rounded p-1 text-xs  text-white "
                        :class="!hasId ? 'bg-gray-300' : 'bg-sky-600 hover:bg-sky-500 hover:cursor-pointer'">
                      	&#x2713;
                      </button>
                    </div>
                    <input
                      type="text" name="id" id="id" placeholder="ID"
                      class="block rounded p-2 mt-1 border-2 border-sky-600"
                      v-model="patient.unique_id" @keyup="validateId()">
                  </label>
                </div>

                <!-- fullname -->
                <div class="mt-3">
                  <label for="fullname">
                    <span class="text-md">Full Name</span>
                    <input 
                      type="text" name="fullname" id="fullname" placeholder="Full Name"
                      class="block rounded p-2 mt-1 border-2"
                      :class="v$.patient.fullname.$error ? 'border-red-500' : 'border-sky-600'"
                      v-model="patient.fullname">
                  </label>
                  <div v-if="v$.patient.fullname.$error">
                    <p class="text-md text-red-700">{{v$.patient.fullname.$errors[0].$message}}</p>
                  </div>
                </div>

                <!-- sex -->
                <div class="mt-3">
                  <p class="text-md">Sex</p>
                  <div
                    class="border-2 p-2 rounded"
                    :class="v$.patient.sex.$error ? 'border-red-500' : 'border-sky-600'">
                    <div class="flex justify-start items-center gap-2">
                      <label for="male">
                        <input type="radio" name="sex" id="sex" value="male"
                        class="border-sky-600" v-model="patient.sex">
                        <span class="ml-1">Male</span>
                      </label>
                      <label for="status">
                        <input type="radio" name="sex" id="sex" value="female" class="border-sky-600"
                        v-model="patient.sex">
                        <span class="ml-1">Female</span>
                      </label>
                    </div>
                  </div>
                  <div v-if="v$.patient.sex.$error">
                  <p class="text-md text-red-700">{{v$.patient.sex.$errors[0].$message}}</p>
                  </div>
                </div>

                <!-- birthdate -->
                <div class="mt-3">
                  <label for="birthdate">
                    <span class="text-md">Birth Date</span>
                    <input type="date" name="birthdate" id="birthdate" placeholder="Birthdate"
                    class="block w-full rounded p-2 mt-1 border-2"
                    :class="v$.patient.birthdate.$error ? 'border-red-500' : 'border-sky-600'"
                    v-model="patient.birthdate">
                  </label>
                  <div v-if="v$.patient.birthdate.$error">
                    <p class="text-md text-red-700">{{v$.patient.birthdate.$errors[0].$message}}</p>
                  </div>
                </div>

                <!-- address -->
                <div class="mt-3">
                  <label for="address">
                    <span class="text-md">Address</span>
                    <input type="text" name="address" id="address" placeholder="Address"
                    class="block rounded p-2 mt-1 border-2"
                    :class="v$.patient.address.$error ? 'border-red-500' : 'border-sky-600'"
                    v-model="patient.address">
                  </label>
                  <div v-if="v$.patient.address.$error">
                    <p class="text-md text-red-700">{{v$.patient.address.$errors[0].$message}}</p>
                  </div>
                </div>

                <!-- contact number -->
                <div class="mt-3">
                  <label for="contact_no">
                    <span class="text-md">Contact Number</span>
                    <input type="text" name="fullname" id="fullname" placeholder="Contact Number" 
                    class="block rounded p-2 mt-1 border-2 border-sky-600"
                    :class="v$.patient.contact_no.$error ? 'border-red-500' : 'border-sky-600'"
                    v-model="patient.contact_no">
                  </label>
                  <div v-if="v$.patient.contact_no.$error">
                    <p class="text-md text-red-700">{{v$.patient.contact_no.$errors[0].$message}}</p>
                  </div>
                </div>

                <!-- actions -->
                <div class="mt-5 col-span-2">
                  <input type="submit" class="block w-full rounded p-2 text-lg bg-sky-600 text-white hover:bg-sky-500 hover:cursor-pointer" value="Register">
                </div>
              </form>
            </div>
          </div>
          <div class="w-full h-[10%] flex justify-end items-end gap-2 p-2">
            <Link href="/main-menu" class="block rounded p-2 shadow text-sm bg-sky-600 text-white hover:bg-sky-500 hover:cursor-pointer">
              Back to Main Menu
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
import useVuelidate from '@vuelidate/core'
import { required, maxValue, numeric, minLength, maxLength} from '@vuelidate/validators'


export default {
  components: {
    Vue3Lottie
  },

  props: {
    window: Object,
    patient: Object,
  },

  data() {
    return {
      v$: useVuelidate(),
      hasId: false,
      doctorLottie,
    }
  },

  validations() {
    return {
      patient: {
        fullname: { required, },
        sex: { required, },
        birthdate: {
          required,
          maxValue: value => {
            console.log(value)
          }
        },
        address: { required },
        contact_no: { 
          required,
          numeric,
          minLength: minLength(11),
          maxLength: maxLength(11),
        }
      }
    }
  },

  methods: {
    handleSubmit() {
      this.v$.$validate()
    },
    validateId() {
      if(this.patient.unique_id.length) {
        this.hasId = true
      } else {
        this.hasId = false
      }
    },
  }
}
</script>

<style>

</style>
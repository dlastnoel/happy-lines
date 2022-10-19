<template :auth="auth" :window="window">
  <Head>
    <title>{{ window.name }}</title>
  </Head>
  <div class="mx-5">
    <Breadcrumb
      :links="[
        {
          label: w 
        },
      ]"
    />
  </div>
  <template v-if="patients.length || serving_patient != 0">
    <div class="m-5 p-3 flex justify-start items-start gap-4">
      <template v-if="patients.length">
        <table class="w-[50%] table-auto shadow">
          <thead>
            <tr
                class="text-xs text-left text-gray-500 bg-white border-b-2"
            >
              <th class="p-3 text-center">Queue Number</th>
              <th class="p-3 text-center">Fullname</th>
              <th class="p-3"></th>
            </tr>
          </thead>
          <tbody class="bg-white">
            <tr v-for="(patient, i) in patients" :key="i">
              <td class="p-3 text-center">{{ patient.number }}</td>
              <td class="p-3 text-center">{{ patient.fullname }}</td>
              <td class="p-3">
                <Link
                    :href="`/queues/${window.id}/${patient.id}/next`"
                    class="rounded p-1 font-semibold text-sm bg-sky-600 text-white hover:bg-sky-500 hover:cursor-pointer"
                    >
                    Next
                </Link>
              </td>
            </tr>
          </tbody>
        </table>
      </template>
      <template v-else>
        <div class="w-full m-6 pt-6 flex flex-col justifty-center items-center">
          <p class="text-3xl">No incoming patient(s) at the moment.</p>
        </div>
      </template>
      <!--  -->
      <div class="w-[50%] bg-white shadow p-3 flex flex-col justify-start items-center">
        <h3 class="text-3xl text-center">Serving</h3>
        <div 
          v-if="serving_patient != 0"
          class="mt-3 p-5 grid place-content-center w-full">
          <p class="text-5xl text-center ">{{serving_patient.number}}</p>
          <p class="text-3xl text-center ">{{serving_patient.fullname}}</p>
          <form @submit.prevent="handleSubmit()" class="mt-2 w-full flex flex-col justify-center items-center">
            <textarea placeholder="Diagnosis" v-model="patient.diagnosis"
            name="diagnosis" id="diagnosis" cols="30" rows="10"
            class="rounded shadow p-2 w-full border-2 border-sky-600"
            :class="v$.patient.diagnosis.$error ? 'border-red-500' : 'border-sky-600'"></textarea>
            <div class="w-full" v-if="v$.patient.diagnosis.$error">
              <p class="w-full text-md text-red-700">{{v$.patient.diagnosis.$errors[0].$message}}</p>
            </div>
            <input 
            type="submit" value="Finish up" class="mt-2 w-full rounded p-2 font-semibold text-md bg-sky-600 text-white hover:bg-sky-500 hover:cursor-pointer">
          </form>
          <!-- <Link
            :href="`/queues/${window.id}/${serving_patient.id}/${next}/finish`"
            class="mt-2 text-center rounded p-1 font-semibold text-sm bg-sky-600 text-white hover:bg-sky-500 hover:cursor-pointer"
            >
            Next in Line
          </Link> -->
        </div>
      </div>
    </div>
  </template>
  <template v-else>
    <div class="m-6 pt-6 flex flex-col justifty-center items-center">
        <div class="w-1/2">
          <Vue3Lottie :animationData="emptyLottie" class="w-1/2"/>
        </div>
        <p class="text-3xl">No patient(s) at the moment.</p>
    </div>
  </template>
</template>

<script>
import AdminLayout from "@/Layouts/Admin.vue";
import Breadcrumb from "@/Components/Breadcrumb.vue";
import { integer } from '@vuelidate/validators';

import { Vue3Lottie } from 'vue3-lottie'
import 'vue3-lottie/dist/style.css'
import emptyLottie from '@/../json/empty.json'

import useVuelidate from '@vuelidate/core'
import { required } from '@vuelidate/validators'

export default {
  layout: AdminLayout,

  components: {
      Breadcrumb,
      Vue3Lottie,
    },

  props: {
      auth: Object,
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
      next: integer,
    },  

  data() {
    return {
      emptyLottie,
      v$: useVuelidate(),
      patient: {
        window_id: this.window.id,
        patient_id: this.serving_patient.id,
        diagnosis: '',
      },
      submitted: false
    }
  },

  validations() {
    return {
      patient: {
        diagnosis: {
          required,
        },
      }
    }
  },

  methods: {
    handleSubmit() {
      this.submitted = true
      this.v$.$validate()
      if(!this.v$.$error) {
        this.$inertia.post('/queues/diagnose', this.patient, {
          onError: (errors) => {
            for(const error in errors) {
              this.showToast(`${errors[error]}`, 'error')  
            }
            this.showToast('Error diagnosis submission', 'error')
          },
          onSuccess: () => {
            this.showToast('Diagnosis submitted', 'success')
          }
        })
      }
      this.submitted = false
    }
  },
};
</script>

<style></style>

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
        <div class="h-full w-full flex flex-col justify-center items-center p-3 md:p-2">
          <div class="w-full flex flex-col justify-center items-center h-[90%]">
            <h1 class="text-6xl text-center">Happy Lines</h1>
            <form class="mt-4" @submit.prevent="handleSubmit()">
              <div>
                <label for="username">
                  <span class="text-md">Username</span>
                  <input 
                    type="text" name="username" id="username" placeholder="Username" 
                    class="block rounded p-3 mt-1 w-full md:w-[350px] lg:w-[400px] border-2"
                    :class="v$.login.username.$error ? 'border-red-500' : 'border-sky-600'"
                    v-model="login.username" />
                </label>
                <div v-if="v$.login.username.$error">
                  <p class="text-md text-red-700">{{v$.login.username.$errors[0].$message}}</p>
                </div>
              </div>
              
              <div class="mt-3">
                <label for="password">
                  <span class="text-md">Password</span>
                  <input 
                    type="password" name="password" id="password" placeholder="Password" 
                    class="block rounded p-3 mt-1 w-full  md:w-[350px] lg:w-[400px]  border-2"
                    :class="v$.login.password.$error ? 'border-red-500' : 'border-sky-600'"
                    v-model="login.password" />
                </label>
                <div v-if="v$.login.password.$error">
                  <p class="text-md text-red-700">{{v$.login.password.$errors[0].$message}}</p>
                </div>
              </div>

              <div class="mt-5">
                <input :disabled="submitted" type="submit" class="block rounded p-3 w-full md:w-[350px] lg:w-[400px] font-semibold text-lg bg-sky-600 text-white hover:bg-sky-500 hover:cursor-pointer" value="Login">
              </div>
              
            </form>
          </div>
          <div class="w-full h-[10%] flex justify-end items-end gap-2 p-2">
            <Link href="/monitors" class="block rounded p-2 shadow text-sm bg-sky-600 text-white hover:bg-sky-500 hover:cursor-pointer">
              Monitoring
            </Link>
            <Link href="/service/select" class="block rounded p-2 shadow text-sm bg-sky-600 text-white hover:bg-sky-500 hover:cursor-pointer">
              Open Main Menu
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
import doctorLottie from '../../../json/doctor.json'
import useVuelidate from '@vuelidate/core'
import { required, alphaNum, minLength } from '@vuelidate/validators'

export default {
  components: {
    Vue3Lottie
  },

  props: {
    errors: Object,
  },

  data() {
    return {
      doctorLottie,
      v$: useVuelidate(),
      login: {
        username: '',
        password: '',
      },
      submitted: false,
    }
  },

  validations() {
    return {
      login: {
        username: { required, alphaNum },
        password: { 
          required,
        }
      }
    }
  },

  methods: {
    handleSubmit() {
      this.submitted = true,
      this.v$.$validate()
      if(!this.v$.$error) {
        this.$inertia.post('/login', this.login, {
          onError: (errors) => {
            for(const error in errors) {
                this.showToast(`${errors[error]}`, 'error')  
              }
          },
          onSuccess: () => {
            this.showToast('Welcome!')
          }
        })
      }
      this.submitted = false
    }
  }
}
</script>

<style>

</style>
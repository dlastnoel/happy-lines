<template>
  <Head>
    <title>Login</title>
  </Head>
  <div class="h-screen grid place-content-center gap-5 bg-sky-600">
    <div class="h-[85vh] w-[90vw] grid md:grid-cols-2 rounded-lg shadow-lg bg-white ">
      <div class="p-5 hidden md:grid place-content-center w-full ">
        <Vue3Lottie :animationData="doctorLottie" class="h-full w-full" />
      </div>
      <div class="h-full w-full flex flex-col justify-center items-center gap-5">
        <div class="md:hidden w-1/2 grid  place-content-center">
          <Vue3Lottie :animationData="doctorLottie"/>
        </div>
        <h1 class="text-6xl text-center">Happy Lines</h1>
        <form class="mt-4" @submit.prevent="handleSubmit()">
          <div>
            <label for="username">
              <span class="text-md">Username</span>
              <input 
                type="text" name="username" id="username" placeholder="Username" 
                class="block rounded p-3 mt-1 w-[400px] md:w-[350px] lg:w-[400px] border-2 border-sky-600"
                v-model="login.username" />
            </label>
            <div v-if="errors.username">
              <p class="text-sm text-red-700">{{errors.username}}</p>
            </div>
          </div>
          
          <div class="mt-3">
            <label for="password">
              <span class="text-md">Password</span>
              <input 
                type="password" name="password" id="password" placeholder="Password" 
                class="block rounded p-3 mt-1 w-[400px] md:w-[350px] lg:w-[400px]  border-2 border-sky-600"
                v-model="login.password" />
            </label>
            <div v-if="errors.password">
              <p class="text-sm text-red-700">{{errors.password}}</p>
            </div>
          </div>

          <div class="mt-5">
            <input :disabled="submitted" type="submit" class="block rounded p-3 w-[400px] sm:w-[400px] md:w-[350px] lg:w-[400px] font-semibold text-lg bg-sky-600 text-white hover:bg-sky-500 hover:cursor-pointer" value="Login">
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

  props: {
    errors: Object,
  },

  data() {
    return {
      doctorLottie,
      login: {
        username: '',
        password: '',
      },
      submitted: false,
    }
  },

  methods: {
    handleSubmit() {
      this.submitted = true,
      this.$inertia.post('/login', this.login, {
        onError: () => {
          this.showToast('Error logging in', 'error')
        },
        onSuccess: () => {
          this.showToast('Welcome!')
        }
      })
      this.submitted = false
    }
  }
}
</script>

<style>

</style>
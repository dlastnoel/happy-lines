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
          <div class="w-full flex flex-col justify-center items-center h-[90%]">
            <!-- <h1 class="text-6xl text-center">Happy Lines</h1> -->
            <h3 class="text-5xl text-center">You are now on queue. Please wait for your number to be called.</h3>
            <div class="mt-12 min-w-[400px] rounded shadow p-5 border-[4px] border-sky-600">
              <p class="text-5xl text-center ">{{queue.window}}</p>
              <p class="my-8 text-9xl text-center ">{{queue.number}}</p>
              <p class="text-5xl text-center ">{{queue.user.fullname}}</p>
              <p v-if="queue.user.unique_id" class="text-3xl text-center ">{{queue.user.unique_id}}</p>
            </div>
            <Link href="/service/select" class="block mt-2 rounded p-3 text-center w-[400px] sm:w-[400px] md:w-[350px] lg:w-[400px] font-semibold text-lg bg-sky-600 text-white hover:bg-sky-500 hover:cursor-pointer">Back to Main Menu</Link>
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
    queue: Object,
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

  validations() {
    return {
      login: {
        username: { required, alphaNum },
        password: { 
          required,
          minLength: minLength(8),
        }
      }
    }
  },
}
</script>

<style>

</style>
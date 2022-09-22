<template>
  <div>
    <nav class="w-full py-4 px-5 bg-gray-100 shadow">
      <div 
        class="flex justify-end items-center gap-3 relative hover:cursor-pointer"
        @click="isProfileMenuOpen = !isProfileMenuOpen">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7 rounded-full">
          <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
        </svg>
        <h6 class="font-semibold relative">{{auth.user}}</h6>
      </div>
        <div 
          class="absolute mt-2 right-10 shadow w-44 bg-gray-100"
          v-if="isProfileMenuOpen">
          <ul>
            <li class="rounded w-full py-2 px-3 text-left hover:bg-sky-500 hover:text-white hover:cursor-pointer">Profile</li>
            <li>
              <form @submit.prevent="handleLogout()">
                <input 
                  type="submit" value="Logout" 
                  class="rounded w-full py-2 px-3 text-left hover:bg-sky-500 hover:text-white hover:cursor-pointer" >
              </form>
            </li>
          </ul>
        </div>
    </nav>
  </div>
</template>

<script>
export default {

  props: {
    auth: Object,
  },

  data() {
    return {
      isProfileMenuOpen: false,
    }
  },

  methods: {
    handleLogout() {
      this.$inertia.post('/logout')
    }
  }

}
</script>

<style>

</style>
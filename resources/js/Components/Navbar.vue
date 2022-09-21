<template>
  <div>
    <nav class="w-full py-4 px-5 bg-gray-100 shadow">
      <div 
        class="flex justify-end items-center gap-3 relative hover:cursor-pointer"
        @click="isProfileMenuOpen = !isProfileMenuOpen">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 rounded-full ring-2 ring-offset-2 ring-gray-300 shadow">
          <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
        </svg>
        <h6 class="font-semibold relative">John Doe</h6>
      </div>
        <div 
          class="absolute mt-2 right-0 p-3 shadow w-44 bg-gray-100"
          v-if="isProfileMenuOpen">
          <ul>
            <li>Profile</li>
            <li>
              <form @submit.prevent="handleLogout()">
                <input 
                  type="submit" value="Logout" 
                  class="rounded w-full p-1 text-left hover:bg-sky-500 hover:text-white hover:cursor-pointer" >
              </form>
            </li>
          </ul>
        </div>
    </nav>
  </div>
</template>

<script>
export default {

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
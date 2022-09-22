<template>
  <div>
    <div class="flex grid-cols-2">
      <Sidebar :auth="auth" :window="window"/>
      <div class="flex flex-col w-full bg-gray-100">
        <Navbar :auth="auth"/>
        <div class="p-3">
          <slot/>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Navbar from '../Components/Navbar.vue'
import Sidebar from '../Components/Sidebar.vue'
export default {

  props: {
    auth: Object,
    window: {
      type: Object,
      required: true,
      default: {
        id: '',
        name: '',
      }
    }
  },

  components: {
    Navbar,
    Sidebar,
  }
}
</script>

<style>

</style>
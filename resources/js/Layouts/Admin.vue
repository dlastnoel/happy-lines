<template>
  <div>
    <div class="flex grid-cols-2">
      <Sidebar/>
      <div class="flex flex-col w-full bg-gray-100">
        <Navbar/>
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
  components: {
    Navbar,
    Sidebar,
  }
}
</script>

<style>

</style>
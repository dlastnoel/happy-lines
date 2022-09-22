<template :auth="auth" :window="window">
  <Head>
    <title>Dashboard</title>
  </Head>
  <div>
    <h1 class="text-9xl">Dashboard Admin</h1>
  </div>
</template>

<script>
import AdminLayout from '@/Layouts/Admin.vue'

export default {

  props: {
    auth: Object,
    window: {
      type: Object,
      required: false,
      default: {
        id: '',
        name: '',        
      }
    }
  },
  
  layout: AdminLayout
}
</script>

<style>

</style>
<template :auth="auth" :window="window">
  <Head>
    <title>Queue Records</title>
  </Head>
  <div>
  </div>
</template>

<script>
import AdminLayout from '../../../Layouts/Admin.vue'
export default {

  layout: AdminLayout,

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
  }


}
</script>

<style>

</style>
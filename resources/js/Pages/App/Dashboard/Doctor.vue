<template :auth="auth" :window="window">
  <Head>
    <title>Dashboard</title>
  </Head>
  <div class="mx-5">
    <Breadcrumb :links="[
      {
        label: 'Dashboard',
        to: '#',
      },
    ]" />
  </div>
  <div>

  </div>
</template>

<script>
import AdminLayout from '@/Layouts/Admin.vue'
import Breadcrumb from '@/Components/Breadcrumb.vue'

export default {

  components: {
    Breadcrumb,
  },

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
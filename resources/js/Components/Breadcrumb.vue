<template>
  <ul class="m-2 flex items-center">

    <!-- if links has more than 1 -->
    <template v-if="links.length > 1">
      <!-- loop through links -->
      <template v-for="(link, i) in links" :key="i">
         <!-- check for last link item -->
        <template v-if="i == links.length - 1">
          <li class="flex items-center">
          <Link href="link.to" class="text-lg font-semibold">{{link.label}}</Link>
          </li>
        </template>
        <!-- else -->
        <template v-else>
          <li class="flex items-center">
            <Link :href="link.to" class="text-lg">{{link.label}}</Link>
            <span>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
            </svg>
          </span>
          </li>
        </template>
      </template>
    </template>

    <!-- links contain only 1 -->
    <template v-else>
      <li class="flex items-center" v-for="(link, i) in links" :key="i">
          <Link :href="link.to" class="text-lg font-semibold">{{link.label}}</Link>
        </li>
    </template>
  </ul>
</template>

<script>
export default {
  props: {
    links: Array
  }
}
</script>

<style>

</style>
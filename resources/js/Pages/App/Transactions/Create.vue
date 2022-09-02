<template>
  <Head>
    <title>Transactions</title>
  </Head>
  <div>
    <div class="m-5 p-3 shadow rounded bg-white">
      <form action="">
        <div>
          <div class="my-2">
            <p class="text-xl font-semibold">Transaction Information</p>
            <hr>
          </div>
          <div class="mt-2 w-full flex flex-col gap-3 p-2">
            <label for="name">
              <span>Transaction Type</span>
              <input type="text" name="name" id="name" placeholder="Transaction Type" class="block w-full rounded px-3 py-2 border-[1px] border-sky-600">
            </label>
            <label for="Description">
              <span>Description</span>
              <textarea name="description" id="description" placeholder="Description" cols="30" rows="5" class="block w-full rounded px-3 py-2 border-[1px] border-sky-600"></textarea>
            </label>
            <div class="flex justify-between items-start">
              <label for="status">
                <input type="checkbox" name="status" id="status" class="border-sky-600">
                <span class="ml-1">Set as Active</span>
              </label>
              <div class="flex justify-center items-center gap-2 p-2">
                <button type="reset" class="block rounded p-3 font-semibold text-lg bg-gray-200 text-black hover:bg-gray-100 hover:cursor-pointer">Clear Fields</button>
                <button type="submit" class="block rounded p-3 font-semibold text-lg bg-sky-600 text-white hover:bg-sky-500 hover:cursor-pointer">Add Transaction</button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import AdminLayout from '../../../Layouts/Admin.vue'

export default {
  layout: AdminLayout
}
</script>

<style>

</style>
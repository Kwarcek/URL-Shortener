<template>
  <section class="m-1 p-2 w-9/12 border rounded">
    <div v-if="data">
      <div class="flex justify-between">
        <h1>{{ data.title }}</h1>
        <i
          class="fa fa-times text-red-300 hover:text-red-600 cursor-pointer"
          @click="destroy"
        ></i>
      </div>
      <p class="text-xs text-gray-500">
        {{ data.original_url }}
      </p>
      <div class="flex my-5">
        <p class="text-xs text-orange-500">
          {{ data.shorten_url }}
        </p>
        <i
          @click="copyToClipboard(data.path)"
          class="fa fa-copy text-xs text-orange-500 mx-2 py-1 cursor-pointer"
        ></i>
      </div>
      <div class="my-5">
        <p class="text-sm text-gray-600">Visits: {{ data.visits }}</p>
      </div>
    </div>
    <div v-else class="text-center text-xl text-gray-500">
      <h2>Select URL to show details</h2>
    </div>
  </section>
</template>

<script>
export default {
  props: ["data"],
  methods: {
    copyToClipboard(url) {
      navigator.clipboard.writeText(url);
    },
    destroy() {
      this.$emit("deleteItem", this.data);
    },
  },
};
</script>

<style></style>

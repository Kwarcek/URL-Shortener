<template>
  <div class="flex justify-between mt-5">
    <a
      href=""
      :class="items.current_page == 1 ? 'text-gray-600' : ''"
      @click.prevent="prev"
    >
      <i class="fa fa-caret-left"></i>
    </a>
    <a
      href=""
      :class="items.current_page == items.last_page ? 'text-gray-600' : ''"
      @click.prevent="next"
      ><i class="fa fa-caret-right"></i
    ></a>
  </div>
</template>

<script>
export default {
  props: ["items"],
  methods: {
    next() {
      Event.$emit("nextPage");
    },
    prev() {
      Event.$emit("prevPage");
    },
  },
};
</script>

<style></style>

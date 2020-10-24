<template>
  <div class="right-0 left-0 fixed flex justify-center" v-if="show">
    <div class="absolute rounded border-2 shadow-xl bg-white p-1">
      <div class="w-full h-full rounded border p-4">
        <form @submit.prevent="submit" class="p-4">
          <h1 class="text-center font-bold">Shorten Your URL</h1>
          <div class="my-1 flex-col">
            <div>
              <input
                type="text"
                placeholder="Title for your shorten url"
                class="p-2 border rounded-md shadow-md w-64"
                v-model="form.title"
              />
            </div>

            <span class="text-xs text-red-500 w-full" v-if="errors.title">{{
              errors.title[0]
            }}</span>
          </div>
          <div class="my-1 flex-col">
            <div>
              <input
                type="text"
                placeholder="Paste your big url"
                class="p-2 border rounded-md shadow-md w-64"
                v-model="form.original_url"
              />
            </div>
            <span class="text-xs text-red-500" v-if="errors.original_url">{{
              errors.original_url[0]
            }}</span>
          </div>
          <i
            @click="close"
            class="fa fa-times-circle text-gray-600 cursor-pointer float-left my-0"
          ></i>
          <i
            @click="submit"
            class="fa fa-paper-plane text-orange-600 cursor-pointer float-right my-0"
          ></i>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["show", "items"],
  data() {
    return {
      form: {
        title: "",
        original_url: "",
      },
      errors: {},
    };
  },
  methods: {
    close() {
      this.errors = {};
      this.$emit("closeModal");
    },
    submit() {
      axios
        .post("/url", this.form)
        .then((res) => {
          this.form.title = "";
          this.form.original_url = "";
          this.close();
          this.items.unshift(res.data);
          this.$notify({ message: "Created Successfully" });
        })
        .catch((e) => {
          this.errors = e.response.data.errors;
        });
    },
  },
};
</script>

<style></style>

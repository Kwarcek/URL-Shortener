<template>
  <div>
    <div class="text-center mt-5 mb-2 text-2xl">Url shortener</div>
    <div class="flex justify-center w-full">
      <form @submit.prevent="submit" class="flex justify-center w-full">
        <input
          type="text"
          v-model="original_url"
          required
          class="appearance-none pr-3 block w-1/3 bg-white text-gray-700 border border-gray-400 shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none focus:border-gray-500"
          minlength="4"
          placeholder="Paste your url"
        />
        <button
          type="submit"
          class="md:w-32 ml-2 bg-teal-600 hover:bg-blue-dark text-white font-bold py-3 px-4 rounded-lg mt-3 hover:bg-teal-500 transition ease-in-out duration-300"
        >
          Submit
        </button>
      </form>
    </div>
    <span
      class="text-xs text-red-500 text-center flex justify-center mt-3"
      v-if="errors"
      >{{ errors }}</span
    >
    <section class="mt-5 flex justify-center">
      <div class="border rounded-md p-4" v-if="items.length > 0">
        <table>
          <thead>
            <tr>
              <th>Original url</th>
              <th>Shorten url</th>
              <th>Visits</th>
              <th>Created at</th>
              <th>Delete</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="item in items" :key="item.id">
              <td class="p-2 rounded border text-sm">
                {{ item.original_url }}
              </td>
              <td class="p-2 rounded border text-sm">
                <a :href="item.path" target="_blank">{{ item.shorten_url }}</a>
              </td>
              <td class="p-2 rounded border text-sm">{{ item.visits }}</td>
              <td class="p-2 rounded border text-sm">{{ item.created_at }}</td>
              <td class="p-2 rounded border text-sm">
                <svg
                  aria-hidden="true"
                  focusable="false"
                  data-prefix="fas"
                  data-icon="times"
                  class="svg-inline--fa fa-times fa-w-11 cursor-pointer"
                  role="img"
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 352 512"
                  style="max-width: 16px"
                  @click="destroy(item)"
                >
                  <path
                    fill="#feb2b2"
                    d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z"
                  ></path>
                </svg>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </section>
  </div>
</template>

<script>
export default {
  middleware: "auth",
  data() {
    return {
      original_url: "",
      errors: null,
      items: [],
    };
  },
  mounted() {
    this.fetchData();
  },
  methods: {
    submit() {
      if (this.original_url == "") return;
      axios
        .post("/api/url", { original_url: this.original_url })
        .then((res) => {
          this.original_url = "";
          this.items.unshift(res.data);
          this.$notify({
            message: "Url added successfully 😃",
          });
        })
        .catch((e) => {
          this.errors = e.response.data.errors.original_url[0];
          //console.log(this.errors);
        });
    },
    fetchData() {
      axios
        .get("/api/url")
        .then((res) => {
          this.items = res.data;
          //console.log(res.data);
        })
        .catch((e) => {
          this.errors = e.response.data;
        });
    },
    destroy(item) {
      if (confirm("Are you sure?")) {
        axios.delete(`/api/url/${item.shorten_url}`).then((res) => {
          this.items = this.items.filter((i) => i.id != item.id);
          this.$notify({
            message: "Url deleted successfully 😃",
            type: "warning",
          });
        });
      }
    },
  },
};
</script>

<style>
</style>

<template>
  <div>
    <div class="text-center mt-5 mb-2 text-2xl">Url shortener</div>
    <div class="flex justify-center w-full">
      <form
        @submit.prevent="submit"
        class="md:w-full flex justify-center w-8/12 flex-wrap"
      >
        <div class="flex w-full justify-center">
          <input
            type="text"
            v-model="form.title"
            required
            class="appearance-none pr-3 block w-1/2 bg-white text-gray-700 border border-gray-400 shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none focus:border-gray-500"
            minlength="3"
            placeholder="Title"
          />
        </div>
        <div class="flex w-full justify-center mt-3">
          <input
            type="text"
            v-model="form.original_url"
            required
            class="appearance-none pr-3 block w-1/2 bg-white text-gray-700 border border-gray-400 shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none focus:border-gray-500"
            minlength="4"
            placeholder="Paste your url"
          />
        </div>
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
      <div v-if="items.data.length > 0">
        <div class="border rounded-md p-4">
          <table>
            <thead>
              <tr>
                <th>Title</th>
                <th>Original url</th>
                <th>Shorten url</th>
                <th>Visits</th>
                <th>Created at</th>
                <th>Delete</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="item in items.data" :key="item.id">
                <td class="p-2 rounded border text-sm">
                  {{ item.title }}
                </td>
                <td class="p-2 rounded border text-sm">
                  {{ item.original_url }}
                </td>
                <td class="p-2 rounded border text-sm">
                  <span
                    class="cursor-pointer"
                    @click="copyToClipboard(item.path)"
                  >
                    {{ item.path }}
                  </span>
                  <a :href="item.path" target="_blank">
                    <i class="fa fa-external-link pl-1" aria-hidden="true"></i>
                  </a>
                </td>
                <td class="p-2 rounded border text-sm">{{ item.visits }}</td>
                <td class="p-2 rounded border text-sm">
                  {{ item.created_at }}
                </td>
                <td class="p-2 rounded border text-sm pl-5">
                  <i
                    class="fa fa-trash cursor-pointer text-red-600 text-lg"
                    aria-hidden="true"
                    @click="destroy(item)"
                  ></i>
                </td>
              </tr>
            </tbody>
          </table>
          <div class="flex w-full justify-between mt-5">
            <a
              href=""
              class="border rounded shadow-xs w-10 flex justify-center"
              :class="
                items.current_page == 1
                  ? 'bg-gray-200 text-gray-600 shadow-none cursor-default'
                  : ''
              "
              @click.prevent="prev"
            >
              <<
            </a>
            <a
              href=""
              class="border rounded shadow-xs w-10 flex justify-center"
              :class="
                items.current_page == items.last_page
                  ? 'bg-gray-200 text-gray-600 shadow-none cursor-default'
                  : ''
              "
              @click.prevent="next"
            >
              >>
            </a>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
export default {
  middleware: "auth",
  data() {
    return {
      form: {
        original_url: "",
        title: "",
      },
      errors: null,
      items: { data: [] },
    };
  },
  mounted() {
    this.fetchData(this.$route.query.page);
  },
  methods: {
    submit() {
      if (this.original_url == "") return;
      axios
        .post("/url", this.form)
        .then((res) => {
          (this.form.title = ""), (this.form.original_url = "");
          this.items.unshift(res.data);
          this.$notify({
            message: "Url added successfully 😃",
          });
        })
        .catch((e) => {
          this.errors = e.response.data.errors.original_url[0];
        });
    },
    fetchData(page = 1) {
      axios
        .get(`/url?page=${page}`)
        .then((res) => {
          this.items = res.data;
        })
        .catch((e) => {
          this.errors = e.response.data;
        });
    },
    destroy(item) {
      if (confirm("Are you sure?")) {
        axios.delete(`/url/${item.shorten_url}`).then((res) => {
          this.items = this.items.filter((i) => i.id != item.id);
          this.$notify({
            message: "Url deleted successfully 😃",
            type: "warning",
          });
        });
      }
    },
    copyToClipboard(url) {
      navigator.clipboard.writeText(url);
    },
    next() {
      if (this.items.current_page == this.items.last_page) return;
      let nextPage = this.items.current_page + 1;
      this.fetchData(nextPage);
      this.$router.replace({ query: { page: page } });
    },
    prev() {
      let prevPage = this.items.current_page - 1;
      if (prevPage == 0) return;
      this.fetchData(prevPage);
      this.$router.replace({ query: { page: page } });
    },
  },
};
</script>

<style>
</style>

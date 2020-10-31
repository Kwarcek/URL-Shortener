<template>
  <div class="w-full flex flex-wrap">
    <!-- Login Section -->
    <div class="w-full md:w-1/2 flex flex-col">
      <div
        class="flex flex-col justify-center md:justify-start my-auto pt-8 md:pt-0 px-8 md:px-24 lg:px-32"
      >
        <p class="text-center text-3xl">Reset password</p>
        <form class="flex flex-col pt-3 md:pt-8" @submit.prevent="submit">
          <div class="flex flex-col pt-4">
            <label for="email" class="text-lg">Email</label>
            <input
              type="email"
              id="email"
              placeholder="Your email"
              v-model="form.email"
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline"
            />
          </div>

          <div class="flex flex-col pt-4">
            <label for="password" class="text-lg">Password</label>
            <input
              type="password"
              id="password"
              placeholder="Your new password"
              v-model="form.password"
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline"
            />
          </div>

          <div class="flex flex-col pt-4">
            <label for="password_confirmation" class="text-lg"
              >Confirm password</label
            >
            <input
              type="password"
              id="password_confirmation"
              placeholder="Confirm your new password"
              v-model="form.password_confirmation"
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline"
            />
          </div>

          <input
            type="submit"
            value="Reset password"
            class="bg-teal-600 text-white font-bold text-lg hover:bg-teal-800 p-2 mt-8 cursor-pointer"
          />
        </form>
        <div class="text-center pt-12 pb-12">
          <p>
            Don't have an account?
            <router-link to="/register" class="underline font-semibold">
              Register here.
            </router-link>
          </p>
          <p class="pt-3">
            <router-link to="/forgot-password" class="underline font-semibold">
              Forgot password?
            </router-link>
          </p>
        </div>
      </div>
    </div>

    <!-- Image Section -->
    <div class="w-1/2 shadow-2xl">
      <MainSvg />
    </div>
  </div>
</template>


<script>
import MainSvg from "../components/index/MainSvg.vue";

export default {
  components: { MainSvg },
  middleware: "guest",
  data() {
    return {
      form: {
        email: "",
        token: "",
        password: "",
        password_confirmation: "",
      },
    };
  },
  mounted() {
    this.form.email = this.$route.query.email;
    this.form.token = this.$route.params.token;
  },
  methods: {
    submit() {
      axios.post("/password/reset", this.form).then((res) => {
        window.location = "/";
      });
    },
  },
};
</script>

<style></style>

<template>
  <div>
    <bridge-notify />
    <app-header />
    <div class="min-h-screen">
      <router-view></router-view>
      <!-- <Index /> -->
    </div>
    <app-footer />
  </div>
</template>

<script>
import AppHeader from "./components/Layouts/Header";
import AppFooter from "./components/Layouts/Footer";

export default {
  components: { AppHeader, AppFooter },
};
</script>

<style></style>

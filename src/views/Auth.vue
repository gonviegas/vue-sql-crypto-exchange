<template>
  <div class="home">
    <HomeNavBar />
    <h1>AUTH PAGE</h1>
    <router-view />
  </div>
</template>

<script>
// @ is an alias to /src
import HomeNavBar from "@/components/HomeNavBar.vue";

export default {
  name: "Auth",
  components: {
    HomeNavBar
  }
};
</script>

<style lang="scss">
.container {
  display: grid;
  gap: 16px;
  grid-template-columns: 160px 1fr;
  margin: 0 auto;
  padding: 0 16px;
  width: 100%;

  &.auth {
    grid-template-columns: 1fr;
    max-width: 500px;
  }
}
</style>

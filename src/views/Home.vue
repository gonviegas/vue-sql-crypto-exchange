<template>
  <div class="home">
    <HomeNavBar />
    <router-view />
  </div>
</template>

<script>
// @ is an alias to /src
import HomeNavBar from "@/components/home/HomeNavBar.vue";

export default {
  name: "Home",
  components: {
    HomeNavBar
  }
};
</script>

<template>
  <div class="home">
    <HomeNavBar />
    <h1>MAIN PAGE</h1>
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

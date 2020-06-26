<template>
  <div class="news">
    <NavBar />
    <h1>This is a NEWS page</h1>
  </div>
</template>

<script>
// @ is an alias to /src
import NavBar from "@/components/NavBar.vue";

export default {
  name: "News",
  components: {
    NavBar
  }
};
</script>

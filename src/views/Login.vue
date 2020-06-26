<template>
  <div class="login">
    <NavBar />
    <h1>This is a LOGIN page</h1>
  </div>
</template>

<script>
// @ is an alias to /src
import NavBar from "@/components/NavBar.vue";

export default {
  name: "Login",
  components: {
    NavBar
  }
};
</script>

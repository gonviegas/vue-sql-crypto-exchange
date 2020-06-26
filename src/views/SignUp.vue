<template>
  <div class="sign-up">
    <NavBar />
    <h1>This is a SIGN UP page</h1>
  </div>
</template>

<script>
// @ is an alias to /src
import NavBar from "@/components/NavBar.vue";

export default {
  name: "SignUp",
  components: {
    NavBar
  }
};
</script>

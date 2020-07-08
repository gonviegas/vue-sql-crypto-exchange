<template>
  <div>
    <UserNavbar />
    <router-view />
  </div>
</template>

<script>
import UserNavbar from "@/components/user/UserNavbar.vue";

export default {
  name: "UserDashboard",
  components: {
    UserNavbar
  }
};
</script>

<style lang="scss"></style>

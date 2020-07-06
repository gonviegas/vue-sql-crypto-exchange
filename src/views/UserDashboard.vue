<template>
  <div>
    <UserNavbar />
    <Market />
    <News />
    <router-view />
  </div>
</template>

<script>
import UserNavbar from "@/components/user/UserNavbar.vue";
import Market from "@/components/Market.vue";
import News from "@/components/News.vue";

export default {
  name: "UserDashboard",
  components: {
    UserNavbar,
    Market,
    News
  }
};
</script>

<style lang="scss"></style>

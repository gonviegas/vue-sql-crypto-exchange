<template>
  <div>
    <FrontNavbar />
    <router-view />
  </div>
</template>

<script>
import FrontNavbar from "@/components/staff/frontoffice/FrontNavbar.vue";
export default {
  name: "FrontDashboard",
  components: {
    FrontNavbar
  }
};
</script>

<style lang="scss" scoped></style>

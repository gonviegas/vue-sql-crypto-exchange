<template>
  <div>
    <AdminNavBar />
    <router-view />
  </div>
</template>

<script>
import AdminNavBar from "@/components/admin/AdminNavBar.vue";
export default {
  name: "AdminDashboard",
  components: {
    AdminNavBar
  }
};
</script>

<style lang="scss" scoped></style>

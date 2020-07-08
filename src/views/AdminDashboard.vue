<template>
  <div>
    <AdminSidebar />
    <router-view />
  </div>
</template>

<script>
import AdminSidebar from "@/components/staff/backoffice/AdminSidebar.vue";

export default {
  name: "AdminDashboard",
  components: {
    AdminSidebar
  }
};
</script>

<style lang="scss" scoped></style>

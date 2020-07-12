<template>
  <div>
    <AdminNavbar />
    <router-view />
  </div>
</template>

<script>
import AdminNavbar from "@/components/staff/backoffice/AdminNavbar.vue";


export default {
  name: "AdminDashboard",
  components: {
    AdminNavbar,
  },
  
};
</script>

<style lang="scss" >
.panel {
  margin-left: 50px;
  margin-right: 50px;
}
.modal-mask {
  position: fixed;
  z-index: 9998;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  display: table;
  transition: opacity 0.3s ease;
}
label{
  font-size: 10pt;
}

.modal-wrapper {
  display: table-cell;
  vertical-align: middle;
}

</style>

<template>
  <div>
    <AdminNavbar />
    <input type="submit" value="ACTIVATE FAKER" v-on:click.prevent="Faker()"/>
    <router-view />
  </div>
</template>

<script>
import AdminNavbar from "@/components/staff/backoffice/AdminNavbar.vue";
import axios from "axios";

export default {
  name: "AdminDashboard",
  components: {
    AdminNavbar,
  },
  methods: {
    Faker() {
      axios({
        method: "post",
        url: "http://localhost/api/faker.php",
      }).catch(res => {
        res.data = "FAKER ACTIVATED";
        alert(res.data);
      });
    },
  }
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

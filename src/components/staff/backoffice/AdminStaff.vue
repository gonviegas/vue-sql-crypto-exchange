<template>
  <div>
    <div>{{ fetchAll_staff }}</div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "AdminStaff",
  data() {
    return {
      fetchAll_staff: ""
    };
  },
  methods: {
    fetchAllStaff() {
      axios({
        method: "post",
        url: this.$axios_url,
        data: {
          action: "staff_fetchAllStaff"
        }
      })
        .then(res => {
          this.fetchAll_staff = res.data;
        })

        .catch(err => {
          console.log("Network Error", err);
        });
    }
  },
  beforeMount() {
    this.fetchAllStaff();
  }
};
</script>

<style></style>

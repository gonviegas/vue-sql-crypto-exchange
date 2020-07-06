<template>
  <div>
    <div>{{ fetchAll_transfer }}</div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "FrontTransfers",
  data() {
    return {
      fetchAll_transfer: ""
    };
  },
  methods: {
    fetchAllTransfer() {
      axios({
        method: "post",
        url: this.$axios_url,
        data: {
          action: "staff_fetchAllTransfer"
        }
      })
        .then(res => {
          this.fetchAll_transfer = res.data;
        })

        .catch(err => {
          console.log("Network Error", err);
        });
    }
  },
  beforeMount() {
    this.fetchAllTransfer();
  }
};
</script>

<style></style>

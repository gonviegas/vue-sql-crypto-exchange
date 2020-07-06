<template>
  <div>
    <div>{{ fetchAll_store_wallet }}</div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "FrontStoreWallet",
  data() {
    return {
      fetchAll_store_wallet: ""
    };
  },
  methods: {
    fetchAllStoreWallet() {
      axios({
        method: "post",
        url: this.$axios_url,
        data: {
          action: "staff_fetchAllStoreWallet"
        }
      })
        .then(res => {
          this.fetchAll_store_wallet = res.data;
        })

        .catch(err => {
          console.log("Network Error", err);
        });
    }
  },
  beforeMount() {
    this.fetchAllStoreWallet();
  }
};
</script>

<style></style>

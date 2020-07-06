<template>
  <div>
    <div>{{ fetchAll_wallet }}</div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "AdminWallets",
  data() {
    return {
      fetchAll_wallet: ""
    };
  },
  methods: {
    fetchAllWallet() {
      axios({
        method: "post",
        url: this.$axios_url,
        data: {
          action: "staff_fetchAllWallet"
        }
      })
        .then(res => {
          this.fetchAll_wallet = res.data;
        })

        .catch(err => {
          console.log("Network Error", err);
        });
    }
  },
  beforeMount() {
    this.fetchAllWallet();
  }
};
</script>

<style></style>

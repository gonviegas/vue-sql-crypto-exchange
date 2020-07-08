<template>
  <div>
    <div>{{ data }}</div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "Market",
  data() {
    return {
      data: ""
    };
  },
  methods: {
    getCrypto() {
      axios({
        method: "post",
        url: this.$axios_url_news_market_api,
        data: {
          action: "market,EUR"
        }
      })
        .then(res => {
          this.data = res.data;
          console.log(res.data);
          // this.rows = JSON.stringify(res.data);
          // this.rows = this.data;
        })

        .catch(err => {
          console.log("Network Error", err);
        });
    }
  },
  beforeMount() {
    this.getCrypto();
  }
};
</script>

<style lang="scss" scoped></style>

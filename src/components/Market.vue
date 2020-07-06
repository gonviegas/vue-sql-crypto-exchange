<template>
  <div>
    
    {{ data }}
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "Market",
  data() {
    return {
      data: null,
    };
  },
  methods: {
    getCrypto() {
      axios({
        method: "get",
        url:
          "https://min-api.cryptocompare.com/data/pricemulti?fsyms=BTC,ETH,XRP,XLM,DGB&tsyms=USD,EUR"
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

}
</script>

<style lang="scss" scoped>

</style>
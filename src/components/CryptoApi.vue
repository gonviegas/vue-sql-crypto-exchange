<template>
  <div>
    <fieldset>
      <input type="submit" value="Get Crypto" @click.prevent="getUsers()" />
    </fieldset>
    {{ data }}
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "CryptoApi",
  data() {
    return {
      data: null
    };
  },
  methods: {
    getUsers() {
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
  }
};
</script>

<style lang="scss" scoped></style>

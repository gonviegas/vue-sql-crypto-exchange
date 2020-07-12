<template>
  <div>
    <table class="table">
      <thead>
          <tr>
              <th v-for="(column, index) in columns" :key="index"> {{column}}</th>
          </tr>
      </thead>
      <tbody>
          <tr v-for="(item, index) in items" :key="index">
              <td v-for="(column, indexColumn) in columns" :key="indexColumn">{{item[column]}}</td>
          </tr>
      </tbody>
    </table>   
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "Market",
  data() {
    return {
      data: "",
      btc_usd: '',
      items: '',
      columns: [ 'currency','USD', 'EUR'],
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
          this.items = res.data;
        })
    }
  },
  beforeMount() {
    this.getCrypto();
  }
};
</script>

<style lang="scss" scoped></style>

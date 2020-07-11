<template>
  <div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <div class="row">
          <div class="col-md-6">
            <div class="container-xxl">
            <h3 class="panel-title">Store Wallet</h3>
          </div>
        </div>
      </div>
    </div>
    <div class="panel-body">
      <div class="table-responsive-xxl">
        <table class="table table-bordered table-striped">
          <tr>
            <th>Currency</th>
            <th>Balance</th>
            <th>Fee</th>
            <th>USD</th>
            <th>EUR</th>
          </tr>
          <tr v-for="row in allData" :key="row.id">
            <td>{{ row.currency | uppercase }}</td>
            <td>{{ row.balance }}</td>
            <td>{{ row.fee }}%</td>
            <td>{{ row.usd }}$</td>
            <td>{{ row.eur }} €</td>
          </tr>
        </table>
      </div>
    </div>
  </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "FrontStoreWallet",
  data() {
    return {
      allData: "",
      filter: "",
      crypto: null
    };
  },

  methods: {
    fetchAll() {
      axios({
        method: "post",
        url: this.$axios_url,
        data: {
          action: "staff_fetchAllStoreWallet",
          btc_usd: this.l
        }
      })
        .then(res => {
          this.allData = res.data;
        })

        .catch(err => {
          console.log("Network Error", err);
        });
    },
    getCrypto() {
      axios({
        method: "get",
        url:
          "https://min-api.cryptocompare.com/data/pricemulti?fsyms=BTC,ETH,XRP,XLM,DGB&tsyms=USD,EUR"
      })
        .then(res => {
          this.crypto = res.data;
        })

        .catch(err => {
          console.log("Network Error", err);
        });
    }
  },
  filters: {
    capitalize(filter) {
      if (!filter) return "";
      filter = filter.toString();
      return filter.charAt(0).toUpperCase() + filter.slice(1);
    },
    uppercase(filter) {
      if (!filter) return "";
      filter = filter.toString();
      return filter.toUpperCase();
    }
  },
  beforeMount() {
    this.getCrypto();
    this.fetchAll();
  }
};
</script>

<style lang="scss" scoped></style>

<template>
  <div>
    <div class="table-responsive">
      <div class="container">
        <table class="table">
          <tr>
            <th>Currency</th>
            <th>Balance</th>
            <th>USD</th>
            <th>EUR</th>
            <th>Value</th>
          </tr>
          <tr v-for="row in allData" :key="row.id">
            <td>{{ row.currency | uppercase }}</td>
            <td>{{ row.balance }}</td>
            <td>{{ row.usd }}</td>
            <td>{{ row.eur }}</td>
            <td>{{ row.value }}</td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "UserWallet",
  data() {
    return {
      allData: "",
      filter: "",
      currency: "",
      balance: "",
      btc_usd: "",
      btc_eur: "",
      eth_usd: "",
      eth_eur: "",
      xrp_usd: "",
      xrp_eur: "",
      xlm_usd: "",
      xlm_eur: "",
      dgb_usd: "",
      dgb_eur: ""
    };
  },

  methods: {
    fetchAll() {
      axios({
        method: "post",
        url: this.$axios_url,
        data: {
          action: "user_fetchAllWallet",
        }
      })
        .then(res => {
          this.allData = res.data;
          console.log(res.data);
        })

        .catch(err => {
          console.log("Network Error", err);
        });
    },
    submitData() {
      if (this.currency != "" && this.balance != "") {
        if (this.actionButton == "Insert") {
          axios({
            method: "post",
            url: this.$axios_url,
            data: {
              action: "admin_insertStoreWallet",
              currency: this.currency,
              balance: this.balance,
              fee: this.fee
            }
          }).then(res => {
            this.myModel = false;
            this.fetchAll();
            alert(res.data.message);
            this.currency = "";
            this.balance = "";
            this.fee = "";
          });
        }
        if (this.actionButton == "Update") {
          axios({
            method: "post",
            url: this.$axios_url,
            data: {
              action: "admin_updateStoreWallet",
              currency: this.currency,
              balance: this.balance,
              fee: this.fee,
              hiddenId: this.hiddenId
            }
          }).then(res => {
            this.myModel = false;
            this.currency = "";
            this.balance = "";
            (this.fee = ""), (this.hiddenId = "");
            this.fetchAll();
            alert(res.data.message);
          });
        }
      } else {
        alert("Fill All Field");
      }
    },
    fetchData(id) {
      axios({
        method: "post",
        url: this.$axios_url,
        data: {
          action: "admin_fetchSingleStoreWallet",
          id: id
        }
      }).then(res => {
        this.currency = res.data.currency;
        this.balance = res.data.balance;
        this.fee = res.data.fee;
        this.hiddenId = res.data.id;
        this.myModel = true;
        this.actionButton = "Update";
        this.dynamicTitle = "Edit Data";
      });
    },
    deleteData(id) {
      if (confirm("Are you sure you want to remove this data?")) {
        axios({
          method: "post",
          url: this.$axios_url,
          data: {
            action: "admin_deleteStoreWallet",
            id: id
          }
        }).then(res => {
          this.fetchAll();
          alert(res.data.message);
        });
      }
    },
    updateCryptoPrices() {
      axios({
        method: "post",
        url: this.$axios_url,
        data: {
          action: "updateCryptoPrices",
          btc_usd: this.btc_usd,
          btc_eur: this.btc_eur,
          eth_usd: this.eth_usd,
          eth_eur: this.eth_eur,
          xrp_usd: this.xrp_usd,
          xrp_eur: this.xrp_eur,
          xlm_usd: this.xlm_usd,
          xlm_eur: this.xlm_eur,
          dgb_usd: this.dgb_usd,
          dgb_eur: this.dgb_eur
        }
      });
    },
    getCrypto() {
      axios({
        method: "get",
        url:
          "https://min-api.cryptocompare.com/data/pricemulti?fsyms=BTC,ETH,XRP,XLM,DGB&tsyms=USD,EUR"
      })
        .then(res => {
          this.btc_usd = res.data.BTC.USD;
          this.btc_eur = res.data.BTC.EUR;
          this.eth_usd = res.data.ETH.USD;
          this.eth_eur = res.data.ETH.EUR;
          this.xrp_usd = res.data.XRP.USD;
          this.xrp_eur = res.data.XRP.EUR;
          this.xlm_usd = res.data.XLM.USD;
          this.xlm_eur = res.data.XLM.EUR;
          this.dgb_usd = res.data.DGB.USD;
          this.dgb_eur = res.data.DGB.EUR;
          this.updateCryptoPrices();
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

<style lang="scss" scoped>
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

.modal-wrapper {
  display: table-cell;
  vertical-align: middle;
}
</style>
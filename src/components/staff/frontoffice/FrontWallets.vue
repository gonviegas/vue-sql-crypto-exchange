<template>
  <div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <div class="row">
          <div class="col-md-6">
            <div class="container-xxl">
            <h3 class="panel-title">Customer Wallets</h3>
          </div>
        </div>
      </div>
    </div>
    <div class="panel-body">
      <div class="table-responsive-xxl">
        <table class="table table-bordered table-striped">
          <tr>
            <th>customer_id</th>
            <th>currency</th>
            <th>balance</th>
          </tr>
          <tr v-for="row in allData" :key="row.id">
            <td>{{ row.customer_id }}</td>
            <td>{{ row.currency | uppercase }}</td>
            <td>{{ row.balance }}</td>
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
  name: "FrontWallets",
  data() {
    return {
      allData: "",
      filter: ""
    };
  },

  methods: {
    fetchAll() {
      axios({
        method: "post",
        url: this.$axios_url,
        data: {
          action: "staff_fetchAllWallet"
        }
      })
        .then(res => {
          this.allData = res.data;
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
    this.fetchAll();
  }
};
</script>

<style lang="scss" scoped></style>

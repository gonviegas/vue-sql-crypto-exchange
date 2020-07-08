<template>
  <div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <div class="row">
          <div class="col-md-6">
            <h3 class="panel-title">Store Wallet</h3>
          </div>
        </div>
      </div>
    </div>
    <div class="panel-body">
      <div class="table-responsive">
        <table class="table table-bordered table-striped">
          <tr>
            <th>date</th>
            <th>from_address</th>
            <th>from_currency</th>
            <th>from_volume</th>
            <th>to_address</th>
            <th>to_currency</th>
            <th>to_volume</th>
          </tr>
          <tr v-for="row in allData" :key="row.id">
            <td>{{ row.date }}</td>
            <td>{{ row.from_address }}</td>
            <td>{{ row.from_currency | uppercase }}</td>
            <td>{{ row.from_volume }}</td>
            <td>{{ row.to_address }}</td>
            <td>{{ row.to_currency | uppercase }}</td>
            <td>{{ row.to_volume }}</td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "AdminTransfers",
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
          action: "staff_fetchAllTransfer"
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

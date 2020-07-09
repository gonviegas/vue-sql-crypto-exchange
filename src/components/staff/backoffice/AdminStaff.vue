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
            <th>first_name</th>
            <th>last_name</th>
            <th>username</th>
            <th>email</th>
            <th>level</th>
            <th>active</th>
            <th>password</th>
            <th>token</th>
          </tr>
          <tr v-for="row in allData" :key="row.id">
            <td>{{ row.first_name | capitalize }}</td>
            <td>{{ row.last_name | capitalize }}</td>
            <td>{{ row.username }}</td>
            <td>{{ row.email }}</td>
            <td>{{ row.level }}</td>
            <td>{{ row.active }}</td>
            <td>{{ row.password }}</td>
            <td>{{ row.token }}</td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "AdminStaff",
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
          action: "staff_fetchAllStaff"
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

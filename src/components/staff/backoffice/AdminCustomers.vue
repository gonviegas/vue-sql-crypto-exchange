<template>
  <div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <div class="row">
          <div class="col-md-6">
            <h3 class="panel-title">Sample Data</h3>
          </div>
          <div class="col-md-6" align="right">
            <input
              type="button"
              class="btn btn-success btn-xs"
              @click="openModel"
              value="Add"
            />
          </div>
        </div>
      </div>
      <div class="panel-body">
        <div class="table-responsive">
          <table class="table table-bordered table-striped">
            <tr>
              <th>id</th>
              <th>email</th>
              <th>first_name</th>
              <th>last_name</th>
              <th>verified</th>
              <th>status</th>
              <th>password</th>
              <th>token</th>
              <th>timestamp</th>
            </tr>
            <tr v-for="row in allData" :key="row.id">
              <td>{{ row.id }}</td>
              <td>{{ row.email }}</td>
              <td>{{ row.first_name | capitalize }}</td>
              <td>{{ row.last_name | capitalize }}</td>
              <td>{{ row.verified }}</td>
              <td>{{ row.status | uppercase }}</td>
              <td>{{ row.password }}</td>
              <td>{{ row.token }}</td>
              <td>{{ row.timestamp }}</td>
              <td>
                <button
                  type="button"
                  name="edit"
                  class="btn btn-primary btn-xs edit"
                  @click="fetchData(row.id)"
                >
                  Edit
                </button>
              </td>
              <td>
                <button
                  type="button"
                  name="delete"
                  class="btn btn-danger btn-xs delete"
                  @click="deleteData(row.id)"
                >
                  Delete
                </button>
              </td>
            </tr>
          </table>
        </div>
      </div>
    </div>
    <div v-if="myModel">
      <transition name="model">
        <div class="modal-mask">
          <div class="modal-wrapper">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" @click="myModel = false">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  <h4 class="modal-title">{{ dynamicTitle }}</h4>
                </div>
                <div class="modal-body">
                  <div class="form-group">
                    <label>Enter First Name</label>
                    <input
                      type="text"
                      class="form-control"
                      v-model="first_name"
                    />
                  </div>
                  <div class="form-group">
                    <label>Enter Last Name</label>
                    <input
                      type="text"
                      class="form-control"
                      v-model="last_name"
                    />
                  </div>
                  <br />
                  <div align="center">
                    <input type="hidden" />
                    <input
                      type="button"
                      class="btn btn-success btn-xs"
                      v-model="actionButton"
                      @click="submitData"
                    />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </transition>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "AdminCustomers",
  data() {
    return {
      allData: "",
      filter: "",
      myModel: false,
      actionButton: "Insert",
      dynamicTitle: "Add Data"
    };
  },
  methods: {
    fetchAll() {
      axios({
        method: "post",
        url: this.$axios_url,
        data: {
          action: "staff_fetchAllCustomer"
        }
      })
        .then(res => {
          this.allData = res.data;
        })

        .catch(err => {
          console.log("Network Error", err);
        });
    },
    openModel() {
      this.first_name = "";
      this.last_name = "";
      this.actionButton = "Insert";
      this.dynamicTitle = "Add Data";
      this.myModel = true;
    },
    submitData() {
      if (this.first_name != "" && this.last_name != "") {
        if (this.actionButton == "Insert") {
          axios({
            method: "post",
            url: this.$axios_url,
            data: {
              action: "admin_insertCustomer",
              first_name: this.first_name,
              last_name: this.last_name
            }
          })
            .then(res => {
              this.myModel = false;
              this.fetchAll();
              this.first_name = "";
              this.last_name = "";
              alert(res.data.message);
            })

            .catch(err => {
              console.log("Network Error", err);
            });
        }
      }
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

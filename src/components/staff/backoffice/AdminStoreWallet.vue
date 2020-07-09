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
                    <label>Enter Currency</label>
                    <input
                      type="text"
                      class="form-control"
                      v-model="currency"
                    />
                  </div>
                  <div class="form-group">
                    <label>Enter Balance</label>
                    <input type="text" class="form-control" v-model="balance" />
                  </div>
                  <div class="form-group">
                    <label>Fee</label>
                    <input type="text" class="form-control" v-model="fee" />
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
  name: "AdminStoreWallet",
  data() {
    return {
      allData: "",
      filter: "",
      myModel: false,
      actionButton: "Insert",
      dynamicTitle: "Add Data",
      currency: "",
      balance: ""
    };
  },

  methods: {
    fetchAll() {
      axios({
        method: "post",
        url: this.$axios_url,
        data: {
          action: "staff_fetchAllStoreWallet"
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
      this.currency = "";
      this.balance = "";
      (this.fee = ""), (this.actionButton = "Insert");
      this.dynamicTitle = "Add Data";
      this.myModel = true;
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
          })
            .then(res => {
              this.myModel = false;
              this.fetchAll();
              this.currency = "";
              this.balance = "";
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

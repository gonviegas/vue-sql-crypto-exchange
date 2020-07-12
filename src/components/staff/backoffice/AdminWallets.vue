<template>
  <div>
    <div class="container-xxl">
      <h3 class="panel-title">Customer Wallets</h3>

      <div class="col-md-12" align="right">
        <button type="button" class="btn btn-info" @click="openModel" value="Add">Add</button>
      </div>

      <div class="table-responsive-xxl">
        <table class="table table-bordered table-striped">
          <tr>
              <th>customer_id</th>
              <th>currency</th>
              <th>balance</th>
              </tr>
          <tr v-for="row in allData" :key="row.id">
            <td>{{ row.customer_id }}</td>
            <td>{{ row.currency }}</td>
            <td>{{ row.balance }}</td>
            <td>
              <button
                type="button"
                name="edit"
                class="btn btn-primary btn-xs edit"
                @click="fetchData(row.id)"
              >Edit</button>
            </td>
            <td>
              <button
                type="button"
                name="delete"
                class="btn btn-danger btn-xs delete"
                @click="deleteData(row.id)"
              >Delete</button>
            </td>
          </tr>
        </table>
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
                      <h4 class="modal-title col-md-12">{{ dynamicTitle }}</h4>
                    </div>
                    <div class="modal-body">
                      <div class="form-group">
                        <label>customer_id</label>
                        <input type="text" class="form-control" v-model="customer_id" />
                      </div>
                      <div class="form-group">
                        <label>currency</label>
                        <input type="text" class="form-control" v-model="currency" />
                      </div>
                      <div class="form-group">
                        <label>balance</label>
                        <input type="text" class="form-control" v-model="balance" />
                      </div>
                      <br />
                      <div align="center">
                        <input type="hidden" v-model="hiddenId" />
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
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "AdminWallets",
  data() {
    return {
      allData: "",
      filter: "",
      myModel: false,
      actionButton: "Insert",
      dynamicTitle: "Add Data",
      hiddenId: "",
      customer_id: "",
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
          action: "staff_fetchAllWallet"
        }
      }).then(res => {
        this.allData = res.data;
      });
    },
    openModel() {
      this.customer_id = "",
      this.currency = "",
      this.actionButton = "Insert";
      this.dynamicTitle = "Add Data";
      this.myModel = true;
    },
    submitData() {
      if (
        this.customer_id != "" &&
        this.currency != "" && this.balance != ""
      ) {
        if (this.actionButton == "Insert") {
          axios({
            method: "post",
            url: this.$axios_url,
            data: {
            action: "admin_insertWallet",
            customer_id: this.customer_id,
            currency: this.currency,
            balance: this.balance,
            }
          }).then(res => {
            this.myModel = false;
            this.fetchAll();
            alert(res.data.message);
            this.customer_id = "";
            this.currency = "";
            this.balance = ""
          });
        }
        if (this.actionButton == "Update") {
          axios({
            method: "post",
            url: this.$axios_url,
            data: {
              action: "admin_updateWallet",
              balance: this.balance,
              currency: this.currency,
              hiddenId: this.hiddenId
            }
          }).then(res => {
            this.myModel = false;
            this.balance = "";
            this.currency = "";
            this.hiddenId = "";
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
          action: "admin_fetchSingleWallet",
          id: id
        }
      }).then(res => {
        this.customer_id = res.data.customer_id;
        this.currency = res.data.currency;
        this.balance = res.data.balance;
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
            action: "admin_deleteWallet",
            id: id
          }
        }).then(res => {
          this.fetchAll();
          alert(res.data.message);
        });
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

<template>
  <div>
    <div class="container-xxl">
      <h3 class="panel-title">Staff</h3>

      <div class="col-md-12" align="right">
        <button type="button" class="btn btn-info" @click="openModel" value="Add">Add</button>
      </div>

      <div class="table-responsive-xxl">
        <table class="table table-bordered table-striped">
          <tr>
            <th>id</th>
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
            <td>{{ row.id }}</td>
            <td>{{ row.first_name | capitalize }}</td>
            <td>{{ row.last_name | capitalize }}</td>
            <td>{{ row.username }}</td>
            <td>{{ row.email }}</td>
            <td>{{ row.level }}</td>
            <td>{{ row.active }}</td>
            <td>{{ row.password }}</td>
            <td>{{ row.token }}</td>
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
                        <label>first_name</label>
                        <input type="text" class="form-control" v-model="first_name" />
                      </div>
                      <div class="form-group">
                        <label>last_name</label>
                        <input type="text" class="form-control" v-model="last_name" />
                      </div>
                      <div class="form-group">
                        <label>username</label>
                        <input type="text" class="form-control" v-model="username" />
                      </div>

                      <div class="form-group">
                        <label>email</label>
                        <input type="text" class="form-control" v-model="email" />
                      </div>
                      <div class="form-group">
                        <label>level</label>
                        <input type="text" class="form-control" v-model="level" />
                      </div>
                      <div class="form-group">
                        <label>active</label>
                        <input type="text" class="form-control" v-model="active" />
                      </div>
                      <div class="form-group">
                        <label>password</label>
                        <input type="text" class="form-control" v-model="password" />
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
  name: "AdminStaff",
  data() {
    return {
      allData: "",
      filter: "",
      myModel: false,
      actionButton: "Insert",
      dynamicTitle: "Add Data",
      hiddenId: "",
      first_name: "",
      last_name: "",
      username: "",
      email: "",
      password: "",
      token: "",
      active: "",
      level: ""
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
      }).then(res => {
        this.allData = res.data;
      });
    },
    openModel() {
      (this.email = ""),
        (this.first_name = ""),
        (this.last_name = ""),
        (this.username = ""),
        (this.level = ""),
        (this.password = ""),
        (this.active = ""),
        (this.actionButton = "Insert");
      this.dynamicTitle = "Add Data";
      this.myModel = true;
    },
    submitData() {
      if (
        this.email != "" &&
        this.first_name != "" &&
        this.last_name != "" &&
        this.username != "" &&
        this.level != "" &&
        this.password != "" &&
        this.active != ""
      ) {
        if (this.actionButton == "Insert") {
          axios({
            method: "post",
            url: this.$axios_url,
            data: {
              action: "admin_insertStaff",
              email: this.email,
              first_name: this.first_name,
              last_name: this.last_name,
              username: this.username,
              level: this.level,
              active: this.active,
              password: this.password
            }
          }).then(res => {
            this.myModel = false;
            this.fetchAll();
            alert(res.data.message);
            (this.email = ""),
              (this.first_name = ""),
              (this.last_name = ""),
              (this.username = ""),
              (this.level = ""),
              (this.password = ""),
              (this.active = "");
          });
        }
        if (this.actionButton == "Update") {
          axios({
            method: "post",
            url: this.$axios_url,
            data: {
              action: "admin_updateStaff",
              email: this.email,
              first_name: this.first_name,
              last_name: this.last_name,
              username: this.username,
              level: this.level,
              active: this.active,
              password: this.password,
              hiddenId: this.hiddenId
            }
          }).then(res => {
            this.myModel = false;
            (this.email = ""),
              (this.first_name = ""),
              (this.last_name = ""),
              (this.username = ""),
              (this.level = ""),
              (this.password = ""),
              (this.active = ""),
              (this.hiddenId = "");
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
          action: "admin_fetchSingleStaff",
          id: id
        }
      }).then(res => {
        this.email = res.data.email;
        this.first_name = res.data.first_name;
        this.last_name = res.data.last_name;
        this.username = res.data.username;
        this.level = res.data.level;
        this.password = res.data.password;
        this.active = res.data.active;
        this.token = res.data.token;
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
            action: "admin_deleteStaff",
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
label{
  font-size: 10pt;
}

.modal-wrapper {
  display: table-cell;
  vertical-align: middle;
}
</style>

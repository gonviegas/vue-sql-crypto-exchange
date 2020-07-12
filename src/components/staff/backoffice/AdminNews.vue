<template>
  <div>
    <div class="container-xxl">
      <h3 class="panel-title">News</h3>

      <div class="col-md-12" align="right">
        <button type="button" class="btn btn-info" @click="openModel" value="Add">Add</button>
      </div>

      <div class="table-responsive-xxl">
        <table class="table table-bordered table-striped">
          <tr>
            <th>Id</th>
            <th>Title</th>
            <th>Body</th>
            <th>Date</th>
          </tr>
          <tr v-for="row in allData" :key="row.id">
            <td>{{ row.id }}</td>
            <td>{{ row.title }}</td>
            <td>{{ row.body }}</td>
            <td>{{ row.date }}</td>
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
                        <label>title</label>
                        <input type="text" class="form-control" v-model="title" />
                      </div>
                      <div class="form-group">
                        <label>body</label>
                        <input type="text" class="form-control" v-model="body" />
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
  name: "AdminNews",
  data() {
    return {
      allData: "",
      filter: "",
      myModel: false,
      actionButton: "Insert",
      dynamicTitle: "Add Data",
      hiddenId: "",
      title: "",
      body: "",
      date: ""
    };
  },
  methods: {
    fetchAll() {
      axios({
        method: "post",
        url: this.$axios_url,
        data: {
          action: "admin_fetchAllNews"
        }
      }).then(res => {
        this.allData = res.data;
      });
    },
    openModel() {
      this.title = "",
      this.body = "",
      this.actionButton = "Insert";
      this.dynamicTitle = "Add Data";
      this.myModel = true;
    },
    submitData() {
      if (
        this.title != "" &&
        this.body != ""
      ) {
        if (this.actionButton == "Insert") {
          axios({
            method: "post",
            url: this.$axios_url,
            data: {
            action: "admin_insertNews",
            title: this.title,
            body: this.body,
            date: this.date,
            }
          }).then(res => {
            this.myModel = false;
            this.fetchAll();
            alert(res.data.message);
            this.title = "";
            this.body = "";
            this.date = ""
          });
        }
        if (this.actionButton == "Update") {
          axios({
            method: "post",
            url: this.$axios_url,
            data: {
              action: "admin_updateNews",
              title: this.title,
              body: this.body,
              hiddenId: this.hiddenId
            }
          }).then(res => {
            this.myModel = false;
            this.title = "";
            this.body = "";
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
          action: "admin_fetchSingleNews",
          id: id
        }
      }).then(res => {
        this.title = res.data.title;
        this.body = res.data.body;
        this.date = res.data.date;
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
            action: "admin_deleteNews",
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

</style>

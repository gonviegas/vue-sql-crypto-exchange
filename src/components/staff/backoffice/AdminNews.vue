<template>
  <div>
    <div>{{ fetchAll_news }}</div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "AdminNews",
  data() {
    return {
      fetchAll_news: ""
    };
  },
  methods: {
    fetchAllNews() {
      axios({
        method: "post",
        url: this.$axios_url,
        data: {
          action: "admin_fetchAllNews"
        }
      })
        .then(res => {
          this.fetchAll_news = res.data;
        })

        .catch(err => {
          console.log("Network Error", err);
        });
    }
  },
  beforeMount() {
    this.fetchAllNews();
  }
};
</script>

<style></style>

<template>
  <div>
    <fieldset>
      <input
        type="submit"
        value="Get Users Table"
        @click.prevent="usersGet()"
      />
    </fieldset>

    <h3>{{ users }}</h3>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "AdminUsersTable",
  data() {
    return {
      users: ""
    };
  },
  methods: {
    usersGet() {
      axios({
        method: "get",

        // ******* DEV
        url: "http://localhost/api/get.php"
        //         DEV  *******

        // ******* DEPLOY
        // url: "api/signup.php",
        //         DEPLOY *******
      })
        .then(res => {
          this.users = res.data;
          // console.log(this.users)
        })

        .catch(err => {
          console.log("Network Error", err);
        });
    }
  }
};
</script>

<style lang="scss" scoped></style>

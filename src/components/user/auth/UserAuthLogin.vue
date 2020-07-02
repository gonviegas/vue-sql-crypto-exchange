<template>
  <div class="container auth">
    <div>
      <form action="login.php" method="post">
        <fieldset>
          <ul>
            <li>
              <label for="email">E-mail</label>
              <input type="text" name="email" v-model="Auth.email" />
            </li>

            <li>
              <label for="password">Password</label>
              <input type="password" name="password" v-model="Auth.password" />
            </li>
          </ul>
        </fieldset>
        <fieldset>
          <input type="submit" value="Signin" @click.prevent="userLogin()" />
        </fieldset>
      </form>
      <p>{{ msg }}</p>
      <router-link to="/user/reset"><li>Forgot your password?</li></router-link>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "UserAuthLogin",
  data() {
    return {
      msg: null,
      Auth: {
        email: "",
        password: ""
      }
    };
  },
  methods: {
    resetForm() {
      this.Auth.email = "";
      this.Auth.password = "";
    },
    userLogin() {
      var data = new FormData();
      data.append("email", this.Auth.email);
      data.append("password", this.Auth.password);

      axios({
        method: "post",
        // ******* DEV
        url: "http://localhost/api/login.php",
        //         DEV  *******
        // ******* DEPLOYMENT
        // url: "api/signup.php",
        //         DEPLOYMENT *******
        data: data
      })
        .then(res => {
          if (res.data.err) {
            this.msg = res.data.msg;
          } else {
            this.$router.push("dashboard");
          }
        })
        .catch(err => {
          console.log("Network Error", err);
        });
    }
  }
};
</script>

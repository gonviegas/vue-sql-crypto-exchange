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
      <router-link to="/auth/reset"><li>Forgot your password?</li></router-link>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "AuthLogin",
  data() {
    return {
      Auth: {
        email: "",
        password: "",
        cpassword: ""
      }
    };
  },
  methods: {
    resetForm: function() {
      this.Auth.email = "";
      this.Auth.password = "";
    },
    userLogin: function() {
      console.log("METHOD: User Login");

      let formData = new FormData();
      formData.append("email", this.Auth.email);
      formData.append("password", this.Auth.password);

      // ******  DEBUG START *******
      var authUser = {};
      formData.forEach(function(value, key) {
        authUser[key] = value;
      });
      console.log(authUser);
      // ******  DEBUG END *******

      axios({
        method: "post",

        // ******* DEV
        url: "http://localhost/api/login.php",
        //         DEV  *******

        // ******* DEPLOYMENT
        // url: "api/signup.php",
        //         DEPLOYMENT *******

        data: formData,
        config: { headers: { "Content-Type": "multipart/form-data" } }
      })
        .then(function(response) {
          //handle success
          // this.message = response;
          console.log(response);
        })
        .catch(function(response) {
          //handle error
          // this.message = response;
          console.log(response);
        });
    }
  }
};
</script>

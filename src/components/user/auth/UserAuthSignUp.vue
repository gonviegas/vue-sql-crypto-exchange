<template>
  <div class="container auth">
    <div>
      <form action="signup.php" method="post">
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

            <li>
              <label for="cpassword">Confirm Password</label>
              <input
                type="password"
                name="cpassword"
                v-model="Auth.cpassword"
              />
            </li>
          </ul>
        </fieldset>
        <fieldset>
          <input type="submit" value="Signup" @click.prevent="userSignUp()" />
        </fieldset>
      </form>
      <div id="msg">
        <h3>{{ message }}</h3>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "UserAuthSignUp",
  data() {
    return {
      message: "",
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
      this.Auth.cpassword = "";
    },
    userSignUp: function() {
      console.log("METHOD: User SignUp");

      let formData = new FormData();
      formData.append("email", this.Auth.email);
      formData.append("password", this.Auth.password);
      formData.append("cpassword", this.Auth.cpassword);

      // ******  DEBUG START *******
      // var authUser = {};
      // formData.forEach(function(value, key) {
      //   authUser[key] = value;
      // });
      // console.log(authUser);
      // ******  DEBUG END *******

      axios({
        method: "post",

        // ******* DEV
        url: "http://localhost/api/signup.php",
        //         DEV  *******

        // ******* DEPLOY
        // url: "api/signup.php",
        //         DEPLOY *******

        data: formData,
        config: { headers: { "Content-Type": "multipart/form-data" } }
      })
        .then(response => (this.message = response.data))
        //handle success
        // this.message = "response";

        .catch(response => (this.message = response));
      //handle error
      // this.message = 1;
      // console.log(response);
    }
  }
};
</script>

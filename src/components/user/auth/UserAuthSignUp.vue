<template>
  <div class="container auth">
    <div>
      <form action="signup" method="post">
        <fieldset>
          <ul>
            <li>
              <label for="email">E-mail</label>
              <input type="text" name="email" v-model="email" />
            </li>

            <li>
              <label for="password">Password</label>
              <input type="password" name="password" v-model="password" />
            </li>

            <li>
              <label for="cpassword">Confirm Password</label>
              <input type="password" name="cpassword" v-model="cpassword" />
            </li>
          </ul>
        </fieldset>
        <fieldset>
          <input type="submit" value="Signup" @click.prevent="userSignUp()" />
        </fieldset>
      </form>
      <div id="msg">
        <h3>{{ msg }}</h3>
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
      msg: ""
    };
  },
  methods: {
    userSignUp() {
      axios({
        method: "post",
        url: "http://localhost/api/api.php",
        data: {
          email: this.email,
          password: this.password,
          cpassword: this.cpassword,
          action: "user_signup"
        }
      })
        .then(res => (this.msg = res.data.msg))

        .catch(err => {
          this.msg = err;
        });
    }
  }
};
</script>

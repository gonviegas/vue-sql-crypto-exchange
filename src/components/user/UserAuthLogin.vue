<template>
  <div class="container auth">
    <div>
      <form action="login" method="post">
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
      msg: "",
      email: "",
      password: "",
      token: "",
    };
  },
  methods: {
    resetForm() {
      this.email = "";
      this.password = "";
    },
    userLogin() {
      axios({
        method: "post",
        url: this.$axios_url,
        data: {
          email: this.email,
          password: this.password,
          action: "user_login"
        }
      })
        .then(res => {
          if (res.data.err) {
            this.resetForm();
            this.msg = res.data.msg;
          } else {
            localStorage.setItem('user_token', res.data.token);
            localStorage.setItem('user_email', res.data.email);
            localStorage.setItem('user_session', true);
            this.$router.push("dashboard");
          }
        })
        .catch(err => {
          this.msg = err;
        });
    }
  }
};
</script>

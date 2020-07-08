<template>
  <div class="container auth">
    <div>
      <form action="signup" method="post">
        <fieldset>
          <ul>
            <li>
              <label for="email">E-mail</label>
              <input
                type="email"
                placeholder="example@something.com"
                name="email"
                v-model="email"
              />
            </li>

            <li>
              <label for="password">Password</label>
              <input
                type="password"
                placeholder="**********"
                name="password"
                v-model="password"
              />
            </li>

            <li>
              <label for="cpassword">Confirm Password</label>
              <input
                type="password"
                placeholder="**********"
                name="cpassword"
                v-model="cpassword"
              />
            </li>
          </ul>
        </fieldset>
        <fieldset>
          <input type="submit" value="Signup" @click.prevent="userSignUp()" />
        </fieldset>
      </form>
      <div id="msg">
        <p>{{ msg }}</p>
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
      msg: "",
      email: "",
      password: "",
      cpassword: ""
    };
  },
  methods: {
    resetForm() {
      this.email = "";
      this.password = "";
      this.cpassword = "";
    },
    userSignUp() {
      axios({
        method: "post",
        url: this.$axios_url,
        data: {
          email: this.email,
          password: this.password,
          cpassword: this.cpassword,
          action: "user_signup"
        }
      })
        .then(res => {
          this.resetForm();
          if (res.data.err) {
            this.msg = res.data.msg;
          } else {
            this.msg =
              "Signup successful! Please follow the link in your email to verify your account";
          }
        })
        .catch(err => {
          this.msg = err;
        });
    }
  }
};
</script>

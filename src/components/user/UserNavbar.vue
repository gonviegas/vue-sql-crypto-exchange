<template>
  <div id="nav-bar">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
      <div class="container">
        <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#navbarResponsive"
          aria-controls="navbarResponsive"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav">
            <li class="nav-item active"></li>
            <li class="nav-item">
              <router-link class="nav-bar" to="/user/dashboard">
                <li>Dashboard</li>
              </router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-bar" to="/user/trade">
                <li>Buy/Sell</li>
              </router-link>
            </li>

            <li class="nav-item">
              <router-link class="nav-bar" to="/user/wallet">
                <li>Wallet</li>
              </router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-bar" to="/user/account">
                <li>Account</li>
              </router-link>
            </li>
            <li class="nav-item">
              <a href="#" v-on:click.prevent="logOut()">Log Out</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Page Content -->
    <div class="container">
      <h1 class="mt-4"></h1>
      <p></p>
    </div>
    <ul></ul>
  </div>
</template>

<script>
export default {
  name: "UserNavbar",
  methods: {
    logOut(){
      localStorage.removeItem('user_token');
      localStorage.removeItem('user_email');
      localStorage.setItem('user_session', false);
      this.$router.push("/user/login");
    }
  }
};
</script>

<style scoped lang="scss">
.nav-item {
  text-decoration: none;
  font-family: sans-serif;
  padding: 5px 15px 5px 0px;

  .active {
    padding: 5px 15px 5px 15px;
  }
  a {
    color: lightgrey !important;
    text-decoration: none !important;
    font-family: sans-serif !important;
    
    &:hover {
      text-decoration: none;
      color: #00b728 !important;
    }
  }
  li {
    color: lightgrey;
    padding: 5px;

    &:hover {
      color: #00b728;
    }
  }
}
</style>

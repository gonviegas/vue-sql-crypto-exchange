<template>
  <div id="nav-bar">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
      <div class="container">
        <router-link class="nav-link" to="/">CRYPTO EXCHANGE
        </router-link>
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
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active"></li>
            <li class="nav-item">
              <router-link class="nav-link" to="/news">
                <li>News</li>
              </router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-link" to="/market">
                <li>Market</li>
              </router-link>
            </li>

            <li class="nav-item">
              <router-link class="nav-link" to="/user/login">
                <li>Login</li>
              </router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-link" to="/user/signup">
                <li>Sign Up</li>
              </router-link>
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
  name: "HomeNavBar"
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped lang="scss">

</style>

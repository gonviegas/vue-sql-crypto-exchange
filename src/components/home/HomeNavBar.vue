<template>
  <div id="nav-bar">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
      <div class="container">
        <a class="navbar-brand" href="#">
          <img src="http://placehold.it/150x50?text=Logo" alt="" />
        </a>
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
            <li class="nav-item active">
              <router-link class="nav-link" to="/"
                ><li>Home</li>
                <span class="sr-only">(current)</span>
              </router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-link" to="/user/login"
                ><li>Login</li></router-link
              >
            </li>
            <li class="nav-item">
              <router-link class="nav-link" to="/user/signup"
                ><li>Sign Up</li></router-link
              >
            </li>
            <li class="nav-item">
              <router-link class="nav-link" to="/admin/login"
                ><li>Admin</li></router-link
              >
            </li>
            <li class="nav-item">
              <router-link class="nav-link" to="/admin/dashboard"
                ><li>Admin Dashboard</li></router-link
              >
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
<style scoped lang="scss"></style>

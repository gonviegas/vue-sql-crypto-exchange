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
              <router-link class="nav-bar" to="/front/dashboard">
                <li>Dashboard</li>
              </router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-bar" to="/front/customers">
                <li>Customers</li>
              </router-link>
            </li>

            <li class="nav-item">
              <router-link class="nav-bar" to="/front/wallets">
                <li>Wallets</li>
              </router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-bar" to="/front/store-wallet">
                <li>Store Wallet</li>
              </router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-bar" to="/front/staff">
                <li>Staff</li>
              </router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-bar" to="/staff">
                <li>Log Out</li>
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
  name: "FrontNavbar"
};
</script>

<style lang="scss" scoped>
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

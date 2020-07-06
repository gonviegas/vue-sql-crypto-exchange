<template>
  <div id="nav-bar">
    <ul>
      <router-link class="" to="/front/dashboard">
        <li>Dashboard</li>
      </router-link>

      <router-link class="" to="/front/customers">
        <li>Customers</li>
      </router-link>

      <router-link class="" to="/front/wallets">
        <li>Wallets</li>
      </router-link>

      <router-link class="" to="/front/transfers">
        <li>Transfers</li>
      </router-link>

      <router-link class="" to="/front/store-wallet">
        <li>Store Wallet</li>
      </router-link>

      <router-link class="" to="/front/staff">
        <li>Staff</li>
      </router-link>

      <router-link class="" to="/staff">
        <li>Log Out</li>
      </router-link>
    </ul>
  </div>
</template>

<script>
export default {
  name: "FrontNavbar"
};
</script>

<style lang="scss" scoped>
#nav-bar {
  display: flex;
  width: 100%;
  margin-bottom: 50px;
  ul {
    display: flex;
    list-style: none;
    padding: 0;
    margin: 0 20px 0 0;
    li {
      font-size: 2rem;
      padding: 2px 10px;
      cursor: pointer;

      &:hover {
        color: #009e0d;
      }
    }
  }
}
</style>

<template>
  <div id="nav-bar">
    <ul>
      <router-link class="" to="/admin/dashboard">
        <li>Dashboard</li>
      </router-link>

      <router-link class="" to="/admin/customers">
        <li>Customers</li>
      </router-link>

      <router-link class="" to="/admin/wallets">
        <li>Wallets</li>
      </router-link>

      <router-link class="" to="/admin/store-wallet">
        <li>Store Wallet</li>
      </router-link>

      <router-link class="" to="/admin/staff">
        <li>Staff</li>
      </router-link>

      <router-link class="" to="/admin/news">
        <li>News</li>
      </router-link>

      <router-link class="" to="/staff">
        <li>Log Out</li>
      </router-link>
    </ul>
  </div>
</template>

<script>
export default {
  name: "AdminNavbar"
};
</script>

<style lang="scss">
// #nav-bar {
//   display: flex;
//   width: 100%;
//   margin-bottom: 50px;
//   ul {
//     display: flex;
//     list-style: none;
//     padding: 0;
//     margin: 0 20px 0 0;
//     li {
//       font-size: 2rem;
//       padding: 2px 10px;
//       cursor: pointer;

//       &:hover {
//         color: #009e0d;
//       }
//     }
//   }
// }
</style>

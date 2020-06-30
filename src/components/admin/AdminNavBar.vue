<template>
  <div id="nav-bar">
    <ul>
      <router-link to="/admin/dashboard"><li>Dashboard</li></router-link>
      <router-link to="/admin/dashboard/users"><li>Users</li></router-link>
    </ul>
  </div>
</template>

<script>
export default {};
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

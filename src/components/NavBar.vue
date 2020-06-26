<template>
  <div id="nav-bar">
    <ul>
      <router-link to="/"><li>Home</li></router-link>
      <router-link to="/news"><li>News</li></router-link>
      <router-link to="/login"><li>Login</li></router-link>
      <router-link to="/signup"><li>Sign Up</li></router-link>
    </ul>
  </div>
</template>

<script>
export default {
  name: "NavBar"
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped lang="scss">
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
        color: #7ca971;
      }
    }
  }
}
</style>

<template>
  <div class="home">
    <HomeNavBar />
    <h1>AUTH PAGE</h1>
    <router-view />
  </div>
</template>

<script>
// @ is an alias to /src
import HomeNavBar from "@/components/home/HomeNavBar.vue";

export default {
  name: "Auth",
  components: {
    HomeNavBar
  }
};
</script>

<style lang="scss">
.container {
  display: grid;
  gap: 16px;
  grid-template-columns: 160px 1fr;
  margin: 0 auto;
  padding: 0 16px;
  width: 100%;

  &.auth {
    grid-template-columns: 1fr;
    max-width: 500px;
  }
}

form {
  margin-bottom: 32px;;
  text-align: left;
  width: 100%;

  &.auth {
    border-radius: 16px;
    padding: 32px;
    margin: 32px auto;
    box-shadow: 0 0 10px rgba(0, 0, 0, .1);
    max-width: 500px;
  }

  ul {
    margin: 0;
    padding: 0;
  }

  li {
    display: flex;
    flex-direction: column;
    padding: 8px 0;
  }
}

fieldset {
  border: 0;
  padding: 0;
}

label {
  color: #666;
  font-size: 1.2rem;
  font-weight: 900;
  padding: 4px 0;
  text-transform: uppercase;
}

button,
input,
select,
textarea {
  border-radius: 2px;
  border: 1px solid #CCC;
  padding: 8px;
  outline: none;
  transition: border .2s ease-in-out, box-shadow .2s ease-in-out;

  &:focus {
    border: 1px solid #18a4e0;
    box-shadow: 0 0 10px rgba(#18a4e0, .25);
    transition: border .2s ease-in-out, box-shadow .2s ease-in-out;
  }
}

input[type=submit] {
  align-items: center;
  background-color: #18a4e0;
  border: 0;
  color: #fff;
  display: flex;
  font-weight: 900;
  padding: 8px 12px;
}
</style>

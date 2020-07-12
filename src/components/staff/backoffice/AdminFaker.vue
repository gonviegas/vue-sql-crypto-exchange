<template>
  <div>
      <div class="col-md-6" align="right">
      <button type="submit" class="btn btn-dark" v-on:click.prevent="Faker()">ACTIVATE FAKER</button>
      </div>
  </div>
</template>

<script>

import axios from "axios";

export default {
    name: "AdminFaker",
    methods: {
    Faker() {
      axios({
        method: "post",
        url: "http://localhost/api/faker.php",
      }).catch(res => {
        res.data = "FAKER ACTIVATED";
        alert(res.data);
      });
    },
  }
}
</script>

<style>

</style>
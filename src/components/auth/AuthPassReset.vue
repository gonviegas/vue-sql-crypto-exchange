<template>
  <div class="container auth">
    <form action="reset.php" method="post">
      <fieldset>
        <ul>
          <li>
            <label for="email">E-mail</label>
            <input type="text" name="email" />
          </li>
        </ul>
      </fieldset>
      <fieldset>
        <input type="submit" value="Reset" />
      </fieldset>
    </form>
  </div>
</template>

<script>
export default {
  name: "AuthPassReset"
};
</script>

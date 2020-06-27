<template>
  <div class="container auth">
    <div>
      <form action="signin.php" method="post">
        <fieldset>
          <ul>
            <li>
              <label for="email">E-mail</label>
              <input type="text" name="email" />
            </li>

            <li>
              <label for="password">Password</label>
              <input type="password" name="password" />
            </li>
          </ul>
        </fieldset>
        <fieldset>
          <input type="submit" value="Signin" />
        </fieldset>
      </form>
      <router-link to="/auth/reset"><li>Forgot your password?</li></router-link>
    </div>
  </div>
</template>

<script>
export default {
  name: "AuthLogin"
};
</script>

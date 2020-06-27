<template>
  <div class="container auth">
    <div>
      <form action="signup.php" method="post">
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

            <li>
              <label for="cpassword">Confirm Password</label>
              <input type="password" name="cpassword" />
            </li>
          </ul>
        </fieldset>
        <fieldset>
          <input type="submit" value="Signup" />
        </fieldset>
      </form>
      
    </div>
  </div>
</template>

<script>
export default {
  name: "AuthSignUp"
};
</script>

<?php require 'header.php'; ?>

  <main>
    <div class="main_content">
      <h1>Register</h1>
        <form action="index.php">
          <h2>Name:</h2>
          <input name="name">
          <h2>Username:</h2>
          <input name="username">
          <h2>Password:</h2>
          <input type="password" name="user_password">
          <h2>Confirmation Password:</h2>
          <input type="password" name="conf_password">
          <input type="submit" value="Register">
        </form>
    </div>
  </main>

<?php require 'footer.php'; ?>

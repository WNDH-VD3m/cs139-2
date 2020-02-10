<?php require 'header.php'; ?>
  <main>
    <h1>Main Page</h1>
    <ul>
      <li>Display the lists here</li>
    </ul>
    <?php
      if (isset($_SESSION['userID'])) {
        echo '<h1>logged in</h1>';
      }
      else {
        echo '<h1>logged out</h1>';
      }
     ?>
    <h2>You will see this page after you have signed into the system</h2>
    <p>The page will be used for displaying current lists</p>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
      labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
      nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit
      esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt
      in culpa qui officia deserunt mollit anim id est laborum.</p>
  </main>
<?php require 'footer.php'; ?>

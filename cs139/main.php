<?php require 'header.php'; ?>
  <main>
    <h1>Main Page</h1>
    <?php
      if (isset($_SESSION['userID'])) {
        include('list.php');
      }
      else {
        echo '<h1>hi your logged out</h1>';
      } ?>
  </main>
<?php require 'footer.php'; ?>

<?php require 'header.php'; ?>
  <main>
    <h1>Main Page</h1>
    <ul>
      <li>Display the lists here</li>
    </ul>
    <?php
      if (isset($_SESSION['userID'])) {
        include('list.php');
      }
      else {
        echo '<h1>hi your logged out</h1>';
      } ?>
  </main>
<?php require 'footer.php'; ?>

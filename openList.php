<?php require 'header.php';
include "security.php";
$listID = $_POST['listID'];
?>
<main>
<form action="addItem.php" method="post">
  <input type="hidden" name="listID" value="<?php echo "$listID"; ?>">
  <input type="text" name="content">
  <button type="submit" name="button">add new item</button>
</form>
<form class="" action="index.php" method="post">
  <button type="submit" name="button">Back</button>
</form>
<?php
//$listID = $_POST['listID'];
$db = new SQLite3('todo.db');
if ($listID != null) {
  $statement = $db->prepare('SELECT * FROM ListItems WHERE ListID = :id;');
  $statement->bindValue(':id', $listID, SQLITE3_INTEGER);

  $result = $statement->execute();
  while ($row = $result->fetchArray()) {
    echo (h($row['Content']) . "<br>");
  }
}
$db->close();
?>
</main>
<?php require 'footer.php'; ?>

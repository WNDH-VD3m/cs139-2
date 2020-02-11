<?php require 'header.php';
$listID = $_POST['listID'];
?>
<main>
<form action="addItem.php" method="post">
  <input type="hidden" name="listID" value="<?php echo "$listID"; ?>">
  <input type="text" name="content">
  <button type="submit" name="button">add new item</button>
</form>
<?php
//$listID = $_POST['listID'];
$db = new SQLite3('todo.db');
if ($listID != null) {
  $statement = $db->prepare('SELECT * FROM ListItems WHERE ListID = :id;');
  $statement->bindValue(':id', $listID);

  $result = $statement->execute();
  while ($row = $result->fetchArray()) {
    echo "{$row['Content']} <br>";
  }
}
$db->close();
?>
</main>
<?php require 'footer.php'; ?>

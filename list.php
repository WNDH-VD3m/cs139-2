<h1>You are logged in</h1>
<form action="newList.php" method="post">
  <input type="text" name="name" placeholder="List name...">
  <button type="submit" name="create">Create New List</button>
</form>

<?php
$username = $_SESSION['userID'];
$db = new SQLite3('todo.db');
$statement = $db->prepare('SELECT * FROM List WHERE UserID = :id;');
$statement->bindValue(':id', $username);

$result = $statement->execute();
while ($row = $result->fetchArray()) {
  echo "<form method='post' action='openList.php'>
  <input type='hidden' name='listName' value='{$row['Name']}'>
  <button type='submit' name='open'>{$row['Name']}</button>
  </form>";
}
 ?>

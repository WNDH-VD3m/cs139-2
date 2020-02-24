form action="newList.php" method="post">
  <input type="text" name="name" placeholder="List name...">
  <button type="submit" name="create">Create New List</button>
</form>

<?php
include 'security.php';
$username = $_SESSION['userID'];
$db = new SQLite3('todo.db');
$statement = $db->prepare('SELECT * FROM List WHERE UserID = :id;');
$statement->bindValue(':id', $username, SQLITE3_INTEGER);
$result = $statement->execute();
while ($row = $result->fetchArray()) {
  $name = h($row['Name']);
  echo "<form method='post' action='openList.php'>
  <input type='hidden' name='listID' value='{$row['ListID']}'>
  <p>List:
  <button type='submit' name='open'>$name</button></p>
  </form>";
}
 ?>

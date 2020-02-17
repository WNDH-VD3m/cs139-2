<?php
$name = $_POST['name'];
$db = new SQLite3('todo.db');
session_start();
$user =  $_SESSION['userID'];
$date = date("Y/m/d");

$statement = $db->prepare('SELECT * FROM List WHERE UserID = :id;');
$statement->bindValue(':id', $user);
$result = $statement->execute();
while ($row = $result->fetchArray()) {
  if ($row['Name'] == $name){
    header("Location: index.php?list=in_use");
    exit();
  }
}
if ($name != null) {
  $db->exec("INSERT INTO List(UserID, Name, DateCreated) Values('$user', '$name', '$date')");
  header("Location: index.php?newlist=success");
}

else {
  header("Location: index.php?newlist=unsuccess");
}

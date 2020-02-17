<?php
$name = $_POST['name'];
$db = new SQLite3('todo.db');
session_start();
$user =  $_SESSION['userID'];
$date = date("Y/m/d");
if ($name != null) {
  $db->exec("INSERT INTO List(UserID, Name, DateCreated) Values('$user', '$name', '$date')");
  header("Location: index.php?newlist=success");
}
else {
  header("Location: index.php?newlist=unsuccess");
}

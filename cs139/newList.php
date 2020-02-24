<?php
include 'security.php';
$name = $_POST['name'];
$db = new SQLite3('todo.db');
session_start();
$user =  $_SESSION['userID'];
$date = date("Y/m/d");

$statement = $db->prepare('SELECT * FROM List WHERE UserID = :id;');
$statement->bindValue(':id', $user, SQLITE3_INTEGER);
$result = $statement->execute();
while ($row = $result->fetchArray()) {
  if ($row['Name'] == $name){
    header("Location: index.php?list=in_use");
    exit();
  }
}
if ($name != null) {
  $statement = $db->prepare("INSERT INTO List(UserID, Name, DateCreated) Values(:userid, :name, :date_now)");
  $statement->bindValue(':userid', h($user), SQLITE3_INTEGER);
  $statement->bindValue(':name', h($name), SQLITE3_TEXT);
  $statement->bindValue(':date_now', $date, SQLITE3_DATE);
  $results = $statement->execute();
  header("Location: main.php?newlist=success");
}

else {
  header("Location: main.php?newlist=unsuccess");
}

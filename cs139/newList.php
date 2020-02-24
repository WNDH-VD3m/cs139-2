<?php
$name = $_POST['name'];
$db = new SQLite3('todo.db');
session_start();
$user =  $_SESSION['userID'];
$date = date("Y/m/d");
echo "$user";
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
  $statement->bindValue(':userid', $user);
  $statement->bindValue(':name', $name, SQLITE3_TEXT);
  $statement->bindValue(':date_now', $date);
  $results = $statement->execute();
  header("Location: index.php?newlist=success");
}

else {
  header("Location: index.php?newlist=unsuccess");
}

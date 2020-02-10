<?php
if (isset($_POST['login-submit'])){
  $username = $_POST['username'];
  $password = $_POST['pwd'];

  if(empty($username) || empty($password)){
    header("Location: main.php?error=emptyfields");
    exit();
  }
  else {
    $db = new SQLite3('todo.db');
    $statement = $db->prepare('SELECT * FROM User WHERE UidUsers = :id;');
    $statement->bindValue(':id', $username);

    $result = $statement->execute();
    while ($row = $result->fetchArray()) {
      $username = "{$row['Password']}";
    }
    if ($result == $username) {
      echo $result;
      echo $username;
      //header("Location: main.php?error=nonusername");
    }
    else {
      $sql = $db->prepare('SELECT Password FROM User WHERE UidUsers=:uname;');
      $sql->bindValue(':uname', $username);
      $result = $db->exec($sql);
      if($result == $password){
        session_start();
        $_SESSION['userID'] = $username;
        echo $username;
      }
      else {
        header("Location: main.php?error=wrongpassword");
      }
    }

  }
}

else {
  header("Location: main.php");
}

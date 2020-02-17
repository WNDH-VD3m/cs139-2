<?php
if (isset($_POST['login-submit'])){
  $username = $_POST['username'];
  $password = $_POST['pwd'];

  if(empty($username) || empty($password)){
    header("Location: index.php?error=emptyfields");
    exit();
  }
  else {
    $db = new SQLite3('todo.db');
    $statement = $db->prepare('SELECT * FROM User WHERE UidUsers = :id;');
    $statement->bindValue(':id', $username);

    $result = $statement->execute();
    while ($row = $result->fetchArray()) {
      $username = "{$row['UidUsers']}";
      $name = "{$row['Name']}";
    }
    if ($result == $username) {
      //echo $result;
      //echo $username;
      header("Location: index.php?error=nonusername");
    }
    else {
      $sql = $db->prepare('SELECT Password, Salt FROM User WHERE UidUsers=:uname;');
      $sql->bindValue(':uname', $username);
      $result = $sql->execute();
      while ($row = $result->fetchArray()) {
        $dbpassword = "{$row['Password']}";
        $salt = "{$row['Salt']}";
      }
      if($dbpassword == sha1($salt."--".$password)){
        session_start();
        $_SESSION['userID'] = $username;
        $_SESSION['userName'] = $name;
        header("Location: index.php?done=success");
      }
      else {
        header("Location: index.php?error=wrongpassword");
      }
    }

  }
  $db->close();
}

else {
  header("Location: index.php?error");
}

<?php
if (isset($_POST['signup-submit'])) {
  //require 'dbhandling.inc.php';

  $name = $_POST['name'];
  $username = $_POST['username'];
  $mail = $_POST['mail'];
  $pwd = $_POST['pwd'];
  $pwdRepeat = $_POST['pwd-repeat'];

  if (empty($name) || empty($username) || empty($mail) || empty($pwd) || empty($pwdRepeat)) {
    header("Location: register.php?error=emptyfields&name=".$name."&username".$username."&mail=".$mail);
    exit();
  }
  /*else if (!filter_var($mail, FILTER_VALIDATE_MAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) {
    header("Location: ../register.php?error=invalidmailuid&name=".$name);
  }
  else if (!filter_var($mail, FILTER_VALIDATE_MAIL)) {
    header("Location: ../register.php?error=invalidmail&name=".$name."&username".$username);
    exit();
  }*/
  else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
    header("Location: register.php?error=invalidusername&name=".$name."&mail".$mail);
    exit();
  }
  elseif ($pwd !== $pwdRepeat) {
    header("Location: register.php?error=passwordchk&name=".$name."&username".$username."&mail=".$mail);
    exit();
  }
  else {
    $db = new SQLite3('todo.db');

    $sql = $db->prepare('SELECT UidUsers FROM User WHERE UidUsers = :uname;');
    $sql->bindValue(':uname', $username);
    $result = $db->exec($sql);
    if ($result !== null) {
      header("Location: register.php?error=sqllerror&name=".$name."&mail=".$mail);
      exit();
    }
    else {
      $db->exec("INSERT INTO User(Name, Email, UidUsers, Password) Values('$name', '$mail', '$username', '$pwd')");
      echo $name;
      //header("Location: register.php?error=non");
    }
  }
}
?>

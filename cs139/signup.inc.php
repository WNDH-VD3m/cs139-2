<?php
include 'security.php';
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
    $sql->bindValue(':uname', h($username), SQLITE3_TEXT);
    $result = $sql->execute();
    $usr = "0";
    while ($row = $result->fetchArray()) {
      $usr = "{$row['UidUsers']}";
    }
    if ($usr !== "0"){
      header("Location: index.php?usrnameinuse");
      exit();
    }
    else {
      $salt = sha1(time());
      $encrypted_password = sha1($salt."--".$pwd);
      $stmt = $db->prepare("INSERT INTO User(Name, Email, UidUsers, Password, Salt) Values(:name, :mail, :uname, :e_pwd, :salt)");
      $stmt->bindValue(':name', h($name), SQLITE3_TEXT);
      $stmt->bindValue(':mail', h($mail), SQLITE3_TEXT);
      $stmt->bindValue(':uname', h($username), SQLITE3_TEXT);
      $stmt->bindValue(':e_pwd', $encrypted_password, SQLITE3_TEXT);
      $stmt->bindValue(':salt', $salt, SQLITE3_TEXT);
      $results = $stmt->execute();
      ?>
      <form name="login" action="login.inc.php" method="post">
        <input type='hidden' name='username' value='<?php echo "$username" ?>'>
        <input type='hidden' name='pwd' value='<?php echo "$pwd" ?>'>
        <input type="hidden" name="login-submit" value="true">
      </form>
      <script type="text/javascript">
        document.login.submit();
      </script>
    <?php  exit();
    }
  }
  $db->close();
}

else{
  header("Location: register.php");
}

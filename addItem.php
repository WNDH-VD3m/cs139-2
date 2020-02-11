<?php
$content = $_POST['content'];
$listID = $_POST['listID'];
$db = new SQLite3('todo.db');
if ($content != null) {
  $db->exec("INSERT INTO ListItems(ListID, Content, Done) Values('$listID', '$content', 'No')");
  header("Location: main.php?newitem=success");
}
else {
  header("Location: main.php?newitem=unsuccess");
}

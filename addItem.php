<?php
$content = $_POST['content'];
$listID = $_POST['listID'];
$db = new SQLite3('todo.db');
if ($content != null) {
  $db->exec("INSERT INTO ListItems(ListID, Content, Done) Values('$listID', '$content', 'No')");
  ?>
  <form name="back" action="openList.php" method="post">
    <input type='hidden' name='listID' value='<?php echo "$listID" ?>'>
  </form>
  <script type="text/javascript">
    document.back.submit();
  </script>
<?php }
else {
  header("Location: index.php?newitem=unsuccess");
}

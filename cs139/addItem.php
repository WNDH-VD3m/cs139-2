<?php
$content = $_POST['content'];
$listID = $_POST['listID'];
$db = new SQLite3('todo.db');
if ($content != null) {
  $stmt = $db->prepare("INSERT INTO ListItems(ListID, Content, Done) Values(:listID, :content, 'No')");
  $stmt->bindValue(':listID', $listID, SQLITE3_INTEGER); // Step 3
  $stmt->bindValue(':content', $content, SQLITE3_TEXT); // Step 3
  $results = $stmt->execute();
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

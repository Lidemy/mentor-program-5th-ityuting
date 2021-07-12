<?php
  require_once("conn.php");

  if (
    empty($_POST['nickname']) ||
    empty($_POST['comment'])
  ) {
    header('Location: index.php?errnum=1');
    die('資料不齊全');
  }

  $nickname = $_POST['nickname'];
  $comment = $_POST['comment'];

  $sql = sprintf(
    "INSERT INTO yuting_comments(nickname, comment) 
    VALUES('%s', '%s')", 
    $nickname, 
    $comment
  );
  $result = $conn->query($sql);
  if (!$result) {
    die($conn->error);
  }

  header('Location: index.php');
?>

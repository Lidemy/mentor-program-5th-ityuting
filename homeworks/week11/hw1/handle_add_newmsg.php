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
  $account = $_POST['account'];

  $sql = "INSERT INTO yuting_comments(registers_account, nickname, comment) VALUES(?, ?, ?)"; 
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("sss", $account, $nickname, $comment);
  $result = $stmt->execute();
  if (!$result) {
    die($conn->error);
  }

  $result = $stmt->get_result();
  if (!($result->num_rows === 0)) {
    header('Location: index.php');
  }
?>

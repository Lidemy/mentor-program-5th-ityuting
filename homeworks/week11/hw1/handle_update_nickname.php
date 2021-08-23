<?php
  require_once("conn.php");
  session_start();

  if (empty($_POST['nickname'])) {
    die(header('Location: index.php?errnum=2'));
  }

  $nickname = $_POST['nickname'];
  $account = $_SESSION['account'];

  $sql = "UPDATE yuting_registers SET nickname=? WHERE account=?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ss", $nickname, $account);
  $result = $stmt->execute();
  if (!$result) {
    die($conn->error);
  }

  $result = $stmt->get_result();
  if (!($result->num_rows === 0)) {
    header('Location: index.php');
  }
?>

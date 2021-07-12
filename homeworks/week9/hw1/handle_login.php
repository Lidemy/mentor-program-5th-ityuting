<?php
  session_start();
  require_once("conn.php");

  if (
    empty($_POST['account']) ||
    empty($_POST['password'])
  ) {
    die(header('Location: login.php?errCode=1'));
  }

  $account = $_POST['account'];
  $password = $_POST['password'];
  $sql = sprintf(
    "SELECT * FROM yuting_registers WHERE account = '%s' and password = '%s'",
    $account,
    $password
  );
  $result = $conn->query($sql);
  
  if ($result->num_rows) {
    // 登入成功
    $_SESSION['account'] = $account;
    header('Location: index.php');
  } else {
    // 登入失敗
    die(header('Location: login.php?errCode=2'));
  }
?>

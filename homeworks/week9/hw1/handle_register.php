<?php
  require_once("conn.php");

  if (
    empty($_POST['nickname']) ||
    empty($_POST['account']) ||
    empty($_POST['password'])
  ) {
    die(header('Location: register.php?errCode=1'));
  }

  $nickname = $_POST['nickname'];
  $account = $_POST['account'];
  $password = $_POST['password'];

  $sql = sprintf(
    "INSERT INTO yuting_registers(nickname, account, password) 
    VALUES('%s', '%s', '%s')", 
    $nickname, 
    $account,
    $password 
  );
  $result = $conn->query($sql);
  if (!$result) {
    $code = $conn->errno;
    if ($code === 1062) {
      die(header('Location: register.php?errCode=2'));
    }
    die($conn->error);
  }

  header('Location: index.php');
?>

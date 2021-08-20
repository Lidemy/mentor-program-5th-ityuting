<?php
  require_once("conn.php");
  session_start();

  if (
    empty($_POST['nickname']) ||
    empty($_POST['account']) ||
    empty($_POST['password'])
  ) {
    die(header('Location: register.php?errCode=1'));
  }

  $nickname = $_POST['nickname'];
  $account = $_POST['account'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

  $sql = "INSERT INTO yuting_registers(nickname, account, password) VALUES(?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("sss", $nickname, $account, $password);
  $result = $stmt->execute();
  
  if (!$result) {
    if ($conn->errno === 1062) {
      die(header('Location: register.php?errCode=2'));
    }
  }
  
  $result = $stmt->get_result();
  if($result->num_rows === 0) {
    header('Location: register.php?errCode=2');
  } else {
    $_SESSION['account'] = $account;
    header('Location: index.php');
  }
?>

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
  $sql = "SELECT * FROM yuting_registers WHERE account=?";

  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $account);
  $result = $stmt->execute();
  if (!$result) {
    print_r($result);
    die($conn->error);
  }

  // 有沒有這個帳號
  $result = $stmt->get_result();
  if ($result->num_rows === 0) {
    die(header('Location: login.php?errCode=2'));
  }

  // 看密碼對不對
  $row = $result->fetch_assoc();
  if (password_verify($password, $row['password'])) {
    // 登入成功
    $_SESSION['account'] = $account;
    header('Location: index.php');
  } else {
    // 登入失敗
    die(header('Location: login.php?errCode=2'));
  }
?>

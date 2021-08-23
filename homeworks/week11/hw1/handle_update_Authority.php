<?php
  require_once("conn.php");
  require_once("utils.php");
  session_start();

  if (empty($_GET['id']) || empty($_POST['role']) || $_POST['role'] === '修改此帳號權限') {
    die(header('Location: management_system.php?errnum=1'));
  }

  $account = $_SESSION['account'];
  $data = getUsernameFromSession($account);
  $admin = $data['role'];

  if ($admin !== '2') {
    die(header('Location: management_system.php?errnum=2'));
  }

  $id = $_GET['id'];
  $role = NULL;
  if ($_POST['role'] === '遭停權的使用者') {
    $role = '0';
  }
  if ($_POST['role'] === '一般使用者') {
    $role = '1';
  }
  if ($_POST['role'] === '管理者') {
    $role = '2';
  }
  
  $sql = "UPDATE yuting_registers SET role=? WHERE id=?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("si", $role, $id);

  $result = $stmt->execute();
  if (!$result) {
    die(header('Location: management_system.php?errnum=3'));
  }

  $result = $stmt->get_result();
  if (!($result->num_rows === 0)) {
    die(header('Location: management_system.php'));
  }
?>

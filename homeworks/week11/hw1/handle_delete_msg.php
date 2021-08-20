<?php
  require_once("conn.php");
  require_once("utils.php");
  session_start();

  if (empty($_GET['id'])) {
    die(header('Location: index.php?errnum=1'));
  }

  $id = $_GET['id'];
  $account = $_SESSION['account'];
  $data = getUsernameFromSession($account);
  $role = $data['role'];

  if ($role === '2'){
    $sql = "UPDATE yuting_comments SET is_deleted = 1 WHERE id = ?";
  } else {
    $sql = "UPDATE yuting_comments SET is_deleted = 1 WHERE id = ? and registers_account = ?";
  }
  
  $stmt = $conn->prepare($sql);
  if ($role === '2') {
    $stmt->bind_param("i", $id);
  } else {
    $stmt->bind_param("is", $id, $account);
  }
  $result = $stmt->execute();
  if (!$result) {
    die($conn->error);
  }

  $result = $stmt->get_result();
  if (!($result->num_rows === 0)) {
    header('Location: index.php');
  }
?>

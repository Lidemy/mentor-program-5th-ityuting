<?php
  require_once("conn.php");
  require_once("utils.php");
  session_start();

  if (empty($_POST['comment'])) {
    die(header('Location: update_msg?id='.$_POST['id'].'&errnum=1'));
  }

  $nickname = $_POST['nickname'];
  $comment = $_POST['comment'];
  $id = $_POST['id'];
  $account = $_SESSION['account'];
  $data = getUsernameFromSession($account);
  $role = $data['role'];
  
  if ($role === '2') {
    $sql = "UPDATE yuting_comments SET comment=? WHERE id=?";
  } else {
    $sql = "UPDATE yuting_comments SET comment=? WHERE id=? and registers_account=?";
  }

  $stmt = $conn->prepare($sql);

  if ($role === '2') {
    $stmt->bind_param("si", $comment, $id);
  } else {
    $stmt->bind_param("sis", $comment, $id, $account);
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

<?php
  require_once("blog_conn.php");
  require_once("blog_utils.php");
  session_start();

  isAdmin($_SESSION['username']);

  if (empty($_GET['id'])) {
    die(header('Location: blog_admin.php?errNum=1'));
  }

  $id = $_GET['id'];
  $is_deleted = $_GET['is_deleted'];
  if ($is_deleted === 'yes') {
    $sql = "UPDATE yuting_blog_articles SET is_deleted='yes' WHERE id=?";
  } else {
    $sql = "UPDATE yuting_blog_articles SET is_deleted='no' WHERE id=?";
  }
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $id);
  $result = $stmt->execute();
  if (!$result) {
    die(header('Location: blog_admin.php?errNum=2'));
  }
  
  $result = $stmt->get_result();
  if ($result->num_rows !== 0 && $is_deleted === 'yes') {
    die(header('Location: blog_admin.php?errNum=3'));
  }
  die(header('Location: blog_admin.php?errNum=4'));
?>

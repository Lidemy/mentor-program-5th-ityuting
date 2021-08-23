<?php
  session_start();
  require_once("blog_conn.php");
  require_once("blog_utils.php");

  isAdmin($_SESSION['username']);

  if (
    empty($_POST['id']) ||
    empty($_POST['title']) ||
    empty($_POST['class']) ||
    empty($_POST['content'])
  ) {
    die(header('Location: blog_edit.php?id='.$_POST['id'].'&errNum=1'));
  }

  $id = $_POST['id'];
  $title = $_POST['title'];
  $class = $_POST['class'];
  $content = $_POST['content'];

  $sql = "UPDATE yuting_blog_articles SET title=?, class=?, content=? WHERE id=?"; 
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("sssi", $title, $class, $content, $id);
  $result = $stmt->execute();
  if (!$result) {
    die(header('Location: blog_edit.php?id='.$_POST['id'].'&errNum=2'));
  }

  $result = $stmt->get_result();
  if (!($result->num_rows === 0)) {
    die(header('Location: blog_edit.php?id='.$_POST['id'].'&errNum=3'));
  }
?>

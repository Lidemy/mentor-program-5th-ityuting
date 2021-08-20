<?php
  session_start();
  require_once("blog_conn.php");
  require_once("blog_utils.php");

  isAdmin($_SESSION['username']);

  if (
    empty($_POST['title']) ||
    empty($_POST['class']) ||
    empty($_POST['content'])
  ) {
    die(header('Location: blog_append.php?errNum=1'));
  }

  $username = $_POST['username'];
  $title = $_POST['title'];
  $class = $_POST['class'];
  $content = $_POST['content'];

  $sql = "INSERT INTO yuting_blog_articles(username, title, class, content) VALUES(?, ?, ?, ?)"; 
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ssss", $username, $title, $class, $content);
  $result = $stmt->execute();
  if (!$result) {
    die(header('Location: blog_append.php?errNum=2'));
  }

  $result = $stmt->get_result();
  if (!($result->num_rows === 0)) {
    die(header('Location: blog_page.php'));
  }
?>

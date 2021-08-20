<?php
  session_start();
  require_once("blog_conn.php");

  if (
    empty($_POST['username']) ||
    empty($_POST['password'])
  ) {
    die(header('Location: blog_login.php?errNum=1'));
  }

  $username = $_POST['username'];
  $password = $_POST['password'];

  $sql = "SELECT * FROM yuting_blog_owners WHERE username = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $username);
  $result = $stmt->execute();
  if (!$result) {
    die(header('Location: blog_login.php?errNum=2'));
  }

  // 有沒有這個擁有者
  $result = $stmt->get_result();
  if ($result->num_rows === 0) {
    die(header('Location: blog_login.php?errNum=3'));
  }

  // 看密碼對不對
  // 有 hash 應該要用 password_verify($password, $row['password'])
  // 此處只是測試登入功能，因此使用 `$password === $row['password']`
  $row = $result->fetch_assoc();
  if ($password === $row['password']) {
    // 登入成功
    $_SESSION['username'] = $username;
    die(header('Location: blog_index.php'));
  }
  // 登入失敗
  die(header('Location: blog_login.php?errNum=3'));
?>

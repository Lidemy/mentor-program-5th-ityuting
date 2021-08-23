<?php
  function getRoleFromSession($username) {
    global $conn;
    $sql = sprintf(
      "SELECT * FROM yuting_blog_owners WHERE username = '%s'", 
      $username
    );
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row;
  }

  function escape($str) {
    return htmlspecialchars($str, ENT_QUOTES);
  }

  // 從 SESSION 拿到資料，判斷是訪客 or 管理者。
  function isAdmin($SESSION) {
    $username = '';
    if (!empty($SESSION)) { 
      $username = $SESSION;
    }
    $data = getRoleFromSession($username);
    $role = $data['role'];
    if ($role !== '管理者') {
      die(header('Location: blog_index.php'));
    }
  }
?>

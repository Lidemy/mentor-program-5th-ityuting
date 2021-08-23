<?php
  session_start();
  require_once("blog_conn.php");
  require_once("blog_utils.php");

  $sql = "SELECT * FROM yuting_blog_articles WHERE is_deleted='no' order by id desc";
  $result = $conn->query($sql);
  if (!$result) {
    die('Error:' . $conn->error);
  }

  // 從 SESSION 拿到資料，判斷是訪客 or 管理者。
  $username = '';
  if (!empty($_SESSION['username'])) { 
    $username = $_SESSION['username'];
    $data = getRoleFromSession($username);
  }
?>

<!DOCTYPE html>

<html>
<head>
  <meta charset="utf-8">
  <title>部落格__獨頁</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://necolas.github.io/normalize.css/8.0.1/normalize.css" />
  <link rel="stylesheet" href="stylesheet.css" type="text/css"/>
</head>
<body class="bug">
  <nav class="navbar">
  <div class="wrapper">
    <div class="navbar__siteName">
      Who's Blog
    </div>
    <div class="navbar__activeList">
      <ul class="activeList">
        <li><a href="blog_page.php">文章列表</a></li>
        <li><a href="#">分類專區</a></li>
        <li><a href="#">關於我</a></li>
      </ul>
      <ul class="activeList">
        <li><a href="blog_index.php">回到首頁</a></li>
        <?php
          if(empty($_SESSION['username'])) {
            echo '<li><a href="blog_login.php">登入</a></li>';
          } else {
            if ($data['role'] === '管理者') {
              echo '<li><a href="blog_append.php">新增文章</a></li>';
              echo '<li><a href="blog_admin.php">管理後臺</a></li>';
            }
            echo '<li><a href="handle_blog-logout.php">登出</a></li>';
          }
        ?>
      </ul>
    </div>
  </div>
  </nav>
  <section class="blogIntro">
    <div>
      <h1>存放晝夜之地</h1>
      <h3>Welcome to my blog</h3>
    </div>
  </section>
  <main class="blog_main">
    <?php
      while($row = $result->fetch_assoc()) {
    ?>
    <article class="perArticle">
      <div class="welcome">
        <div class="title"><?php echo escape($row['title']); ?></div>
        <div class="functionBtn">
        <?php
        if (!empty($_SESSION['username']) && $data['role'] === '管理者') {
          echo '<a class="edit btn" href="blog_edit.php?id='. escape($row['id']).'">編輯</a>';
        }?>
        </div>
      </div>
      <div class="time"><?php echo escape($row['created_at']) . ' ' . escape($row['class']); ?></div>
      <div class="wholeContent"><p><?php echo escape($row['content']); ?></p></div>
        <a class="btn">READ MORE</a>
    </article>
    <?php } ?>
  </main>
  <footer class="blogFooter">Copyright © 2021 Who's Blog All Rights Reserved.</footer>
</body>
</html>
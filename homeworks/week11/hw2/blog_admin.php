<?php
  session_start();
  require_once("blog_conn.php");
  require_once("blog_utils.php");

  isAdmin($_SESSION['username']);

  $sql = "SELECT * from yuting_blog_articles order by id desc";
  $result = $conn->query($sql);
  if ($conn->errno) {
    die('Error:' . $conn->error);
  }

  $sql = "SELECT * FROM yuting_blog_articles order by id desc";
  $result = $conn->query($sql);
  if (!$result) {
    die('Error:' . $conn->error);
  }

  $errNum = 0;
  if(isset($_GET['errNum'])) {
    $errNum = $_GET['errNum'];
  }
?>

<!DOCTYPE html>

<html>
<head>
  <meta charset="utf-8">
  <title>部落格_神秘後台</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://necolas.github.io/normalize.css/8.0.1/normalize.css" />
  <link rel="stylesheet" href="stylesheet.css" type="text/css"/>
  <script>
    var errNum = <?php echo $errNum;?>;
    document.addEventListener('DOMContentLoaded', function() {
      if (errNum === 1) {
        alert('此篇文章不存在。')
      }
      if (errNum === 2) {
        alert('操作發生錯誤，請稍後再次重試。')
      }
      if (errNum === 3) {
        alert('刪除成功。')
      }
      if (errNum === 4) {
        alert('復原成功')
      }
    })
  </script>
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
        <li><a href="blog_append.php">新增文章</a></li>
        <li><a href="handle_blog-logout.php">登出</a></li>
      </ul>
    </div>
  </div>
  </nav>
  <section class="blogIntro">
    <div>
      <h1>存放晝夜之地-後台</h1>
      <h3>Welcome to my blog</h3>
    </div>
  </section>
  <main class="blog_main">
    <?php
      while($row = $result->fetch_assoc()) {
    ?>
      <div class="perAdmin">
        <div class="title"><?php echo escape($row['title']);?></div>
        <div class="functionBtn">
          <span class="date"><?php echo escape($row['created_at']);?></span>
          <a class="edit btn" href="blog_edit.php?id=<?php echo escape($row['id']);?>">編輯</a>
          <?php
            if ($row['is_deleted'] === 'no') {
              echo '<a class="delete btn" href="handle_blog-delete.php?id='.escape($row['id']).'&is_deleted=yes">刪除</a>';
            } else {
              echo '<a class="delete btn" href="handle_blog-delete.php?id='.escape($row['id']).'&is_deleted=no">復原</a>';
            }
          ?>
          
        </div>
      </div>
    <?php
      }
    ?>
  </main>
  <footer class="blogFooter">Copyright © 2021 Who's Blog All Rights Reserved.</footer>
</body>
</html>

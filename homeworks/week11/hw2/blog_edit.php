<?php
  session_start();
  require_once("blog_conn.php");
  require_once("blog_utils.php");

  isAdmin($_SESSION['username']);

  $errNum = 0;
  if(isset($_GET['errNum'])) {
    $errNum = $_GET['errNum'];
  }
?>
<!DOCTYPE html>

<html>
<head>
  <meta charset="utf-8">
  <title>部落格__編輯文章區</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://necolas.github.io/normalize.css/8.0.1/normalize.css" />
  <link rel="stylesheet" href="stylesheet.css" type="text/css"/>
  <script>
    var errNum = <?php echo $errNum;?>;
    document.addEventListener('DOMContentLoaded', function() {
      if (errNum === 1) {
        alert('輸入資料不齊全。')
      }
      if (errNum === 2) {
        alert('編輯文章失敗，請稍後再次重試。')
      }
      if (errNum === 3) {
        alert('編輯成功。')
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
      <li><a href="blog_index.php">回首頁</a></li>
        <li><a href="handle_blog-logout.php">登出</a></li>
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
    <div class="newArticle">
      <div class="title">編輯文章：</div>
      <form method="post" action="handle_blog-edit.php">
        <div class="newArticleInfo">
          <input type="text" name="title" placeholder="請輸入文章標題..."/>
          <input type="text" name="class" placeholder="請輸入文章分類"/>
          <input type="hidden" name="id" value="<?php echo $_GET['id'];?>"></input>
        </div>
        <textarea name="content" rows="13"></textarea>
        <div><input class="btn addBtn" type="submit" value="編輯完成"/></div>
      </form>
    </div>
  </main>
  <footer class="blogFooter">Copyright © 2021 Who's Blog All Rights Reserved.</footer>
</body>
</html>

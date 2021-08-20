<?php
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
        alert('輸入帳密不齊全。')
      }
      if (errNum === 2) {
        alert('登入系統發生錯誤，請稍後再次重試。')
      }
      if (errNum === 3) {
        alert('輸入帳密錯誤。')
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
        <li><a href="#">文章列表</a></li>
        <li><a href="#">分類專區</a></li>
        <li><a href="#">關於我</a></li>
      </ul>
      <ul class="activeList">
        <li><a href="#">管理後臺</a></li>
        <li><a href="#">登出</a></li>
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
    <div class="login">
      <h1>LOG IN</h1>
      <form method="post" action="handle_blog-login.php">
        <div class="loginInfo">
          <span>USERNAME</span>
          <input type="text" name="username"/>
          <span>PASSWORD</span>
          <input type="text" name="password"/>
        </div>
        <input class="loginBtn" type="submit" value="SIGN IN"/>
      </form>
    </div>
  </main>
  <footer class="blogFooter">Copyright © 2021 Who's Blog All Rights Reserved.</footer>
</body>
</html>

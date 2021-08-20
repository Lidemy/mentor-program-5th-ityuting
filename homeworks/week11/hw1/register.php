<?php
  require_once("conn.php");
?>

<!DOCTYPE html>

<html>
<head>
  <meta charset="utf-8">
  <title>註冊會員</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://necolas.github.io/normalize.css/8.0.1/normalize.css" />
  <link rel="stylesheet" href="cssstyle.css" type="text/css"/>
</head>
<body class="bug">
  <header class="warning">注意！本站為練習用網站，因教學用途刻意忽略資安的實作，註冊時請勿使用任何真實的帳號或密碼。</header>
  <main class="board">
    <div class="board_func">
      <a class="board_btn" href="index.php">離開</a>
    </div>
    <hr/>
    <strong class="board_title">Register</strong>
      <?php
        $msg = 'Error';
        if (!empty($_GET['errCode'])) {
          if ($_GET['errCode'] === '1') {
            $msg = '輸入資料不齊全';
          }
          if ($_GET['errCode'] === '2') {
            $msg = '此帳號已被註冊';
          }
          echo '<div class="reminding"><strong>' . $msg . '</strong></div>';
        }
      ?>
    </div>
    <form method="post" action="handle_register.php">
      <div class="board_register">
        <div>
          <span>暱稱：</span>
          <input type="text" name="nickname"></input>
        </div>
        <div>
          <span>帳號：</span>
          <input type="text" name="account"></input>
        </div>
        <div>
          <span>密碼：</span>
          <input type="text" name="password"></input>
        </div>
      </div>
      <input class="board_submit-btn" type="submit" />
    </form>
    <hr/>
    </section>
  </main>
</body>
</html>

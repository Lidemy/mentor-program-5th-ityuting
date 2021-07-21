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
  <style>
    body {
      background-color: #e7eff5;
      margin: 0px;
    }

    .warning {
      background: #ffffff;
      color: red;
      text-align: center;
      padding: 5px;
      font-weight: bold;
    }
    
    .board {
      background: #0c293a;
      width: 100%;
      max-width: 600px;
      margin: 10px auto;
      padding: 10px;
      border-radius: 5px;
    }

    .board_func {
      margin-bottom: 12px;
    }

    .board_btn {
      color: #081724;
      padding: 4px 7px;
      font-size: 14px;
      text-decoration: none;
      background: #eae2b7;
      border-radius: 5px;
    }

    .board_title {
      color: #ffffff;
      font-size: 18px;
    }

    .reminding {
      color: red;
      margin-top: 7px;
    }

    .board_register {
      display: flex;
      flex-direction: column;
      color: #ffffff;
      margin: 5px 0;
      font-family: Comic Sans MS, Microsoft JhengHei;
    }

    .board_register div {
      margin: 5px;
    }

    .board_submit-btn {
      color: #081724;
      padding: 4px 7px;
      font-size: 14px;
      border: 1px solid white;
      border-radius: 5px;
    }

  </style>
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

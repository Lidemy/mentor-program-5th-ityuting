<?php
  session_start();
  require_once("conn.php");
  require_once("utils.php");
?>

<!DOCTYPE html>

<html>
<head>
  <meta charset="utf-8">
  <title>編輯留言</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://necolas.github.io/normalize.css/8.0.1/normalize.css" />
  <link rel="stylesheet" href="cssstyle.css" type="text/css"/>

  </style>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      document.querySelector('.update_nickname').addEventListener('click', function() {
        document.querySelector('.board_nickname').classList.toggle('hide')
      })
    })
  </script>
</head>
<body class="bug">
  <header class="warning">注意！本站為練習用網站，因教學用途刻意忽略資安的實作，註冊時請勿使用任何真實的帳號或密碼。</header>
  <main class="board">
    <div class="board_func">
      <a class="board_btn" href="index.php">回留言板</a>
    </div>
    <hr/>
    <span><strong class="board_title">Update comments</strong></span>
    <br/>
    <?php
      $msg = 'Error';
      if (!empty($_GET['errCode'])) {
        if ($_GET['errCode'] === '1') {
          $msg = '輸入資料不齊全';
        }
        echo '<div class="reminding"><strong>' . $msg . '</strong></div>';
      }
    ?>
    <div>
    <form class="board_newmsg" method="post" action="handle_update_msg.php">
      <div class="board_nick">
        <span>暱稱：</span>
        <input type="text" name="nickname" readonly
        <?php
          $commentInfo = callNicknameByid($_GET['id']);
          echo 'value="' . escape($commentInfo['nickname']) . '"';
        ?>
        ></input>
      </div>
      <textarea name="comment" rows="5"></textarea>
      <input type="hidden" name="id" 
      value="<?php 
        echo $_GET['id'];
      ?>"></input>
      <?php
      if (!empty($_SESSION['account'])) {
        echo '<input class="board_submit-btn" type="submit" />';
      }
      ?>
    </form>
  </main>
</body>
</html>

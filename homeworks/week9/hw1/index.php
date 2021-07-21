<?php
  session_start();
  require_once("conn.php");
  require_once("utils.php");

  $sql = "SELECT * FROM yuting_comments order by id desc";
  $result = $conn->query($sql);
  if (!$result) {
    die('Error:' . $conn->error);
  }

  function callNickname() {
    if (!empty($_SESSION['account'])) {
      $account = $_SESSION['account'];
      $data = getUsernameFromSession($account);
      return $data['nickname'];
    };
  }
?>

<!DOCTYPE html>

<html>
<head>
  <meta charset="utf-8">
  <title>留言板</title>
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
      margin-right: 5px; 
    }

    .board_title {
      color: #ffffff;
      font-size: 18px;
      line-height: 1.5em;
    }

    .board_nick {
      color: #ffffff;
      margin: 5px 0;
      font-family: Comic Sans MS, Microsoft JhengHei;
    }

    .board_newmsg textarea {
      margin: 5px 0px;
      width: 100%;
      resize:none;
      font-family: Comic Sans MS, Microsoft JhengHei;
    }

    .board_submit-btn {
      color: #081724;
      padding: 4px 7px;
      font-size: 14px;
      border: 1px solid white;
      border-radius: 5px;
    }

    .card {
      background: #081724;
      color: #ffffff;
      box-shadow: 1px 1px 1px #2b4160;
      padding: 10px;
      box-sizing: border-box;
      border-radius: 5px;
      display: flex;
      margin-top: 10px;
      font-family: Comic Sans MS, Microsoft JhengHei;
    }
    
    .card_avator {
      width: 50px;
      height: 50px;
      min-width: 50px;
      border-radius: 50%;
      background: #ffffff;
      margin-right: 10px;
    }

    .card_author {
      color: aquamarine;
    }

    .card_time {
      color: #2b4160;
    }

    .card_info span {
      display: inline-box;
      overflow: hidden;
      font-size: 14px;
    }

    .card_msg {
      margin-top: 5px;
      word-break: break-word;
    }

  </style>
</head>
<body class="bug">
  <header class="warning">注意！本站為練習用網站，因教學用途刻意忽略資安的實作，註冊時請勿使用任何真實的帳號或密碼。</header>
  <main class="board">
    <div class="board_func">
      <a class="board_btn" href="register.php">註冊</a>
      <?php
        if (!empty($_SESSION['account'])) {
          echo '<a class="board_btn" href="handle_logout.php">登出</a>';
        } else {
          echo '<a class="board_btn" href="login.php">登入</a>';
        }
      ?>
      
    </div>
    <hr/>
    <span><strong class="board_title">Comments</strong></span>
    <br/>
    <?php
      if (!empty($_SESSION['account'])) {
        echo '<span><strong class="board_title">Hi, ' . callNickname() . '! </strong></span>';
      } else {
        echo '<span><strong class="board_title">Hi! 請先登入會員以行使留言權，若沒有帳號請先註冊會員。 </strong></span>';
      }
    ?>
    <div>
    <form class="board_newmsg" method="post" action="handle_add_newmsg.php">
      <div class="board_nick">
        <span>暱稱：</span>
        <input type="text" name="nickname" readonly
        <?php 
            echo 'value="' . callNickname() . '"';
        ?>
        ></input>
      </div>
      <textarea name="comment" rows="5"></textarea>
      <?php
      if (!empty($_SESSION['account'])) {
        echo '<input class="board_submit-btn" type="submit" />';
      }
      ?>
    </form>
    <hr/>
    <section>
    <?php
      while($row = $result->fetch_assoc()) {
    ?>
      <div class="card">
        <div class="card_avator">
        </div>
        <div class="card_info">
          <div>
            <span class="card_author">
              <?php echo $row['nickname']; ?>
            </span>
            <span class="card_time">
              <?php echo $row['created_at']; ?>
            </span>
          </div>
          <div class="card_msg">
            <?php echo $row['comment']; ?>
          </div>
        </div>
      </div>
    <?php
      }
    ?>
    </section>
  </main>
</body>
</html>

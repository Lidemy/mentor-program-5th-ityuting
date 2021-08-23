<?php
  session_start();
  require_once("conn.php");
  require_once("utils.php");

  // $data 拿到使用者資料
  $account = '';
  if (isset($_SESSION['account'])) {
    $account = $_SESSION['account'];
  }
  $data = getUsernameFromSession($account);

  $page = 1;
  // 因為一開始打開 index.php 時， URL 是不帶有 $_GET['page'] 的，所以要多加上一個判斷 isset($_GET['page']，才不會印出 error。
  if (isset($_GET['page']) && intval($_GET['page']) !== 1) {
    $page = intval($_GET['page']);
  }

  $items_per_page = 5;
  $offset = ($page-1) * $items_per_page;
  $offset = intval($offset);

  $sql = "SELECT C.id as id, R.account as account, R.nickname as nickname, C.comment as comment, C.created_at as created_at, C.is_deleted as is_deleted, R.role as role FROM yuting_comments as C LEFT JOIN yuting_registers as R on C.registers_account = R.account WHERE C.is_deleted = 0 order by C.id desc LIMIT ? OFFSET ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ii", $items_per_page, $offset);
  $result = $stmt->execute();
  if (!$result) {
    die('Error:' . $conn->error);
  }

  $result = $stmt->get_result();
?>

<!DOCTYPE html>

<html>
<head>
  <meta charset="utf-8">
  <title>留言板</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://necolas.github.io/normalize.css/8.0.1/normalize.css" />
  <link rel="stylesheet" href="cssstyle.css" type="text/css"/>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      document.querySelector('.update_nickname').addEventListener('click', function() {
        document.querySelector('.board_nickname').classList.toggle('hide')
      })
    })
  </script>
</head>
<body>
  <header class="warning">注意！本站為練習用網站，因教學用途刻意忽略資安的實作，註冊時請勿使用任何真實的帳號或密碼。</header>
  <main class="board">
    <div class="board_func">
      <a class="board_btn" href="register.php">註冊</a>
      <?php
        if (!empty($_SESSION['account'])) {
          echo '<a class="board_btn" href="handle_logout.php">登出</a>';
          echo '<a class="board_btn update_nickname">編輯暱稱</a>';
          if (intval($data['role']) === 2) {
            echo '<a class="board_btn" id="admin" href="management_system.php">後台管理系統</a>';
          }
        } else {
          echo '<a class="board_btn" href="login.php">登入</a>';
        }
      ?>
    </div>
    <form class="board_nickname hide" method="post" action="handle_update_nickname.php">
      <div>
        <span class="board_newnickname">編輯暱稱：</span>
        <input type="text" name="nickname"/>
      </div>
      <input class="board_submit-btn" type="submit"/>
    </form>
    <hr/>
    <span><strong class="board_title">Comments</strong></span>
    <br/>
    <?php
      if (!empty($_SESSION['account'])) {
        echo '<span><strong class="board_title">Hi, ' . escape(callNickname()) . '! </strong></span>';
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
            echo 'value="' . escape(callNickname()) . '"';
        ?>
        ></input>
      </div>
      <textarea name="comment" rows="5"></textarea>
      <input type="hidden" name="account" 
      value="<?php 
        if (!empty($_SESSION['account'])) {
          echo $_SESSION['account'];
        }
      ?>"></input>
      <?php
      if (!empty($_SESSION['account'])) {
        if ($data['role'] !== '0') {
          echo '<input class="board_submit-btn" type="submit" />';
        } else {
          echo '<span class="reminding">您已被停權，僅能編輯和刪除留言。</span>';
        }
      }
      ?>
    </form>
    <hr/>
    <section>
    <?php
      // $row 是每筆留言的資料
      while ($row = $result->fetch_assoc()) {
    ?>
      <div class="card">
        <div class="card_avator">
        </div>
        <div class="card_info">
          <div>
            <span class="card_author">
              <?php echo escape($row['nickname']); ?>
            </span>
            <span class="card_time">
              <?php echo escape($row['created_at']); ?>
            </span>
            <?php
              if (isset($_SESSION['account'])) {
                if ($data['role'] === '2') {
                  echo '<span><a href="update_msg.php?id='.$row['id'].'">編輯</a></span>';
                  echo '<span><a href="handle_delete_msg.php?id='.$row['id'].'">刪除</a></span>';
                };
                if ($data['role'] === '1' && $row['account'] === $_SESSION['account']) {
                  echo '<span><a href="update_msg.php?id='.$row['id'].'">編輯</a></span>';
                  echo '<span><a href="handle_delete_msg.php?id='.$row['id'].'">刪除</a></span>';
                }
                if ($data['role'] === '0' && $row['account'] === $_SESSION['account']) {
                  echo '<span><a href="update_msg.php?id='.$row['id'].'">編輯</a></span>';
                  echo '<span><a href="handle_delete_msg.php?id='.$row['id'].'">刪除</a></span>';
                }
              }
            ?>
          </div>
          <div class="card_msg">
            <?php echo escape($row['comment']); ?>
          </div>
        </div>
      </div>
    <?php
      }
    ?>
    </section>
    <hr/>
    <section>
      <?php
        $sql = "SELECT count(id) as count FROM yuting_comments WHERE is_deleted = 0";
        $result = $conn->query($sql);
        if (!$result) {
          die('Error:' . $conn->error);
        }
        $row = $result->fetch_assoc();
        $total_msgs = $row['count'];
        $total_pages = intval(ceil($total_msgs / $items_per_page));
      ?>
      <div class="page">
        <span class="page_info">總共有 <?php echo $total_msgs?> 筆留言，頁數 <?php echo $page?> / <?php echo $total_pages?> </span>
        <div class="page_func">
          <?php
            if ($page !== 1) {
          ?>
              <a class="page_btn" href="index.php?page=1">首頁</a>
              <a class="page_btn" href="index.php?page=<?php echo $page-1?>">上一頁</a>
          <?php
            }
            if ($page !== $total_pages) {
          ?>
              <a class="page_btn" href="index.php?page=<?php echo $page+1?>">下一頁</a>
              <a class="page_btn" href="index.php?page=<?php echo $total_pages?>">末頁</a>
          <?php
            }
          ?>
        </div>
    </div>
    </section>
  </main>
</body>
</html>

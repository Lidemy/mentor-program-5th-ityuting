<?php
  session_start();
  require_once("conn.php");
  require_once("utils.php");

  $account = $_SESSION['account'];
  $data = getUsernameFromSession($account);

  if ($data['role'] !== '2') {
    header('Location: index.php');
    exit;
  }

  if ($data['role'] === '2') {
    $sql = "SELECT * from yuting_registers order by id desc";
    $result = $conn->query($sql);
    if ($conn->errno) {
      die('Error:' . $conn->error);
    }
  }
?>

<!DOCTYPE html>

<html>
<head>
  <meta charset="utf-8" />
  <title>後台管理系統</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://necolas.github.io/normalize.css/8.0.1/normalize.css" />
  <link rel="stylesheet" href="cssstyle.css" type="text/css" />
</head>
<body>
  <header class="warning">注意！本站為練習用網站，因教學用途刻意忽略資安的實作，註冊時請勿使用任何真實的帳號或密碼。</header>
  <main class="admin">
  <div class="admin_func">
    <a class="admin_btn" href="index.php">回到留言板</a>
    <span class="reminding">
      <?php
        $errnum = '0';
        if (isset($_GET['errnum'])) {
          $errnum = $_GET['errnum'];
        }
        if ($errnum === '1') {
          echo '輸入資料不齊全，請重新操作。';
        }
        if ($errnum === '2') {
          echo '您無法更改使用者權限。';
        }
        if ($errnum === '3') {
          echo '修改失敗，請重新操作。';
        }
      ?>
    </span>
  </div>
  <hr/>
  <section class="users_list">
    <div class="per_user">
      <table cellspacing="5px">
        <tr>
          <th>id</th>
          <th>nickname</th>
          <th>account</th>
          <th>role</th>
          <th>Authority</th>
        </tr>
      <?php
        while ($row = $result->fetch_assoc()) {
      ?>
        <tr>
          <td><?php echo escape($row['id']); ?></td>
          <td><?php echo escape($row['nickname']); ?></td>
          <td><?php echo escape($row['account']); ?></td>
          <td>
            <?php 
              if ($row['role'] === '0') {
                echo '遭停權的使用者';
              } else if (($row['role'] === '1')) {
                echo '一般使用者';
              } else {
                echo '管理者';
              };
            ?>
          </td>
          <td>
            <form class="update_Authority" method="post" action="handle_update_Authority.php?id=<?php echo escape($row['id']); ?>">
              <select name="role">
                <option selected>修改此帳號權限</option>
                <option>遭停權的使用者</option>
                <option>一般使用者</option>
                <option>管理者</option>
              </select>
              <input class="board_submit-btn" type="submit" value="確認"/>
            </form>
          </td>
        </tr>
      <?php
        };
      ?>
      </table>
    </div>
  </section>
</body>
</html>
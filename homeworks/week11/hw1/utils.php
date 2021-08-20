<?php
  function getUsernameFromSession($account) {
    global $conn;
    $sql = sprintf(
      "SELECT * FROM yuting_registers WHERE account = '%s'", 
      $account
    );
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row;
  }

  function callNickname() {
    if (!empty($_SESSION['account'])) {
      $account = $_SESSION['account'];
      $data = getUsernameFromSession($account);
      return $data['nickname'];
    };
  }

  function callNicknameByid($id) {
    global $conn;
    $sql = sprintf(
      "SELECT C.id as id, R.account as account, R.nickname as nickname, C.comment as comment, C.created_at as created_at, C.is_deleted as is_deleted, R.role as role FROM yuting_comments as C LEFT JOIN yuting_registers as R on C.registers_account = R.account WHERE C.id = %s", 
      $id
    );
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row;
  }

  function escape($str) {
    return htmlspecialchars($str, ENT_QUOTES);
  }

  // addmsg 、 updatemsg 、 deletemsg
  // 0 => 遭停權， 1 => 一般使用者， 2 => 管理者
  // 只有 $role === '0' 且 $Autority === 'addmsg' 的情況下 return false，那麼程式碼應該寫分開 $role 仔細寫清楚，還是簡略直接寫 `else { return true }` 好呢？
  /* 
  function hasAuthority($role, $Authority) {
    if (intval($role) === 0) {
      return array($role, $Authority !== 'addmsg');
    }
    if (intval($role) === 1 || intval($role) === 2) {
      return array($role, true);
    }
  }

  function test() {
    return false;
  }
  */
?>

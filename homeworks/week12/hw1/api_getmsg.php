<?php
  require_once("conn.php");
  header('Content-type:application/json;charset-utf-8');
  header('Access-Control-Allow-Origin: *');

  if(
    empty($_GET['site_key'])
  ) {
    $json = array(
      "ok" => false,
      "message" => "Please put site_key in your url."
    );
    $response = json_encode($json);
    echo $response;
    die();
  }

  $site_key = $_GET['site_key'];

  if(empty($_GET['before'])) {
    $sql = "SELECT id, nickname, comment, created_at FROM yuting_message_board WHERE site_key = ? order by id desc limit 5";
  } else {
    $sql = "SELECT id, nickname, comment, created_at FROM yuting_message_board WHERE site_key = ? and id < ? order by id desc limit 5";
  }

  $stmt = $conn->prepare($sql);
  
  if(empty($_GET['before'])) {
    $stmt->bind_param("s", $site_key);
  } else {
    $stmt->bind_param("ss", $site_key, $_GET['before']);
  }
  
  $result = $stmt->execute();
  if(!$result) {
    $json = array(
      "ok" => false,
      "message" => "System error or there is no message board on this site."
    );
    $response = json_encode($json);
    echo $response;
    die();
  }

  $last_id = NULL;
  $comments = array();
  $result = $stmt->get_result();
  while($row = $result->fetch_assoc()) {
    array_push($comments, array(
      "id" => $row['id'],
      "nickname" => $row['nickname'],
      "comment" => $row['comment'],
      "created_at" => $row['created_at']
    ));
    // 找不到 mysql 可以抓取最後一筆資料的語法，只有找到 `lastInsertId()` ，但這是 Insert 時用的，所以 ... 自己帶 ˊˇˋ。
    $last_id = $row['id'];
  }
  
  $json = array(
    "ok" => true,
    "comments" => $comments,
    "lastId" => $last_id
  );
  $response = json_encode($json);
  echo $response;
?>

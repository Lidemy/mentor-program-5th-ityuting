<?php
  require_once("conn.php");
  header('Content-type:application/json;charset-utf-8');
  header('Access-Control-Allow-Origin: *');

  if(
    empty($_POST['nickname']) ||
    empty($_POST['comment']) ||
    empty($_POST['site_key'])
  ) {
    $json = array(
      "ok" => false,
      "message" => "Please check all fields."
    );
    $response = json_encode($json);
    echo $response;
    die();
  }

  $nickname = $_POST['nickname'];
  $comment = $_POST['comment'];
  $site_key = $_POST['site_key'];

  $sql = "INSERT INTO yuting_message_board(site_key, nickname, comment) VALUES(?, ?, ?)"; 
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("sss", $site_key, $nickname, $comment);
  $result = $stmt->execute();
  if(!$result) {
    $json = array(
      "ok" => false,
      "message" => "System error. Please try again later."
    );
    $response = json_encode($json);
    echo $response;
    die();
  }

  // 成功
  $json = array(
    "ok" => true,
    "message" => "Succussful operation."
  );
  $response = json_encode($json);
  echo $response;
?>

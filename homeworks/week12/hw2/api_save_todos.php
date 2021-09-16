<?php
  require_once("conn.php");
  header('Content-type:application/json;charset-utf-8');
  header('Access-Control-Allow-Origin: *');

  $id = NULL;
  if(!empty($_GET['id'])) {
    $id = intval($_GET['id']);
  }

  $url = 'http://localhost/yuting/week12/hw2/index.html';
  $todos = $_POST['todos'];

  // 沒有 id 表示第一次儲存，mysql insert
  if(empty($_GET['id'])) {
    $sql = "INSERT INTO yuting_todos_info(todos) VALUES(?)"; 
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $todos);
    $result = $stmt->execute();

    // 儲存失敗
    if(!$result) {
      $json = array(
        "ok" => false,
        "id" => $id,
        "message" => "Store failed. Please try again later."
      );
      $response = json_encode($json);
      echo $response;
      die();
    }

    // 儲存成功
    $id = $conn->insert_id;

    $json = array(
      "ok" => true,
      "id" => $id,
      "message" => "Saved successfully."
    );
    $response = json_encode($json);
    echo $response;
    die();
  }

  
  // 有 id 表示要更新 todos
  if(!empty($_GET['id'])) {
    $sql = "UPDATE yuting_todos_info SET todos = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $todos, $id);
    $result = $stmt->execute();

    // 更新失敗
    if(!$result) {
      $json = array(
        "ok" => false,
        "id" => $id,
        "message" => "Store failed. Please try again later."
      );
      $response = json_encode($json);
      echo $response;
      die();
    }

    // 更新成功
    $json = array(
      "ok" => true,
      "id" => $id,
      "message" => "Saved successfully."
    );
    $response = json_encode($json);
    echo $response;
    die();
  }
?>

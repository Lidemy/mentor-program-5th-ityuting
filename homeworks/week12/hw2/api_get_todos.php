<?php
  require_once("conn.php");
  header('Content-type:application/json;charset-utf-8');
  header('Access-Control-Allow-Origin: *');

  if(empty($_GET['id'])) {
    $json = array(
      "ok" => false,
      "message" => "Please put id in your url."
    );
    $response = json_encode($json);
    echo $response;
    die();
  }

  $id = $_GET['id'];

  $sql = "SELECT todos FROM yuting_todos_info WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $id);
  $result = $stmt->execute();

  if(!$result) {
    $json = array(
      "ok" => false,
      "message" => "System error or there is not the todos with the id."
    );
    $response = json_encode($json);
    echo $response;
    die();
  }

  $result = $stmt->get_result();
  $row = $result->fetch_assoc();
  $todos = $row['todos'];
  
  $json = array(
    "ok" => true,
    "todos" => $todos,
  );
  $response = json_encode($json);
  echo $response;
?>

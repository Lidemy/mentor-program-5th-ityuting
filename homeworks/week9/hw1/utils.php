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
?>

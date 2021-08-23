<?php
  session_start();
  session_destroy();
  die(header('Location: blog_index.php'));
?>
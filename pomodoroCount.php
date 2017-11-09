<?php
  header ( 'Content-Type: text/json' );
  header ( "Access-Control-Allow-Origin: *" );
  $dbh = new PDO("sqlite:./pomodoro.db");
  $sql = $dbh->query("SELECT COUNT(*) FROM pomodoros");
  $count = $sql->fetchColumn();
  echo json_encode ($count);
?>

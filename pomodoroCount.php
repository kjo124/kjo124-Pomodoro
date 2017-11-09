<?php
  header ( 'Content-Type: text/json' );
  header ( "Access-Control-Allow-Origin: *" )
  $dbh = new PDO("sqlite:./pomodoro.db");
	$pomodoro_num = $dbh->query("SELECT count(*) FROM pomodoros");
  $a = $pomodoro_num->fetchColumn();
  echo json_encode ( $a );
?>

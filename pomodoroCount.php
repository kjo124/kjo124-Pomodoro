<?php
  header ( 'Content-Type: text/json' );
  header ( "Access-Control-Allow-Origin: *" );
  $dbh = new PDO("sqlite:./pomodoro.db");
  $count = null;
  $result =  $dbh -> query("SELECT COUNT(*) FROM pomodoros");

  if(!empty($result)) {
    $count  = $result->fetchColumn(0);
  } else{
    //assuming PDO
    print_r($dbh->errorInfo());
  }




  // $sql = $dbh->query("SELECT COUNT(*) FROM pomodoros");
  //$count = $sql->fetchColumn();
  echo json_encode ($count);
?>

<?php
  $dbh = new PDO("sqlite:./pomodoro.db");
  $date = date('Y-m-d g:i:s');
  $sql = "insert into pomodoros values('$date');";
  $status = $dbh->exec($sql);
 ?>

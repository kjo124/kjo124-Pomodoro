<?php
  $dbh = new PDO("sqlite:./pomodoro.db");

  // start time
  $newTime = strtotime('-25 minutes');
  $startTime = date('Y-m-d H:i:s', $newTime);
  echo $startTime;

  
  $sql = "insert into pomodoros values('$startTime');";
  $status = $dbh->exec($sql);
 ?>

<?php
  $dbh = new PDO("sqlite:./pomodoro.db");
  $newTime = strtotime('-25 minutes');
  $date = date('Y-m-d H:i:s', $newTime);
  echo $date;
  $sql = "insert into pomodoros values('$date');";
  $status = $dbh->exec($sql);
 ?>

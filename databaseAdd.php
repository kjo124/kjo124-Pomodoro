<?php
  $dbh = new PDO("sqlite:./pomodoro.db");

  // start time
  $newTime = strtotime('-25 minutes');
  $startTime = date('Y-m-d H:i:s', $newTime);
  echo $startTime;

  $class = $_POST['class'];
  echo $class;
  $type = $_POST['type'];
  echo $type;
  $assignment = $_POST['assignment'];
  echo $assignment;

  $sql = "insert into pomodoros values('$startTime');";
  $status = $dbh->exec($sql);
 ?>

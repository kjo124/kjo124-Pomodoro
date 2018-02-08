<?php
  $sub25Min = strtotime('-25 minutes');
  $startDate = date('Y-m-d', $sub25Min);
  echo $startDate;
  // start time
  $startTime = date('H:i:s', $sub25Min);
  echo $startTime;

  $class = $_POST['classArg'];
  echo $class;
  $type = $_POST['type'];
  echo $type;
  $assignment = $_POST['assignment'];
  echo $assignment;

  $command = "python3 addToDatabase.py '$startDate' '$startTime' '$class' '$type' '$assignment'";

  $escaped_command = escapeshellcmd($command);

  system($escaped_command);
 ?>

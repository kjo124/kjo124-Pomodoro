<?php
<<<<<<< HEAD
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
=======
echo "hello";
  // $dbh = new PDO("sqlite:./pomodoro.db");
  // $sub25Min = strtotime('-25 minutes');
  // $startDate = date('Y-m-d', $sub25Min);
  // echo $startDate;
  // // start time
  // $startTime = date('H:i:s', $sub25Min);
  // echo $startTime;
  //
  // $class = $_POST['class'];
  // echo $class;
  // $type = $_POST['type'];
  // echo $type;
  // $assignment = $_POST['assignment'];
  // echo $assignment;
  //
  // // CREATE TABLE pomodoros (startDate date, startTime time, class varchar(50), type varchar(250), assignment varchar(250));
  // // insert into pomodoros values("2017-1-1", "12:00:13", "CS356", "Quiz", "Quiz 1");
  //
  // $sql = "insert into pomodoros values('$startDate', '$startTime', '$class', '$type', '$assignment');";
  // $status = $dbh->exec($sql);
>>>>>>> parent of de1add5... need to manual check
 ?>

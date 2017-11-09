</div>
</body>
<div class="footer">
<?php
	echo "Current time: ";
	echo date('Y-m-d g:i:s');
?>
</div>
<br>
<br>
<?php
// Display all sqlite tables
    $dbh = new PDO("sqlite:./pomodoro.db");
		$sql= mysqli_query("SELECT * FROM users");
		while($result= mysqli_fetch_array($sql)) {
    	echo $result['fname']." ".$result['sname'] . '<br>';
		}
?>


</html>

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
    $tablesquery = $dbh->query("SELECT * FROM pomodoros");

    while ($table = $tablesquery->fetchArray(SQLITE3_ASSOC)) {
        if ($table['name'] != "sqlite_sequence") {
            echo $table['name'] . ' <br />';
        }
    }
?>


</html>

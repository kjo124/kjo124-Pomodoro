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
		$sql = 'SELECT * from pomodoros';
		$result = $dbh->query($sql);
		$rows = $result->fetchAll(PDO::FETCH_ASSOC);

		if(count($result)) {
    	echo '<table align="center"><tr>';
    	foreach ($rows[0] as $columnName => $value) {
        echo '<th>' . $columnName . '</th>';
    	}
    	echo '</tr>';
    	foreach ($rows as $row) {
        echo '<tr>';
        foreach ($row as $value) {
            echo '<td>' . $value . '</td>';
        }
        echo '<tr>';
    }
    echo '</table>';
}
?>


</html>

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
$dbh = new PDO("sqlite:./pomodoro.db");
$results =  $dbh -> query("SELECT * FROM pomodoros");

while ($row = mysql_fetch_array($results)) {
    echo '<tr>';
    foreach($row as $field) {
        echo '<td>' . htmlspecialchars($field) . '</td>';
    }
    echo '</tr>';
}
 ?>

</html>

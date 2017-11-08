<?php include 'header.php'; ?>

<h3>Input time in Minutes & Seconds:</h3><br>
<!-- Present an input field where a user may enter a countdown time in seconds. -->

<p>
  Minutes:
  <input name="minAmount" type="number" min="0" value="0" id="minAmount"/>
  Seconds:
  <input name="secAmount" type="number" min="0" max="59" value="0" id="secAmount"/>
</p>
<!-- Area where timer is displayed -->
<h1 id="timer">0:00</h1>

<br>

<!-- Provide a Start Button to initiate the countdown timer. -->
<button onclick="stopAndStartTimer()" id="startBtn">Start with custom time</button>

<!-- Provide reset button which stops the timer and clears both in the input and time remaining displays. -->
<button onclick="stopTimer()" id="resetBtn">Reset</button>

<script>
document.getElementById("startBtn").disabled = false;
document.getElementById("resetBtn").disabled = true;
</script>

<br>

<button onclick="fixedStopAndStartTimer(1500)" id="pomodoroBtn">Pomodoro</button>
<button onclick="fixedStopAndStartTimer(300)" id="sbBtn">Short Break</button>
<button onclick="fixedStopAndStartTimer(600)" id="lbBtn">Long Break</button>

<!-- Hidden audio element for chime -->
<audio hidden id="audio" controls>
  <!-- path./chime.mp3 -->
  <!-- http://soundbible.com/1598-Electronic-Chime.html -->
  <source src="chime.mp3" type="audio/mpeg">
</audio>

<?php
  echo '<br>';
  $dbh = new PDO("sqlite:./pomodoro.db");
	$pomodoro_num = $dbh->query("SELECT count(*) FROM pomodoros");
	echo "Number of pomodoros completed: " . $pomodoro_num->fetchColumn() . '<br />';
?>

<script>
var chime = document.getElementById("audio");
var timeout;

function stopAndStartTimer(){
  // The Start Button must be disabled during countdown; only the Reset Button should be enabled.
  stopTimer();
  var getMin = document.getElementById('minAmount').value;
  var getSec = document.getElementById('secAmount').value;
  // Parse only integer values as input and always assume input is being provided in seconds.
  getMin = parseInt(getMin, 10);
  getMin = getMin*60;
  getSec = parseInt(getSec, 10);
  getSec = getSec + getMin;
  disableStart();
  enableReset();
  countdown( 'timer', getSec );
}

function fixedStopAndStartTimer(seconds){
  // The Start Button must be disabled during countdown; only the Reset Button should be enabled.
  stopTimer();
  var getSec = seconds;
  // Parse only integer values as input and always assume input is being provided in seconds.
  getSec = parseInt(getSec, 10);
  disableStart();
  enableReset();
  countdown( 'timer', getSec );
}

function disableStart(){
  document.getElementById("startBtn").disabled = true;
}

function enableReset(){
  document.getElementById("resetBtn").disabled = false;
}

// Plays chime
function play() {
  chime.play();
}

// stops the timer
function stopTimer() {
  document.getElementById("startBtn").disabled = false;
  document.getElementById("resetBtn").disabled = true;
  document.getElementById( "timer" ).innerHTML = "0:00"
  document.title = "Pomodoro Timer";
  // Use clearTimeout()functionality of JavaScript when reseting the timer.
  clearTimeout(timeout);
}

function countdown( elementName, seconds ){
  var element, timerOver, hours, mins, msLeft, time, secs;
  if (seconds > 59) {
    mins = parseInt(seconds/60);
  }else {
    mins = 0;
  }

  if (seconds > 59) {
    secs =  seconds % 60;
  }else {
    secs = seconds;
  }

  function twoDigits( n ){
    return (n <= 9 ? "0" + n : n);
  }

  function updateTimer(){
    msLeft = timerOver - (+new Date);
    if ( msLeft < 1000 ) {
      // add one to database
      var pomodoroFinished = true;
      <?php
      if (pomodoroFinished) {
        $date = date('Y-m-d g:i:s');
        $sql = "insert into pomodoros values('$date');";
        $status = $dbh->exec($sql);
      }
       ?>


      document.title = "Times Up!"
      var timesPlayed = 0;
      play();
      timesPlayed++;

      // plays the chime twice when timmer is up
      chime.onended = function() {
        if (timesPlayed<2) {
          play();
          timesPlayed++;
        }
      }
      timerElement.innerHTML = "0:00";
    } else {
      time = new Date( msLeft );
      hours = time.getUTCHours();
      mins = time.getUTCMinutes();
      //sets the title to be the timer so if you are in another tab you can see it updating
      document.title = (hours ? hours + ':' + twoDigits( mins ) : mins) + ':' + twoDigits( time.getUTCSeconds() );
      // As each second passes, your display needs to update the time remaining display.
      // Display the current time remaining on the timer in minutes and seconds.
      timerElement.innerHTML = (hours ? hours + ':' + twoDigits( mins ) : mins) + ':' + twoDigits( time.getUTCSeconds() );
      // Use setTimeout() functionality from JavaScript to implement your timer.
      timeout = setTimeout( updateTimer, time.getUTCMilliseconds() + 500 );
    }
  }

timerElement= document.getElementById( elementName );
timerOver = (+new Date) + 1000 * (60*mins + secs) + 500;
updateTimer();
}

</script>

<?php include 'footer.php'; ?>

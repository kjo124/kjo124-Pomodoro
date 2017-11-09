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
<button onclick="customTime()" id="startBtn">Start with custom time</button>

<!-- Provide reset button which stops the timer and clears both in the input and time remaining displays. -->
<button onclick="forcedStopTimer()" id="resetBtn">Reset</button>

<script>
document.getElementById("startBtn").disabled = false;
document.getElementById("resetBtn").disabled = true;
</script>

<br>

<button onclick="thisIsAPomodoro()" id="pomodoroBtn">Pomodoro</button>
<button onclick="startWithPresetTime(300)" id="sbBtn">Short Break</button>
<button onclick="startWithPresetTime(600)" id="lbBtn">Long Break</button>

<!-- Hidden audio element for chime -->
<audio hidden id="audio" controls>
  <!-- path./chime.mp3 -->
  <!-- http://soundbible.com/1598-Electronic-Chime.html -->
  <source src="chime.mp3" type="audio/mpeg">
</audio>


<p>
	Number of pomodoros completed: <span id="displayedCount"> ... </span>
</p>


<?php include 'footer.php'; ?>

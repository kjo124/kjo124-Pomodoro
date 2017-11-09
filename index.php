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

<br>
<br>
<div class="table">
<table align="center">
 <tr>
   <th>Class</th>
   <th>Assignment Type</th>
   <th>Specific Assignment</th>
 </tr>
 <tr>
   <td>
     <form action="">
       <select name="classes" onchange="changeClass(this.value)" id="classASDA">
         <option value=""></option>
         <option value="CS314">CS314</option>
         <option value="CS356">CS356</option>
         <option value="CS370">CS370</option>
         <option value="CS370">CT320</option>
         <option value="MKT305">MKT305</option>
         <option value="Personal">Personal</option>
       </select>
     </form>
   </td>
   <td>
     <form action="">
       <select name="assignmentType" onchange="changeAssignment(this.value)" id="assASDA">
         <option value=""></option>
         <option value="Homework">Homework</option>
         <option value="Quiz">Quiz</option>
         <option value="Study">Study</option>
         <option value="Personal">Personal</option>
         <option value="Other">Other</option>
       </select>
     </form>
   </td>
   <td>
     <input type="text" name="specificAssignment" value="" onchange="changeSpecific(this.value)" id="specASDA">
   </td>
 </tr>
</table>
</div>
<br>

<p>
	Number of pomodoros completed: <span id="displayedCount"> ... </span>
</p>

<script>
var pomodoroBool = false;

var classChosen;
var assignmentType;
var specificAssignment;

function changeClass(val) {
  classChosen = val;
  console.log("classChosen: "+classChosen);
}

function changeAssignment(val) {
  assignmentType = val;
  console.log("assignmentType: "+assignmentType);
}

function changeSpecific(val) {
  specificAssignment = val;
  console.log("specificAssignment: "+specificAssignment);
}

// use this function when a pomodoro is started so it gets counted in database
function thisIsAPomodoro(){
  pomodoroBool = true;
  startWithPresetTime(5); // 1500 // 25min
}

// display count on start up
jQuery(document).ready(function() {
	jQuery.post("pomodoroCount.php", {}, function(data) {
		jQuery("#displayedCount").html(data);
	})
});

var chime = document.getElementById("audio");
var timeout;

// used only for custom time
function customTime(){
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

function startWithPresetTime(seconds){
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

// only done on reset button press, needed for partial pomodoros (they should
//    be uncounted)
function forcedStopTimer() {
  if (pomodoroBool) {
    pomodoroBool = false;
  }
  stopTimer();
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
      // when a pomodoro is being done:
      if (pomodoroBool) {

        $.ajax({
          // var a = document.getElementById('classASDA').value;
          // var b = document.getElementById('assASDA').value;
          // var c = document.getElementById('specASDA').value;
          // add a pomodoro
          type: "POST",
          url: "databaseAdd.php",
          toGive: (
            {class: document.getElementById('classASDA').value,
              type: document.getElementById('assASDA').value,
              assignment: document.getElementById('specASDA').value}),
          // if that succeded
          success: function(result, toGive){
            console.log(result);
            // update the count displayed
            jQuery.post("pomodoroCount.php", {}, function(data) {
              jQuery("#displayedCount").html(data);
            });
          }
        });
      }

      // reset pomodoroBool
      pomodoroBool = false;

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

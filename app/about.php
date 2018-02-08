<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>About</title>
    <meta name="Author" content="Kyle Odin">
    <meta name="Description" content="Pomodoro Timer">
    <meta name="Keywords" content="Pomodoro Timer">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.css" />
    <link rel="stylesheet" href="app.css" />
    <script src="bower_components/angular/angular.js"></script>
  </head>
  <body>
    <div class="header">
      <div class="jumbotron">
          <h1>About</h1>
      </div>
    </div>

    <nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav">
            <li class="active"><a href="about.php">About</a></li>
            <li><a href="index.php">Timer</a></li>
            <li><a href="records.php">Records</a></li>
            <!-- <li><a href="manualAdd.php">Manual Add</a></li> -->
            <!-- <li><a href="#">Page 3</a></li> -->
          </ul>
        </div>
      </div>
    </nav>

    <div class="content">
      <div class="container">
        <div class="row">
          <div class="col-sm-8">
            <h3>What is a Pomodoro?</h3>
            <p>The
              <a href="https://en.wikipedia.org/wiki/Pomodoro_Technique">Pomodoro Technique</a>
              is a time managment method where the user sets a timer for 25 minutes and works during that time. The work is uninteruptible and extremely focused. Once the timer has been completed, you may take a break.
            </p>
            <p>Keeping track of Pomodoros (Each 25 minute work time) can be very useful for planning out your time in the future.</p>
            <h3>Who made this?</h3>
            <p>I am Kyle Odin, a soon graduate of CSU for Applied Computing Technology. You can find the code for this site <a href="https://github.com/kjo124/kjo124-Pomodoro">here</a>.</p>
          </div>
          <div class="col-sm-4">
            <img class="img-responsive" src="https://upload.wikimedia.org/wikipedia/commons/3/34/Il_pomodoro.jpg"/>
          </div>
        </div>
      </div>
    </div>

  </body>

  <div class="footer" >
    <script>
    jQuery(document).ready(function() {
    	jQuery.post("pomodoroCount.php", {}, function(data) {
    		jQuery("#displayedCount").html(data);
    	})
    });
    </script>
    <p>
    	Number of pomodoros completed: <span id="displayedCount"> ... </span>
    </p>
  </div>

</html>

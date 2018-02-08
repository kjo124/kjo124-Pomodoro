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
      <p>About Content Here</p>
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

<!doctype html>
<html lang="en" ng-app="timerApp">
  <head>
    <meta charset="utf-8">
    <title>Pomodoro Timer</title>
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
    <script src="app.module.js"></script>
    <script src="timer/timer.module.js"></script>
    <script src="timer/timer.component.js"></script>
  </head>
  <body>
    <div class="header">
      <div class="jumbotron">
          <h1>Pomodoro Timer</h1>
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
            <li><a href="about.html">About</a></li>
            <li class="active"><a href="index.html">Timer</a></li>
            <li><a href="records.html">Records</a></li>
            <!-- <li><a href="manualAdd.html">Manual Add</a></li> -->
            <!-- <li><a href="#">Page 3</a></li> -->
          </ul>
        </div>
      </div>
    </nav>
    <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-2">

        </div>
        <div class="col-md-8">
          <timer></timer>
          <div class="col-sm-4">
          </div>
          <div class="col-sm-4">
          <table class="table table-condensed">
           <tr>
             <th>Class</th>
             <th>Assignment Type</th>
           </tr>
           <tr>
             <td>
               <form action="">
                 <select name="classes" onchange="changeClass(this.value)" id="classSelect">
                   <option value=""></option>
                   <option value="CS414">CS414</option>
                   <option value="CS430">CS430</option>
                   <option value="FIN305">FIN305</option>
                   <option value="JTC413">JTC413</option>
                   <option value="Personal">Personal</option>
                 </select>
               </form>
             </td>
             <td>
               <form action="">
                 <select name="assignmentType" onchange="changeAssignment(this.value)" id="assSelect">
                   <option value=""></option>
                   <option value="Homework">Homework</option>
                   <option value="Quiz">Quiz</option>
                   <option value="Study">Study</option>
                   <option value="Personal">Personal</option>
                   <option value="Other">Other</option>
                 </select>
               </form>
             </td>
           </tr>
          </table>
          <table class="table table-condensed">
           <tr>
             <th>Specific Assignment</th>
           </tr>
             <td>
               <input type="text" name="specificAssignment" value="" onchange="changeSpecific(this.value)" id="specSelect">
             </td>
           </tr>
          </table>
        </div>
        </div>
        <div class="col-md-2">

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

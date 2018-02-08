'use strict';

angular.
  module('timer').
  component('timer', {
    templateUrl: 'timer/timer.template.html',
    controller: function timerController($scope,$timeout,$http) {
        $scope.counter = 5;
        $scope.stopped = true;
        $scope.pomodoroButtonText='Start Pomodoro';
	$scope.shortButtonText='5 Minute Break';
	$scope.longButtonText='10 Minute Break';
        $scope.displayedTimer = "00:00";
	$scope.showPomodoro = true;
	$scope.showShort = true;
	$scope.showLong = true;
        $scope.humanReadableTimer = function() {
          function z(n) {
            return (n<10? '0' : '') + n;
          }
          var seconds = $scope.counter % 60;
          var minutes = Math.floor($scope.counter / 60);
          $scope.displayedTimer = (z(minutes)+':'+z(seconds));
        }
        $scope.onTimeout = function() {
          if (!$scope.stopped) {
            $scope.counter--;
            $scope.humanReadableTimer();
            if ($scope.counter > 0) {
              mytimeout = $timeout($scope.onTimeout,1000);
            } else {
	      if ($scope.pomodoroButtonText=='Cancel Pomodoro') {
		var xsrf = $.param({
		                  classArg:document.getElementById('classSelect').value,
		                  type:document.getElementById('assSelect').value,
		                  assignment:document.getElementById('specSelect').value});
              $http({
                url: "records/databaseAdd.php",
                method: "POST",
                data: xsrf,
		          headers: {'Content-Type': 'application/x-www-form-urlencoded'}
              }).then(function successCallback(response) {
                $scope.data = response.data;
                console.log("Success");
              }, function errorCallback(response) {
                console.log("error");
                $scope.error = response.statusText;
              });
	      }
              alert("Time is up!");
              $scope.pomodoroButtonText='Start Pomodoro';
	      $scope.shortButtonText='5 Minute Break';
	      $scope.longButtonText='10 Minute Break';
	      $scope.showPomodoro = true;
	      $scope.showShort = true;
	      $scope.showLong = true;
            }
          }
        }
        var mytimeout;
        $scope.pomodoroClick = function() {
          if(!$scope.stopped && $scope.pomodoroButtonText=='Cancel Pomodoro'){
            $timeout.cancel(mytimeout);
            $scope.pomodoroButtonText='Start Pomodoro';
	    $scope.showShort = true;
	    $scope.showLong = true;
            $scope.displayedTimer = "00:00";
          } else if ($scope.stopped && $scope.pomodoroButtonText=='Start Pomodoro'){
            mytimeout = $timeout($scope.onTimeout,1000);
	    $scope.counter = 1500;
            $scope.pomodoroButtonText='Cancel Pomodoro';
	    $scope.showShort = false;
	    $scope.showLong = false;
          } else {
	    mytimeout = $timeout($scope.onTimeout,1000);
            $scope.pomodoroButtonText='Cancel Pomodoro';
	  }
          $scope.stopped=!$scope.stopped;
        }
	$scope.shortClick = function() {
          if(!$scope.stopped && $scope.shortButtonText=='Cancel 5 Minute Break'){
            $timeout.cancel(mytimeout);
            $scope.shortButtonText='5 Minute Break';
	    $scope.showPomodoro = true;
	    $scope.showLong = true;
	    $scope.displayedTimer = "00:00";
          } else if ($scope.stopped && $scope.shortButtonText=='5 Minute Break'){
            mytimeout = $timeout($scope.onTimeout,1000);
	    $scope.counter = 300;
            $scope.shortButtonText='Cancel 5 Minute Break';
	    $scope.showPomodoro = false;
	    $scope.showLong = false;
          } else {
	    mytimeout = $timeout($scope.onTimeout,1000);
            $scope.shortButtonText='Cancel 5 Minute Break';
	  }
          $scope.stopped=!$scope.stopped;
        }
	$scope.longClick = function() {
          if(!$scope.stopped && $scope.longButtonText=='Cancel 10 Minute Break'){
            $timeout.cancel(mytimeout);
            $scope.longButtonText='10 Minute Break';
	    $scope.showPomodoro = true;
	    $scope.showShort = true;
	    $scope.displayedTimer = "00:00";
          } else if ($scope.stopped && $scope.longButtonText=='10 Minute Break'){
            mytimeout = $timeout($scope.onTimeout,1000);
	    $scope.counter = 600;
            $scope.longButtonText='Cancel 10 Minute Break';
	    $scope.showPomodoro = false;
	    $scope.showShort = false;
          } else {
	    mytimeout = $timeout($scope.onTimeout,1000);
            $scope.longButtonText='Cancel 10 Minute Break';
	  }
          $scope.stopped=!$scope.stopped;
        }
    }
  });

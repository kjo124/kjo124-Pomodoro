'use strict';

// Register `phoneList` component, along with its associated controller and template
angular.
  module('timer').
  component('timer', {
    templateUrl: 'timer/timer.template.html',
    controller: function timerController($scope,$timeout,$http) {
        $scope.counter = 5;
        $scope.stopped = true;
        $scope.buttonText='Start';
        $scope.displayedTimer = "00:00";
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
              alert("Time is up!");
              $scope.buttonText='Restart';
              $http({
                url: "records/databaseAdd.php",
                method: "POST",
                data: {
                  class:"foo",
                  type:"foo",
                  assignment:"foo"
                }
              }).then(function successCallback(response) {
                // this callback will be called asynchronously
                // when the response is available
                $scope.data = response.data;
                console.log(data);
              }, function errorCallback(response) {
                // called asynchronously if an error occurs
                // or server returns response with an error status.
                console.log("error");
                $scope.error = response.statusText;
              });
            }
          }
        }
        var mytimeout;
        $scope.takeAction = function() {
          if(!$scope.stopped && $scope.buttonText=='Stop'){
            $timeout.cancel(mytimeout);
            $scope.buttonText='Start';
          } else if (!$scope.stopped && $scope.buttonText=='Restart') {
            mytimeout = $timeout($scope.onTimeout,1000);
            $scope.counter = 10;
            $scope.buttonText='Stop';
            $scope.stopped =!$scope.stopped;
          } else {
            mytimeout = $timeout($scope.onTimeout,1000);
            $scope.buttonText='Stop';
          }
          $scope.stopped=!$scope.stopped;
        }
    }
  });

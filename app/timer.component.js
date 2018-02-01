'use strict';

// Register `phoneList` component, along with its associated controller and template
angular.
  module('timerApp').
  component('timer', {
    template:
        '{{displayedTimer}}' +
        '<p><button ng-click="takeAction()">{{buttonText}}</button> <p>',
    controller: function timerController($scope,$timeout) {
        $scope.counter = 1500;
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
            }
          }
        }
        var mytimeout = $timeout($scope.onTimeout,1000);
        $scope.takeAction = function() {
          if(!$scope.stopped){
            $timeout.cancel(mytimeout);
            $scope.buttonText='Start';
          } else {
            mytimeout = $timeout($scope.onTimeout,1000);
            $scope.buttonText='Stop';
          }
          $scope.stopped=!$scope.stopped;
        }
    }
  });

'use strict';

// Define the `timer` module
var timerApp = angular.module('timerApp', []);

timerApp.controller('timerController',
                    function timerController($scope,$timeout) {
    // 25 min = 1500 seconds
    $scope.counter = 1500;
    $scope.stopped = true;
    $scope.buttonText='Start';
    $scope.onTimeout = function() {
        if (!$scope.stopped) {
            $scope.counter--;
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
});

timerApp.filter('formatTimer', function() {
    return function(input) {
        function z(n) {
            return (n<10? '0' : '') + n;
        }
        var seconds = input % 60;
        var minutes = Math.floor(input / 60);
        return  (z(minutes)+':'+z(seconds));
    };
});

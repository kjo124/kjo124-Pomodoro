'use strict';

// Define the `phonecatApp` module
angular.module('timerApp', [
  // ...which depends on the `timer` module
  'timer'
]);
angular.module('recordsApp', [
  // ...which depends on the `timer` module
  'records'
]);
//  bug here
angular.module('addApp', [
  // ...which depends on the `timer` module
  'add'
]);

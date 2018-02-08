'use strict';

// Register `phoneList` component, along with its associated controller and template
angular.
  module('records').
  component('records', {
    templateUrl: 'records/records.template.html',
    controller: function recordsController($http) {
      var self = this;
      $http.get('records/records.json').then(function(response) {
        self.records = response.data;
      });
    }
  });

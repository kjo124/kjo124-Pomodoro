'use strict';

// Register `phoneList` component, along with its associated controller and template
angular.
  module('records').
  component('records', {
    templateUrl: 'records/records.template.html',
    controller: function recordsController() {
      this.records = [
        {
          startDate: '2018-01-18',
          startTime: '12:25:13',
          class: 'Personal',
          type: 'Personal',
          assignment: 'Job'
        }, {
          startDate: '2018-01-24',
          startTime: '16:17:20',
          class: 'CS430',
          type: 'Homework',
          assignment: 'A1'
        }, {
          startDate: '2018-01-28',
          startTime: '12:51:28',
          class: 'JTC413',
          type: 'Homework',
          assignment: 'Homework #1'
        }
      ];
    }
  });

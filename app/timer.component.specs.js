'use strict';

describe('timer', function() {

  // Load the module that contains the `phoneList` component before each test
  var $timeout;
  beforeEach(module('timerApp'));
  beforeEach(inject(function(_$timeout_) {
  $timeout = _$timeout_;
  }));

  // Test the controller
  describe('timerController', function() {

      it('should test initial state, start, stop, and restart', inject(function($componentController) {

          var scope = {};
          var ctrl = $componentController('timer', {$scope: scope});

          expect(scope.displayedTimer).toBe("00:00");
          expect(scope.counter).toBe(1500);
          expect(scope.stopped).toBe(true);
          expect(scope.buttonText).toBe('Start');

          // start timer
          scope.takeAction();
          expect(scope.stopped).toBe(false);
          expect(scope.buttonText).toBe('Stop');

          // stops the time out
          $timeout.flush(3000); // not sure why this doubles to 6 seconds
          expect($timeout.verifyNoPendingTasks).toThrow();
          scope.takeAction();
          expect(scope.displayedTimer).toBe("24:54");
          expect(scope.counter).toBe(1494);
          expect(scope.stopped).toBe(true);
          expect(scope.buttonText).toBe('Start');

          // restart timer
          scope.takeAction();
          expect(scope.stopped).toBe(false);
          expect(scope.buttonText).toBe('Stop');
          $timeout.flush(3000);
          expect(scope.displayedTimer).toBe("24:48");
          expect(scope.counter).toBe(1488);
    }));

  });

});

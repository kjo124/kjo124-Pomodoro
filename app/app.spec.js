'use strict';

describe('timerController', function() {
  var $timeout;
  beforeEach(module('timerApp'));
  beforeEach(inject(function(_$timeout_) {
  $timeout = _$timeout_;
  }));


  it('should test initial state, start, stop, and restart', inject(function($controller) {
    var scope = {};
    var ctrl = $controller('timerController', {$scope: scope});

    // initial state:
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
    expect(scope.counter).toBe(1494);
    expect(scope.stopped).toBe(true);
    expect(scope.buttonText).toBe('Start');

    // restart timer
    scope.takeAction();
    expect(scope.stopped).toBe(false);
    expect(scope.buttonText).toBe('Stop');
    $timeout.flush(3000);
    expect(scope.counter).toBe(1488);
  }));

});

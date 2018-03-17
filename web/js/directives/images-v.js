cookieStoryApp.directive('csImageV', function () {
  return {
      restrict: 'EC',
      replace: true,
      scope: {image: '=image'},
      template: "<div class='col-xs-12'><img ng-src={{image}}></img></div>"
  }
});

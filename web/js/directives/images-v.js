cookieStoryApp.directive('csImageV', function () {
  return {
      restrict: 'EC',
      replace: true,
      scope: {image: '=image'},
      template: "<div class='col-xs-6'><img src={{image}}></img></div>"
  }
});

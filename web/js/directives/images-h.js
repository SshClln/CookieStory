cookieStoryApp.directive('csImageH', function () {
  return {
      restrict: 'EC',
      replace: true,
      scope: {image: '=image'},
      template: "<div class='col-xs-12'><img src={{image}}></img></div>"
  }
});

cookieStoryApp.directive('csStory', function () {
  return {
      restrict: 'EC',
      replace: true,
      scope: {story: '=story'},
      template: "<div class='col-xs-12'><h2>Il etait une fois...</h2>" +
      "<div>{{story}}</div></div>"
  }
});

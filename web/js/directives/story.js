cookieStoryApp.directive('csStory', ['$filter', '$compile', function ($filter, $compile) {
  return {
      restrict: 'EC',
      replace: true,
      scope: {story: '=story'},
      link: function (scope, element, attrs) {
        scope.story = scope.story.split ? scope.story.split("\n") : scope.story;
      },
      template: "<div class='col-xs-12'><h2>Il était une fois...</h2>" +
      "<div><span ng-repeat='st in story'><br ng-if='!$first'/>{{st}}</span></div></div>"
  }
}]);

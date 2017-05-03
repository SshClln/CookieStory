cookieStoryApp.directive('csCommentaires', function () {
  return {
      restrict: 'EC',
      replace: true,
      scope: {elements: '=elements'},
        templateUrl: 'js/templates/commentaires.html'
  }
});

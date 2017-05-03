cookieStoryApp.directive('csRecette', function () {
  return {
      restrict: 'EC',
      replace: true,
      scope: {elements: '=elements'},
      templateUrl: 'js/templates/recette.html'
  }
});

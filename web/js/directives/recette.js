cookieStoryApp.directive('csRecette', function () {
  return {
      restrict: 'EC',
      replace: true,
      scope: {elements: '=elements'},
      link: function (scope, element, attrs) {
        scope.elements.map(function (element) {
          element.recette = element.recette.split ? element.recette.split("\n") : element.recette;
        });
      },
      templateUrl: 'js/templates/recette.html'
  }
});

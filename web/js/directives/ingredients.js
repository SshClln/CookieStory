cookieStoryApp.directive('csIngredients', function () {
  return {
      restrict: 'EC',
      replace: true,
      scope: {elements: '=elements'},
        templateUrl: 'js/templates/ingredients.html'
  }
});

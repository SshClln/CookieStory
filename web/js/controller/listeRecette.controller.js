cookieStoryApp.controller('ListeRecetteCtrl', ['$scope', '$state', 'RecetteService', 'Recettes', 'Tags',
  function ($scope, $state, RecetteService, Recettes, Tags)
{
  $scope.recettes = Recettes;
  $scope.tags = Tags;

}])

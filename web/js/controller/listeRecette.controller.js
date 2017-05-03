cookieStoryApp.controller('ListeRecetteCtrl', ['$scope', '$state', 'RecetteService', 'Recettes',
  function ($scope, $state, RecetteService, Recettes)
{
  $scope.recettes = Recettes;

}])

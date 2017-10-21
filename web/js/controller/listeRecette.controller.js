cookieStoryApp.controller('ListeRecetteCtrl', ['$scope', '$state', 'RecetteService', 'Recettes', 'Tags',
  function ($scope, $state, RecetteService, Recettes, Tags)
{
  $scope.alphabet = ["A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z"];
  $scope.recettes = Recettes;
  $scope.tags = Tags;

}])

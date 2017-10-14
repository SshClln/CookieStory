cookieStoryApp.controller('ListeRecetteCtrl', ['$scope', '$state', 'RecetteService', 'Recettes', 'Tags',
  function ($scope, $state, RecetteService, Recettes, Tags)
{
  $scope.alphabet = ["a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z"];
  $scope.recettes = Recettes;
  $scope.tags = Tags;

}])

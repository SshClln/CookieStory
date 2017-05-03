cookieStoryApp.controller('adminCtrl', ['$scope', '$state', 'RecetteService', 'Recettes', 'Tags',
  function ($scope, $state, RecetteService, Recettes, Tags)
{
  $scope.recettes = Recettes;
  $scope.tags = Tags;

  $scope.newRecette = function () {
    $state.go('newRecette');
  }

  $scope.modifierRecette = function (recette) {
    $state.go('modifierRecette', {'slug': recette.slug});
  }

  $scope.deleteRecette = function (recette) {
    RecetteService.deleteRecette(recette.id).then(function() {
      $state.reload();
    });
  }

  $scope.addTag = function (nom) {
    RecetteService.addTag(nom).then(function(){
      $state.reload();
    })
  }

}])

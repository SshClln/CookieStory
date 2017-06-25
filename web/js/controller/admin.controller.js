cookieStoryApp.controller('adminCtrl', ['$scope', '$state', 'RecetteService', 'Recettes', 'Tags', 'Upload',
  function ($scope, $state, RecetteService, Recettes, Tags, Upload)
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

  $scope.deleteTag = function (tag) {
    RecetteService.removeTag(tag.id).then(function() {
      $state.reload();
    });
  }

  $scope.saveTag = function () {
    RecetteService.addTag($scope.tag).then(function(){ // {nom: binding html, image: path après upload}
      $state.reload();
    })
  }

  $scope.uploadPic = function(file) {
    file.upload = Upload.upload({
      url: 'upload',
      method: 'POST',
      file: file,
    });

    file.upload.then(function (response) {
        if (response.data.success) {
          $scope.tag.image = response.data.path;
          $scope.picFile=undefined;
        }
        else{
          console.log(response);
        }
      }, function (response) {
      }, function (evt) {
        // Math.min is to fix IE which reports 200% sometimes
        file.progress = Math.min(100, parseInt(100.0 * evt.loaded / evt.total));
      });
    }

}])

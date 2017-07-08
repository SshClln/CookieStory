cookieStoryApp.controller('RecetteCtrl', ['$scope', '$state', 'Upload', 'RecetteService', 'Recette', 'Tags',
  function ($scope, $state, Upload, RecetteService, Recette, Tags)
{

  $scope.recette = Recette || {commentaires:[], tags:[]};
  $scope.tags = Tags;
  $scope.countCommentaire = $scope.recette.commentaires.length;

  var position = 1;

  $scope.contenuText='';
  $scope.contenuList = [];

if (Recette){
  $scope.layout=Recette.layout;
}
else{
  $scope.layout = [];
}

  $scope.addElement = function (element, contenu, pos) {
    if (element == 'titre') {
      $scope.layout.push({item:'titre', position:pos ? pos : position, contenu:contenu})
      $scope.recette.titre = contenu;
    }
    if (element == 'imageH') {
      $scope.layout.push({item:'imageH', position:pos ? pos : position, contenu:contenu})
    }
    if (element == 'story') {
      $scope.layout.push({item:'story', position:pos ? pos : position, contenu:contenu})
    }
    if (element == 'recette') {
      $scope.layout.push({item:'recette', position:pos ? pos : position, contenu:contenu})
    }
    if (element == 'ingredients') {
      $scope.layout.push({item:'ingredients', position:pos ? pos : position, contenu:contenu})
    }
    position++;
    $scope.contenuText='';
    $scope.contenuList = [];
    $scope.positionEdition = undefined;
  }

  $scope.deleteElement = function (position) {
    $scope.layout.splice(position, 1);
  }

  $scope.modifierElement = function (element, index) {
    trierLayoutParPosition();
    if (element.item == 'titre' || element.item =='story') {
      $scope.contenuText = element.contenu;
      $scope.layout.splice(index, 1);
      $scope.positionEdition = element.position;
    }
    if (element.item == 'ingredients' || element.item =='recette') {
      $scope.contenuList = element.contenu;
      $scope.layout.splice(index, 1);
      $scope.positionEdition = element.position;
    }
  }

  $scope.monterElement = function (position) {
    var positionTmp = $scope.layout[position]['position'];
    $scope.layout[position]['position'] = $scope.layout[--position]['position'];
    $scope.layout[position]['position'] = positionTmp;
    trierLayoutParPosition();
  }

  $scope.descendreElement = function (position) {
    var positionTmp = $scope.layout[position]['position'];
    $scope.layout[position]['position'] = $scope.layout[++position]['position'];
    $scope.layout[position]['position'] = positionTmp;
    trierLayoutParPosition();
  }

  var trierLayoutParPosition = function () {
    $scope.layout = $scope.layout.sort(function (elementA, elementB) {
      if (elementA.position < elementB.position) {
        return -1;
      }
      else {
        return 1;
      }
    })
  }

  $scope.addCommentaire = function (form){
    if (form.$valid) {
      var commentaire = {pseudo:$scope.pseudo, contenu:$scope.contenu, mail:$scope.mail, website:$scope.website, recetteId:$scope.recette.id}
      RecetteService.saveCommentaire(commentaire).then(function(){
        $state.reload();
      });
    }
  }

  $scope.addRecette = function () {
    var recette = {titre:$scope.recette.titre, layout:$scope.layout}
    if ($scope.recette.id) {
      recette.id = $scope.recette.id;
    }
    RecetteService.saveRecette(recette).then(function () {
      $state.go('pageAdmin');
    });
  }

  $scope.deleteRecette = function () {
    RecetteService.deleteRecette($scope.recette.id).then(function() {
      $state.go('home');
    });
  }

  $scope.addTagToRecette = function (tag) {
      RecetteService.addTagToRecette(tag.id, $scope.recette.id).then(function (response) {
          $scope.recette.tags.push(tag);
      });
  }

  $scope.removeTagFromRecette = function (tag) {
      RecetteService.removeTagFromRecette(tag.id, $scope.recette.id).then(function (response) {
        $scope.recette.tags.sort(function (tagA, tagB) {
          return tagB.id == tag.id
        }).shift();
      });
  }

  $scope.uploadPic = function(file) {
    file.upload = Upload.upload({
      url: 'upload',
      method: 'POST',
      file: file,
    });

    file.upload.then(function (response) {
        if (response.data.success) {
          $scope.addElement("imageH", response.data.path)
          $scope.picFile=undefined;
        }
      }, function (response) {
      }, function (evt) {
        // Math.min is to fix IE which reports 200% sometimes
        file.progress = Math.min(100, parseInt(100.0 * evt.loaded / evt.total));
      });
    }

    $scope.isNotSelectedTag = function (tag) {
      return !$scope.recette.tags.some(function (tagRecette) {
        return tagRecette.id == tag.id;
      })
    }
}])

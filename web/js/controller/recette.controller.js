cookieStoryApp.controller('RecetteCtrl', ['$scope', '$state', 'Upload', 'RecetteService', 'Recette', 'Tags',
  function ($scope, $state, Upload, RecetteService, Recette, Tags)
{

  $scope.recette = Recette || {commentaires:[], tags:[]};
  $scope.tags = Tags;
  $scope.countCommentaire = $scope.recette.commentaires.length;


  $scope.contenuText='';
  $scope.contenuList = [];

if (Recette){
  $scope.layout=Recette.layout;
  var position = Math.max.apply(null,Recette.layout.map(function(o){return o.position;}))+1;
}
else{
  $scope.layout = [];
  var position = 1;
}

  $scope.addElement = function (element, contenu, pos) {
    console.log(contenu);
    if (element == 'titre') {
      $scope.layout.push({item:'titre', position:pos ? pos : position, contenu:contenu})
      $scope.recette.titre = contenu;
    }
    if (element == 'imageH') {
      $scope.layout.push({item:'imageH', position:pos ? pos : position, contenu:contenu})
    }
    if (element == 'imageV') {
      $scope.layout.push({item:'imageV', position:pos ? pos : position, contenu:contenu})
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
    trierLayoutParPosition();
  }

  $scope.deleteElement = function (position) {
    $scope.layout.splice(position, 1);
    trierLayoutParPosition();
  }

  $scope.modifierElement = function (element, index) {
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
    trierLayoutParPosition();
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
      $state.go('admin.pageAdmin');
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

  $scope.uploadPic = function(file, orientation) {
    file.upload = Upload.upload({
      url: 'upload',
      method: 'POST',
      file: file,
    });

    file.upload.then(function success (response) {
      if (response.data.success) {
        if (orientation === 'V') {
          console.log('V');
          $scope.addElement("imageV", response.data.path)
        }
        else if (orientation === 'H') {
          console.log('H');
          $scope.addElement("imageH", response.data.path)
        }
        $scope.picFile=undefined;
      }
    }, function error (response) {
    });
  }

  $scope.isNotSelectedTag = function (tag) {
    return !$scope.recette.tags.some(function (tagRecette) {
      return tagRecette.id == tag.id;
    })
  }
}])

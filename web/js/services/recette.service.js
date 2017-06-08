cookieStoryApp.service('RecetteService', ['$http', function ($http) {

  this.getRecette = function (slug) {
    return $http.get('recette/find?slug='+slug);
  }

  this.listeRecette = function () {
    return $http.get('recette/liste');
  }

  this.listeTags = function () {
    return $http.get('tags/liste');
  }

  this.saveRecette = function (recette) {
    return $http.post('recette/save', {'recette':recette});
  }

  this.deleteRecette = function (id) {
    return $http.delete('recette/delete?id='+id);
  }

  this.saveCommentaire = function (commentaire) {
    return $http.post('recette/saveCommentaire', {'commentaire':commentaire});
  }

  this.addTag = function (nom){
    return $http.post('saveTag',{'nom':nom});
  }

  this.addTagToRecette = function (tag, recette){
    return $http.post('saveTagToRecette',{'tag':tag, 'recette':recette});
  }

  this.removeTagFromRecette = function (tag, recette){
    return $http.post('removeTagFromRecette',{'tag':tag, 'recette':recette});
  }
}])

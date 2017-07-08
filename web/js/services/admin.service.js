cookieStoryApp.service('AdminService', ['$http', function ($http) {

  this.connexion = function (admin) {
    return $http.post('admin/connect', {'admin':admin});
  }

}])

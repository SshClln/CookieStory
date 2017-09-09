cookieStoryApp.controller('ConnexionCtrl', ['$scope', '$state', 'Admin', 'AuthService',
  function ($scope, $state, Admin, AuthService)
{
  $scope.connexion = function (identifiant, password){
    var admin = {identifiant:identifiant,password:password}
    AuthService.login(admin).then(function(response){
      if(response.data.id){
        $state.go('admin.pageAdmin');
      }else{

      }
    });
  }

}])

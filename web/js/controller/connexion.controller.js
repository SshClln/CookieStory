cookieStoryApp.controller('ConnexionCtrl', ['$scope', '$state', 'Admin', 'AdminService',
  function ($scope, $state, Admin, AdminService)
{
  $scope.connexion = function (identifiant, password){
    var admin = {identifiant:identifiant,password:password}
    AdminService.connexion(admin).then(function(response){
      if(response.data.status=="ok"){
        $state.go('pageAdmin');
      }else{

      }
    });
  }

}])

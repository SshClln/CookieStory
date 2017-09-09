cookieStoryApp.service('AuthService', ['$resource', '$http', '$q', '_', function($resource, $http, $q, _) {
  var user = JSON.parse(localStorage.getItem('auth_user'));
  var roles = JSON.parse(localStorage.getItem('auth_roles'));
  var rights = JSON.parse(localStorage.getItem('auth_rights'));

  function setUser(value) {
    user = value;
    localStorage.setItem('auth_user', JSON.stringify(user));
  }

  function setRoles(values) {
      roles = values;
      localStorage.setItem('auth_roles', JSON.stringify(roles));
  }

  function setRights(values) {
      rights = values;
      localStorage.setItem('auth_rights', JSON.stringify(rights));
  }

  this.login = function(admin) {
      var deferred = $q.defer();
      $http.post('admin/connect', {'admin':admin})
        .then(function(response) {
          var user = response.data;
          if (user.id) {
            setUser(user);

            //Set Roles and Rights
            setRoles(["SUPER_ADMIN"]); // ["super_admin"]
            setRights(["admin.read"]); // ["admin.read"]

            deferred.resolve(response);
          }
          else {
            deferred.reject(response);
          }
      }, function(response) {
          var err = response.data;
          deferred.reject(err);
      });
      return deferred.promise;
  };

  this.logout = function() {
      setUser(null);
      setRoles([]);
      setRights([]);

      return $http.get('auth/logout');
  };

  this.isAuthenticated = function() {
      return user !== null;
  };

  this.isAuthorized = function(authorizedRights) {
      //console.log("authorizedRights : " + JSON.stringify(authorizedRights));
      if(authorizedRights.length == 0 || _.intersection(rights, authorizedRights).length > 0 ) {
          return true;
      } else {
          return false;
      }
  };

  this.getAuthenticatedUser = function() {
      return user;
  };
}]);

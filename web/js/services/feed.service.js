cookieStoryApp.service('FeedService', ['$http', function ($http) {

  this.getFeed = function (admin) {
    return $http.get('feed');
  }

}])

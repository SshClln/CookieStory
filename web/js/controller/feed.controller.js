cookieStoryApp.controller('feedCtrl', ['$scope', 'FeedService',
  function ($scope, FeedService)
{

  $scope.images = [];

  FeedService.getFeed().then(function (res) {
    res.data.data.forEach(function (data) {
      var image = {
        link: data.link,
        src: data.images.thumbnail.url
      }

      $scope.images.push(image);
    })
  })
}])

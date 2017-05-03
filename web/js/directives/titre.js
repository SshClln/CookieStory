cookieStoryApp.directive('csTitre', function () {
  return {
      restrict: 'EC',
      replace: true,
      scope: {titre: '=titre'},
      template: "<div class='col-xs-12'><h1>{{titre}}</h1></div>"
  }
});

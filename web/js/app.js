// Define the `cookieStoryApp` module
var cookieStoryApp = angular.module('cookieStoryApp', ['ui.router', 'ngFileUpload']);

cookieStoryApp.config(function($stateProvider, $urlRouterProvider) {

    $urlRouterProvider.otherwise('/');

    $stateProvider
        // HOME STATES AND NESTED VIEWS ========================================
        .state('home', {
            url: '/',
            templateUrl: 'views/home.html',
            controller: 'ListeRecetteCtrl',
            resolve: {
              Recettes: function (RecetteService) {
                return RecetteService.listeRecette().then(function (result) {
                  return result.data;
                });
              },
            }
        })
        .state('recette', {
            url: '/recette/{slug}',
            templateUrl: 'views/recette.html',
            controller: 'RecetteCtrl',
            resolve: {
              Recette: function ($stateParams, RecetteService) {
                return RecetteService.getRecette($stateParams.slug).then(function siToutEstBon (result) {
                  return result.data;
                }, function siQqchPlante() {

                }, function pendantQueLaRequeteEstTraitée() {

                })
              },
              Tags: function (RecetteService) {
                return RecetteService.listeTags().then(function (result) {
                  return result.data;
                });
              },
            }
        })
        .state('newRecette', {
            url: '/recette',
            templateUrl: 'views/add.recette.html',
            controller: 'RecetteCtrl',
            resolve: {
              Recette: function () {
                return null;
              },
              Tags: function (RecetteService) {
                return RecetteService.listeTags().then(function (result) {
                  return result.data;
                });
              },
            }
        })
        .state('modifierRecette', {
            url: '/modifRecette/{slug}',
            templateUrl: 'views/add.recette.html',
            controller: 'RecetteCtrl',
            resolve: {
              Recette: function ($stateParams, RecetteService) {
                return RecetteService.getRecette($stateParams.slug).then(function siToutEstBon (result) {
                  return result.data;
                }, function siQqchPlante() {

                }, function pendantQueLaRequeteEstTraitée() {

                })
              },
              Tags: function (RecetteService) {
                return RecetteService.listeTags().then(function (result) {
                  return result.data;
                });
              },
            }
        })
        .state('indexRecette', {
            url: '/index',
            templateUrl: 'views/index.html',
            controller: 'ListeRecetteCtrl',
            resolve: {
              Recettes: function (RecetteService) {
                return RecetteService.listeRecette().then(function (result) {
                  return result.data;
                });
              },
            }
        })
        .state('pageAdmin', {
            url: '/admin',
            templateUrl: 'views/pageAdmin.html',
            controller: 'adminCtrl',
            resolve: {
              Recettes: function (RecetteService) {
                return RecetteService.listeRecette().then(function (result) {
                  return result.data;
                });
              },
              Tags: function (RecetteService) {
                return RecetteService.listeTags().then(function (result) {
                  return result.data;
                });
              },
            }
        })
});

cookieStoryApp.filter('reverse', function() {
  return function(input) {
    return input.slice().reverse();
  };
});

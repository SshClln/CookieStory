// Define the `cookieStoryApp` module
var cookieStoryApp = angular.module('cookieStoryApp', ['ui.router', 'ngFileUpload', 'ngResource']);
cookieStoryApp.constant('_', window._);


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
              Tags: function (RecetteService) {
                return RecetteService.listeTags().then(function (result) {
                  return result.data;
                });
              },
            }
        })
        .state('connexion', {
            url: '/connect',
            templateUrl: 'views/connexion.html',
            controller: 'ConnexionCtrl',
            resolve: {
              Admin: function (AdminService) {
                return null;
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
              Tags: function (RecetteService) {
                return RecetteService.listeTags().then(function (result) {
                  return result.data;
                });
              },
            }
        })
        .state('categories', {
            url: '/categories',
            templateUrl: 'views/categories.html',
            controller: 'ListeRecetteCtrl',
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
        .state('categorieListeRecette', {
            url: '/categorie/{slug}',
            templateUrl: 'views/categorieListeRecette.html',
            controller: 'ListeRecetteCtrl',
            resolve: {
              Recettes: function (RecetteService, $stateParams) {
                return RecetteService.listeRecetteByTag($stateParams.slug).then(function (result) {
                  return result.data;
                });
              },
              Tags: function () {
                return [];
              },
            }
        })
        .state('admin', {
            url: "/admin",
            abstract: true,
            templateUrl: 'views/admin.html',
            data: {
                authorizedRights: ['admin.read'],
                redirect: 'connexion'
            },
        })
        .state('admin.pageAdmin', {
            url: '/gestion',
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

cookieStoryApp.run(function ($state, AuthService, $rootScope) {
    $rootScope.$on('$stateChangeStart', function (event, next, nextParams, fromState) {
        if ('data' in next && 'authorizedRights' in next.data) {
            var authorizedRights = next.data.authorizedRights;
            if (!AuthService.isAuthorized(authorizedRights)) {
                event.preventDefault();
                $state.go(next.data.redirect);
            }
        }
    });
});



cookieStoryApp.filter('reverse', function() {
  return function(input) {
    return input.slice().reverse();
  };
});

/**
 * Angular App for the Seniors module
 */
(function(){
	var app = angular.module('seniors', ['lrfsDirectives', 'ngRoute', 'lrfsController']);
	// Definition du routage URL -> PAGE
	app.config(['$routeProvider', function($routeProvider) {
    $routeProvider.when('/newDivision', {
        templateUrl: 'divisions/new-division.php',
        controller: 'NewDivisionCtrl'
      }).
	when('/newClubs', {
        templateUrl: 'clubs/new-clubs.php',
        controller: 'NewClubCtrl'
      }).
	when('/editClubs', {
        templateUrl: 'clubs/edit-clubs.php',
        controller: 'EditClubCtrl'
      }).
	when('/statClubs', {
        templateUrl: 'clubs/stat-clubs.php',
        controller: 'StatClubCtrl'
      }).
	when('/newJoueurs', {
        templateUrl: 'joueurs/new-joueurs.php',
        controller: 'NewJoueurCtrl'
      }).
	when('/editJoueurs', {
        templateUrl: 'joueurs/edit-joueurs.php',
        controller: 'EditJoueurCtrl'
      }).
    when('/ctrlDuplicationJoueurs', {
      templateUrl: 'joueurs/ctrl-duplication-joueurs.php',
      controller: 'DuplicationJoueurCtrl'
    }).
    when('/detailsStats', {
        templateUrl: 'statistiques/details-stats.php',
        controller: 'DetailsStatsCtrl'
      }).
	when('/graphicStats', {
        templateUrl: 'statistiques/graphic-stats.php',
        controller: 'GraphicStatsCtrl'
      }).
    otherwise({
        redirectTo: './'
      });
	}]);
})();
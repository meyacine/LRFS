/**
 * lrfs seniors angular directives
 */

(function(){
	var app = angular.module('lrfsDirectives', []);
	
	// menu directive using the controller whish uses the menus.json file definition
	app.directive('seniorsMenu', function() {
		return {
			restrict: 'E',
			templateUrl: 'seniors-menu.html',
			controller:function($http){
				var menuPages = this;
				menuPages.pagesDefinition = [];
				$http.get('./menus.json').success(function(data){
					menuPages.pagesDefinition = data;
				});
			},
			controllerAs:'pages'
			};			
	});
})();
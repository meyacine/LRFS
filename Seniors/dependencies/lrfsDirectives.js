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
	// directive pour la liste des clubs
	app.directive('clubsList', function(){
		return {
			restrict: 'E',
			templateUrl: './clubs/clubs-list.html',
			controller:function($scope,$http){
				var clubsList = this;
				clubsList.list = [];
				$scope.method = 'GET';
			    $scope.url = "./controller.php?method=gcl";
			    $scope.data = "";
			    $http(
		        		{
				            method: $scope.method, 
				            url: $scope.url,
				            headers: {'Content-Type': 'application/json'}
		        		}).
		        success(
		        		function(response) 
		        		{
		        			clubsList.list = response;				        			
		        		}			        		
        		).error(function(response) {$scope.data = response || "Request failed";});
			},
			controllerAs: 'clubsListCtrl'
		};
	});
	// directive pour la liste des divisions
	app.directive('divisionsList', function(){
		return {
			restrict: 'E',
			templateUrl: './divisions/divisions-list.html',
			controller:function($scope,$http){
				var divisionsList = this;
				divisionsList.list = [];
				$scope.method = 'GET';
			    $scope.url = "./controller.php?method=gdl";
			    $scope.data = "";
			    $http(
		        		{
				            method: $scope.method, 
				            url: $scope.url,
				            headers: {'Content-Type': 'application/json'}
		        		}).
		        success(
		        		function(response) 
		        		{
		        			divisionsList.list = response;				        			
		        		}			        		
        		).error(function(response) {$scope.data = response || "Request failed";});
			},
			controllerAs: 'divisionsListCtrl'
		};
	});
	// directive pour la liste des wilayas
	app.directive('wilayasList', function(){
		return {
			restrict: 'E',
			templateUrl: 'wilayas-list.html',
			controller:function($scope,$http){
				var wilayasList = this;
				wilayasList.list = [];
				$scope.method = 'GET';
			    $scope.url = "./controller.php?method=gwl";
			    $scope.data = "";
			    $http(
		        		{
				            method: $scope.method, 
				            url: $scope.url,
				            headers: {'Content-Type': 'application/json'}
		        		}).
		        success(
		        		function(response) 
		        		{
		        			wilayasList.list = response;				        			
		        		}			        		
        		).error(function(response) {$scope.data = response || "Request failed";});
			},
			controllerAs: 'wilayasListCtrl'
		};
	});
	// directive pour la liste des ligues
	app.directive('liguesList', function(){
		return {
			restrict: 'E',
			templateUrl: 'ligues-list.html',
			controller:function($scope,$http){
				var liguesList = this;
				liguesList.list = [];
				$scope.method = 'GET';
			    $scope.url = "./controller.php?method=gll";
			    $scope.data = "";
			    $http(
		        		{
				            method: $scope.method, 
				            url: $scope.url,
				            headers: {'Content-Type': 'application/json'}
		        		}).
		        success(
		        		function(response) 
		        		{
		        			liguesList.list = response;				        			
		        		}			        		
        		).error(function(response) {$scope.data = response || "Request failed";});
			},
			controllerAs: 'liguesListCtrl'
		};
	});
})();
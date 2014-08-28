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
			require: 'ngModel',
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
	// directive pour les informations de clubs pour le tableau
	app.directive('informationsClubs', function(){
		return {
			restrict: 'E',
			require: 'ngModel',
			templateUrl: './clubs/informations-clubs.html',
			controller:function($scope,$http){
				var clubsInformations = this;
				clubsInformations.list = [];
				$scope.method = 'GET';
			    $scope.url = "./controller.php?method=gci";
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
		        			clubsInformations.list = response;				        			
		        		}			        		
        		).error(function(response) {$scope.data = response || "Request failed";});
			},
			controllerAs: 'clubsInformationsCtrl'
		};
	});
	// directive pour la liste des divisions
	app.directive('divisionsList', function(){
		return {
			restrict: 'E',
			require: 'ngModel',
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
	// directive pour la liste des saisons
	app.directive('saisonsList', function(){
		return {
			restrict: 'E',
			require: 'ngModel',
			templateUrl: 'saisons-list.html',
			controller:function($scope,$http){
				var saisonsList = this;
				saisonsList.list = [];
				$scope.method = 'GET';
			    $scope.url = "./controller.php?method=gsl";
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
		        			saisonsList.list = response;				        			
		        		}			        		
        		).error(function(response) {$scope.data = response || "Request failed";});
			},
			controllerAs: 'saisonsListCtrl'
		};
	});
	// directive pour la liste des wilayas
	app.directive('wilayasList', function(){
		return {
			restrict: 'E',
			require: 'ngModel',
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
			require: 'ngModel',
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
	// validation des input de type fichier
	app.directive('validFile',function(){
		  return {
		    require:'ngModel',
		    link:function(scope,el,attrs,ngModel){
		      //change event is fired when file is selected
		      el.bind('change',function(){
		        scope.$apply(function(){
		          ngModel.$setViewValue(el.val());
		          ngModel.$render();
		        });
		      });
		    }
		  }
	});
})();
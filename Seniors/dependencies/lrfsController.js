/**
 * 
 */

(function(){
	var lrfsController = angular.module('lrfsController', []);
	lrfsController.controller('NewDivisionCtrl', function($scope, $http, $templateCache){
		this.libDiv = "";
		this.matLigue = "";
		this.checkFormular = function(){
			if (this.libDiv === undefined)
				{
				alert('error');
				}
			else {
				$('#msg').
				html(
				"<div class=\"alert alert-warning alert-dissimible\" role=\"alert\">"
        			+"<button type=\"button\" class=\"close\" data-dismiss=\"alert\"><span aria-hidden=\"true\">&times;</span><span class=\"sr-only\">Fermer</span></button>"
        		    +"<strong>Operation en cours!</strong> Ajout division!."
    		    +"</div>");
				$scope.method = 'GET';				
			    $scope.url = "./controller.php?method=id&libDiv="+this.libDiv+"&matLigue="+$scope.matLigue;
			    $scope.data = "";
		        $http({
		            method: $scope.method, 
		            url: $scope.url
		        }).
		        success(
		        		function(response) 
		        		{
		        			$('#msg').
		    				html(
    						"<div class=\"alert alert-success alert-dissimible\" role=\"alert\">"
			        			+"<button type=\"button\" class=\"close\" data-dismiss=\"alert\"><span aria-hidden=\"true\">&times;</span><span class=\"sr-only\">Fermer</span></button>"
			        		    +"<strong>Succ&egrave;s!</strong> Division inser&eacute;e!."
		        		    +"</div>"
		        		    );				        			
		        		}
		        		
				).
		        error(function(response) {
		            $scope.data = response || "Request failed";
		        });
			}
		}
	});
	lrfsController.controller('NewClubCtrl', function($scope, $http, $templateCache){
		$scope.photoClub=""
		this.method="ic";
		this.nomClub="";
		this.nomCompletClub="";
		this.adressClub="";
		this.dateCreationClub="";
		this.numAgrement="";
		this.numTel="";
		this.numFax="";
		this.emailClub="";
		this.photoClub="";
		this.formSubmitted = function(){
			$('#msg').
			html(
			"<div class=\"alert alert-warning alert-dissimible\" role=\"alert\">"
    			+"<button type=\"button\" class=\"close\" data-dismiss=\"alert\"><span aria-hidden=\"true\">&times;</span><span class=\"sr-only\">Fermer</span></button>"
    		    +"<strong>Operation en cours!</strong> Ajout Clubs!."
		    +"</div>");
			var formData = new FormData($("#window").context.forms[0])
			$.ajax( {
			      url: 'upload.php',
			      type: 'POST',
			      data: formData,
			      processData: false,
			      contentType: false,
			      success: function (response) {
			    	  $('#msg').
						html(
						"<div class=\"alert alert-success alert-dissimible\" role=\"alert\">"
			    			+"<button type=\"button\" class=\"close\" data-dismiss=\"alert\"><span aria-hidden=\"true\">&times;</span><span class=\"sr-only\">Fermer</span></button>"
			    		    +"<strong>Operation en cours!</strong> Image charg&eacute;e."
					    +"</div>");
			        },
		          error: function (response){
		        	  $('#msg').
						html(
						"<div class=\"alert alert-danger alert-dissimible\" role=\"alert\">"
			    			+"<button type=\"button\" class=\"close\" data-dismiss=\"alert\"><span aria-hidden=\"true\">&times;</span><span class=\"sr-only\">Fermer</span></button>"
			    		    +"<strong>Erreur!</strong> chargement image en Echec."
					    +"</div>");
				    }
			    } );
			$http({ 
	            url: $scope.url,
	            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
	            method 		: 'POST',
				url 		: 'controller.php',
				data 		: '&method=ic'+
				'&matDivision='+$scope.matDivision+
				'&matLigue='+$scope.matLigue+
				'&matSaison='+$scope.matSaison+
				'&matWilaya='+$scope.matWilaya+
				'&nomClub='+this.nomClub+
				'&nomCompletClub='+this.nomCompletClub+
				'&adressClub='+this.adressClub+
				'&dateCreationClub='+this.dateCreationClub+
				'&numAgrement='+this.numAgrement+
				'&numTel='+this.numTel+
				'&numFax='+this.numFax+
				'&emailClub='+this.emailClub+
				'&photoClub='+this.photoClub
	        }).
	        success(
	        		function(response) 
	        		{
	        			$('#msg').
	    				html(
						"<div class=\"alert alert-success alert-dissimible\" role=\"alert\">"
		        			+"<button type=\"button\" class=\"close\" data-dismiss=\"alert\"><span aria-hidden=\"true\">&times;</span><span class=\"sr-only\">Fermer</span></button>"
		        		    +"<strong>Succ&egrave;s!</strong> Club inser&eacute;!."
	        		    +"</div>"
	        		    );				        			
	        		}
			).
	        error(function(response) {
	            $('#msg').
						html(
						"<div class=\"alert alert-danger alert-dissimible\" role=\"alert\">"
			    			+"<button type=\"button\" class=\"close\" data-dismiss=\"alert\"><span aria-hidden=\"true\">&times;</span><span class=\"sr-only\">Fermer</span></button>"
			    		    +"<strong>Erreur</strong> "+response+
					    +"</div>");
	        });
		}
	});
	lrfsController.controller('EditClubCtrl', function($scope, $http, $templateCache){});
	lrfsController.controller('StatClubCtrl', function($scope, $http, $templateCache){});
	lrfsController.controller('NewMembreCtrl', function($scope, $http, $templateCache){
			this.method="im";
			this.nomMembre="";
			this.prenomMembre="";
			this.dateNaissanceMembre="";
			this.communeNaissanceMembre="";
			this.numAct="";
			this.parentMembre="";
			this.adrMembre="";
			this.groupSanguin="";
			this.finValidite="";
			this.duree="";
			this.dossard="";
			this.photoMembre="";
			this.formSubmitted = function(){
				$('#msg').
				html(
				"<div class=\"alert alert-warning alert-dissimible\" role=\"alert\">"
	    			+"<button type=\"button\" class=\"close\" data-dismiss=\"alert\"><span aria-hidden=\"true\">&times;</span><span class=\"sr-only\">Fermer</span></button>"
	    		    +"<strong>Operation en cours!</strong> Ajout Membre!."
			    +"</div>");
				var formData = new FormData($("#window").context.forms[0])
				$.ajax( {
				      url: 'upload.php',
				      type: 'POST',
				      data: formData,
				      processData: false,
				      contentType: false,
				      success: function (response) {
				    	  $('#msg').
							html(
							"<div class=\"alert alert-success alert-dissimible\" role=\"alert\">"
				    			+"<button type=\"button\" class=\"close\" data-dismiss=\"alert\"><span aria-hidden=\"true\">&times;</span><span class=\"sr-only\">Fermer</span></button>"
				    		    +"<strong>Operation en cours!</strong> Image charg&eacute;e."
						    +"</div>");
				        },
			          error: function (response){
			        	  $('#msg').
							html(
							"<div class=\"alert alert-danger alert-dissimible\" role=\"alert\">"
				    			+"<button type=\"button\" class=\"close\" data-dismiss=\"alert\"><span aria-hidden=\"true\">&times;</span><span class=\"sr-only\">Fermer</span></button>"
				    		    +"<strong>Erreur!</strong> chargement image en Echec."
						    +"</div>");
					    }
				}); // upload section end
				// Insertion BDD
				$http({ 
		            url: $scope.url,
		            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
		            method 		: 'POST',
					url 		: 'controller.php',
					data 		: '&method=im'+
					'&matDivision='+$scope.matDivision+
					'&matClub='+$scope.matClub+
					'&matSaison='+$scope.matSaison+
					'&matWilaya='+$scope.matWilaya+
					'&nomMembre='+this.nomMembre+
					'&prenomMembre='+this.prenomMembre+
					'&dateNaissanceMembre='+this.dateNaissanceMembre+
					'&communeNaissanceMembre='+this.communeNaissanceMembre+
					'&numAct='+this.numAct+
					'&parentMembre='+this.parentMembre+
					'&adrMembre='+this.adrMembre+
					'&groupSanguin='+this.groupSanguin+
					'&finValidite='+this.finValidite+
					'&duree='+this.duree+
					'&dossard='+this.dossard+
					'&photoMembre='+this.photoMembre
		        }).
		        success(
		        		function(response) 
		        		{
		        			if (response[0]!==undefined){
	        				$('#msg').
		    				html(
							"<div class=\"alert alert-danger alert-dissimible\" role=\"alert\">"
			        			+"<button type=\"button\" class=\"close\" data-dismiss=\"alert\"><span aria-hidden=\"true\">&times;</span><span class=\"sr-only\">Fermer</span></button>"
			        		    +"<strong>Erreur!</strong> "
			        		    +response[0].erreur
		        		    +"</div>");
		        			} else {
			        			$('#msg').
			    				html(
								"<div class=\"alert alert-success alert-dissimible\" role=\"alert\">"
				        			+"<button type=\"button\" class=\"close\" data-dismiss=\"alert\"><span aria-hidden=\"true\">&times;</span><span class=\"sr-only\">Fermer</span></button>"
				        		    +"<strong>Succ&egrave;s!</strong> Membre inser&eacute;!."
			        		    +"</div>"
			        		    );		
		        			}
		        		}
				).
		        error(function(response) {
		            $('#msg').
							html(
							"<div class=\"alert alert-danger alert-dissimible\" role=\"alert\">"
				    			+"<button type=\"button\" class=\"close\" data-dismiss=\"alert\"><span aria-hidden=\"true\">&times;</span><span class=\"sr-only\">Fermer</span></button>"
				    		    +"<strong>Erreur</strong> "+response+
						    +"</div>");
		        });
			}
	});
	lrfsController.controller('EditJoueurCtrl', function($scope, $http, $templateCache){});
	lrfsController.controller('DuplicationJoueurCtrl', function($scope, $http, $templateCache){});
	lrfsController.controller('DetailsStatsCtrl', function($scope, $http, $templateCache){});
	lrfsController.controller('GraphicStatsCtrl', function($scope, $http, $templateCache){
	// Here is the graphic code
	// 1 - first one concerns pie chart for the count of members per wilaya
		$scope.method = 'GET';
		$scope.url = "./controller.php?method=gnmpw";
		$scope.data = "";
		$http({
			method: $scope.method, 
			url: $scope.url,
			headers: {'Content-Type': 'application/json'}
		}).
		success(
				function(response) 
				{
					displayPieChart(response);				        			
				}
				
		).
		error(function(response) {
			$scope.data = response || "Request failed";
		});
	});
	function displayPieChart(data)
	{
		var chartData = [];
        $.each(data, function(i, result) {
            chartData.push(result);
        });
        this.nombreParWilayaChart = new AmCharts.AmPieChart();
        this.nombreParWilayaChart.titleField = "lib_wil";
        this.nombreParWilayaChart.valueField = "nbr_mem";
        this.nombreParWilayaChart.dataProvider = chartData;
        var legend = new AmCharts.AmLegend();
        legend.align="center";
        legend.markerType="circle";
        this.nombreParWilayaChart.addLegend(legend);
        this.nombreParWilayaChart.balloonText = "<b> Wilaya : </b> [[lib_wil]] <b> Nombre :</b> [[value]] <b> Taux : </b> ([[percents]]%) ";
        // TODO add title for the chart here 
        this.nombreParWilayaChart.write("wilayaCountdiv");
        if (data.length==0) $('#wilayaCountdiv').html("<center><span id=\"animationSandbox\" style=\"display: block;\" class=\"rubberBand animated\"><img src=\"../css/images/sorry.png\"></span><span id=\"animationSandbox\" style=\"display: block;\" class=\"zoomIn animated\"><h2>Aucun membre ne semble &ecirc;tre pr&eacutesent sur la BDD. </h2></span></center>");
	}
})();

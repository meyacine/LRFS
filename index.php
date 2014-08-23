<!DOCTYPE html>
<html lang="en" ng-app="best">
<head>
	<meta charset="UTF-8">
	<title>LRFS::Plateforme de gestion des licenes de joueurs/Dirigeants de la ligue</title>
	<meta author="Maamar Yacine MEDDAH"></meta>
	<!-- used styleSheets-->
	<link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/jquery-ui.css" rel="stylesheet">
	<!-- required js libraries -->
	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/jquery-ui.js"></script>
	<script src="js/bootstrap.js"></script>
</head>
<body>	
	<nav class="navbar navbar-default" role="navigation">
	  <div class="container-fluid">
	    <!-- Brand and toggle get grouped for better mobile display -->
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <a class="navbar-brand" href="#">LRFS</a>
	    </div>
	
	    <!-- Collect the nav links, forms, and other content for toggling -->
	    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	      <ul class="nav navbar-nav">
	        <li class="dropdown">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Cat&eacute;gories<span class="caret"></span></a>
	          <ul class="dropdown-menu" role="menu">
	            <li><a href="./Seniors">Seniors</a></li>
	            <li><a href="./U20">U20</a></li>
	            <li><a href="./U18">U18</a></li>
	            <li><a href="./U17">U17</a></li>
	            <li><a href="./U15">U15</a></li>
	            <li><a href="./U13">U13</a></li>
	            <li class="divider"></li>
	            <li><a href="./Dirigeants">Dirigeants</a></li>
	            <li><a href="./Entraineurs">Entraineurs</a></li>
	            <li class="divider"></li>
	            <li><a href="./Arbitres">Arbitres</a></li>
	          </ul>
	        </li>
	      </ul>
	      <ul class="nav navbar-nav navbar-right">
	        <li><a href="#">&Agrave; propos</a></li>
	      </ul>
	    </div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>
</body>
<?php
	require_once 'LrfsUtils.php';
	$lrfsUtils = new LrfsUtils();
	$lrfsUtils->parseDatabasePropetiesFile();
	
?>
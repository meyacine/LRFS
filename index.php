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
	        <li><a data-toggle="modal" data-target="#aPropos">&Agrave; propos</a></li>
	      </ul>
	    </div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>	
	<!-- Modal -->
	<div class="modal fade" id="aPropos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	        <h4 class="modal-title" id="myModalLabel">&Agrave; propos du Developpeur</h4>
	      </div>
	      <div class="modal-body">
	        <H3>Maamar Yacine MEDDAH</H3>
	        <p><b>Tel: </b>+33 (0)6 58 66 85 67</p>
	        <p><b>Email: </b>my.meddah@gmail.com</p>
	        <p><b>Technical support : skype : ycn.ceh or Viber</p>
	        <p><b>GitHub : </b><a href="https://github.com/meyacine/">https://github.com/meyacine/</a></p>
	        <p><b>LinkedIn : </b><a href="https://www.linkedin.com/pub/maamar-yacine-meddah/84/699/583">https://www.linkedin.com/pub/maamar-yacine-meddah/84/699/583</a></p>
	        <p>This sofware is a gift for Daddy Mr. Abdelkrim MEDDAH :) any reproduction is illegal ;)</p>        
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>
</body>
<?php
	require_once 'LrfsUtils.php';
	$lrfsUtils = new LrfsUtils();
	$lrfsUtils->init("chekla");	
?>
<?php
	require_once 'LrfsUtils.php';
	$lrfsUtils = new LrfsUtils();
	$lrfsUtils->parseDatabasePropetiesFile();
	$lrfsUtils->init($lrfsUtils->seniorsDatabaseName);
	/*$lrfsUtils->init($lrfsUtils->u20DatabaseName);
	$lrfsUtils->init($lrfsUtils->u18DatabaseName);
	$lrfsUtils->init($lrfsUtils->u17DatabaseName);
	$lrfsUtils->init($lrfsUtils->u15DatabaseName);
	$lrfsUtils->init($lrfsUtils->u13DatabaseName);
	$lrfsUtils->init($lrfsUtils->dirigeantsDatabaseName);
	$lrfsUtils->init($lrfsUtils->entraineursDatabaseName);
	$lrfsUtils->init($lrfsUtils->arbitresDatabaseName);*/
?>
<!DOCTYPE html>
<html lang="en" ng-app="seniors">
<head>
<meta charset="UTF-8">
<title>LRFS:: Seniors</title>
<meta author="Maamar Yacine MEDDAH"></meta>
<!-- used styleSheets-->
<link href="../css/bootstrap.css" rel="stylesheet">
<link href="../css/animate.css" rel="stylesheet">
<link href="../css/filtergrid.css" rel="stylesheet">
<link href="../css/best.css" rel="stylesheet">
<link href="../css/jquery-ui.css" rel="stylesheet">
<!-- required js libraries -->
<script src="../js/jquery-1.11.1.min.js"></script>
<script src="../js/jquery-ui.js"></script>
<script src="../js/angular.js"></script>
<script src="../js/angular-route.js"></script>
<script src="../js/bootstrap.js"></script>
<script src="../js/tablefilter_all_min.js"></script>
<!-- amCharts javascript sources -->
<script type="text/javascript" src="../js/amcharts.js"></script>
<script type="text/javascript" src="../js/pie.js"></script>

<script src="dependencies/app.js"></script>
<script src="dependencies/lrfsDirectives.js"></script>
<script src="dependencies/lrfsController.js"></script>
</head>
<body>
<seniors-menu></seniors-menu>
<div ng-view class="view-frame"></div>
</body>
</html>
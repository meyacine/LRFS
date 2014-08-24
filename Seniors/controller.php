<?php
include_once"LrfsUtils.php";
/**
 * @author Maamar Yacine MEDDAH
 * 
 * Seniors Controller, here we define all ajax calls concerning database accessing
 * 
 */
class ControllerSvc{
	/**
	 * Cette méthode permet d'inserer une division dans la BD
	 * @param $libDiv
	 * @param $matLigue
	 */
	public static function insertDivision($libDiv, $matLigue){
		// Establishing db connection
		$utils = new LrfsUtils();
		$utils->parseDatabasePropetiesFile();
		$utils->databaseConnect($utils->seniorsDatabaseName);	
		// gathering data
		$stmt = $utils->dbc->prepare("SELECT count(*) as nbrDiv from division");
		$stmt->execute();
		$results=$stmt->fetchAll(PDO::FETCH_ASSOC);
		$matDiv= $results[0]['nbrDiv']+1;// we get the new division matricule here
		// On insere dans cette partie
		$stmt = $utils->dbc->prepare("INSERT INTO division VALUES(\"".$matDiv."\", \"".$matLigue."\", \"".$libDiv."\")");
		$stmt->execute();
	}	
}
/**
 *  This part of code is kind of handler whish get from the url the method to call
 */
$method="";// i set the method to empty string, to avoid the undefined exeption
extract($_GET);
switch($method){
	case "id":{
		ControllerSvc::insertDivision($libDiv, $matLigue);
		break;
	}
}
header('Content-type: application/json');
?>
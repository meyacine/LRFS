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
	
	/**
	 * Cette méthode retourne la liste des clubs
	 */
	public static function getClubsList(){
		// Establishing db connection
		$utils= new LrfsUtils();
		$utils->parseDatabasePropetiesFile();
		$utils->databaseConnect($utils->seniorsDatabaseName);	
		// gathering data
		$stmt = $utils->dbc->prepare(
				"SELECT MAT_CLUB, NOM_CLUB "
				."FROM CLUB "
				."ORDER BY NOM_CLUB ASC"
		);
		$stmt->execute();
		$results=$stmt->fetchAll(PDO::FETCH_ASSOC);
		$utils = null;
		$json=json_encode($results);
		echo $json;
	}
	/**
	 * Cette méthode retourne la liste des divisions
	 */
	public static function getDivisionsList(){
		// Establishing db connection
		$utils= new LrfsUtils();
		$utils->parseDatabasePropetiesFile();
		$utils->databaseConnect($utils->seniorsDatabaseName);
		// gathering data
		$stmt = $utils->dbc->prepare(
				"SELECT MAT_DIV as matDivision, LIB_DIV as libDivision "
				."FROM DIVISION "
				."ORDER BY matDivision ASC"
		);
		$stmt->execute();
		$results=$stmt->fetchAll(PDO::FETCH_ASSOC);
		$utils = null;
		$json=ControllerSvc::convertSqlResultToJson($results);
		echo $json;
	}
	
	/**
	 * Cette méthode retourne la liste des wilayas
	 */
	public static function getWilayasList(){
		// Establishing db connection
		$utils= new LrfsUtils();
		$utils->parseDatabasePropetiesFile();
		$utils->databaseConnect($utils->seniorsDatabaseName);
		// gathering data
		$stmt = $utils->dbc->prepare(
				"SELECT MAT_WIL as matWilaya, LIB_WIL as libWilaya "
				."FROM WILAYA "
				."ORDER BY matWilaya ASC"
		);
		$stmt->execute();
		$results=$stmt->fetchAll(PDO::FETCH_ASSOC);
		$utils = null;
		$json=ControllerSvc::convertSqlResultToJson($results);
		echo $json;
	}
	
	/**
	 * Cette méthode retourne la liste des ligues
	 */
	public static function getLiguesList(){
		// Establishing db connection
		$utils= new LrfsUtils();
		$utils->parseDatabasePropetiesFile();
		$utils->databaseConnect($utils->seniorsDatabaseName);
		// gathering data
		$stmt = $utils->dbc->prepare(
				"SELECT MAT_LIG as matLigue, LIB_LIG as libLigue "
				."FROM LIGUE "
				."ORDER BY matLigue ASC"
		);
		$stmt->execute();
		$results=$stmt->fetchAll(PDO::FETCH_ASSOC);
		$json=ControllerSvc::convertSqlResultToJson($results);
		$utils = null;
		//$json=json_encode($results);
		echo $json;
	}
	
	/**
	 * Converti le resultat sql à un tableau Json
	 * @param $SqlArray
	 */
	public static function convertSqlResultToJson($SqlArray){
		$json="[";
		foreach ($SqlArray as $ligne){
			$json = $json."{";
			foreach ($ligne as $key=>$value) {
				$json = $json."\"".$key."\":"."\"".$value."\", ";
			}
			$json=substr($json, 0, strlen($json)-2);
			$json = $json."},";
		}
		$json=substr($json, 0, strlen($json)-1);
		$json=$json."]";
		$json = str_replace("é", "e",$json);
		$json = str_replace("è", "e",$json);
		$json = str_replace("à", "a",$json);
		$json = str_replace("ï", "i",$json);
		$json = str_replace("â", "a",$json);
		$json = str_replace("ô", "o",$json);
		return $json;
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
	case "gcl":{
		ControllerSvc::getClubsList();
		break;
	}
	case "gdl":{
		ControllerSvc::getDivisionsList();
		break;
	}
	case "gll":{
		ControllerSvc::getLiguesList();
		break;
	}
	case "gwl":{
		ControllerSvc::getWilayasList();
		break;
	}
}
header('Content-type: application/json');
?>
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
	 * Cette methode permet d'inserer un club dans la bd
	 * @param  $matDivision
	 * @param  $matLigue
	 * @param  $matWilaya
	 * @param  $nomClub
	 * @param  $nomCompletClub
	 * @param  $adressClub
	 * @param  $dateCreationClub
	 * @param  $numAgrement
	 * @param  $numTel
	 * @param  $numFax
	 * @param  $emailClub
	 * @param  $photoClub
	 * @param  $matSaison
	 */
	public static function insertClub($matDivision, $matLigue, $matWilaya, $nomClub, $nomCompletClub, $adressClub, $dateCreationClub, $numAgrement, $numTel, $numFax, $emailClub, $photoClub, $matSaison){
		// Establishing db connection
		$utils = new LrfsUtils();
		$utils->parseDatabasePropetiesFile();
		$utils->databaseConnect($utils->seniorsDatabaseName);
		// gathering data
		$stmt = $utils->dbc->prepare("SELECT count(*) as nbrClub from club");
		$stmt->execute();
		$results=$stmt->fetchAll(PDO::FETCH_ASSOC);
		$matClub= $results[0]['nbrClub']+1;// we get the new club matricule here
		$uploaddir = './imgs/clubs/';
		// On insere dans cette partie
		$stmt = $utils->dbc->prepare("INSERT INTO club VALUES(
				\"".$matClub."\", 
				\"".$matLigue."\",
				\"".$matWilaya."\",
				\"".$nomClub."\",
				\"".$nomCompletClub."\",
				\"".$adressClub."\",
				\"".$dateCreationClub."\",
				\"".$numAgrement."\",
				\"".$numTel."\",
				\"".$numFax."\", 
				\"".$emailClub."\", 
				\"".$uploaddir.$nomClub."_".$photoClub."\")"
		);
		$stmt->execute();
		// On insere dans la table CDS
		$stmt = $utils->dbc->prepare("INSERT INTO cds VALUES(
				\"".$matClub."\",
				\"".$matDivision."\",
				\"".$matSaison."\"
		)"
		);
		$stmt->execute();
	}
	
	public static function insertMembre($matDivision, $matClub, $matWilaya, $nomMembre, $prenomMembre, $dateNaissanceMembre, $communeNaissanceMembre, $numAct, $parentMembre, $adrMembre, $groupSanguin, $finValidite, $duree, $dossard, $photoMembre, $matSaison){
		// Establishing db connection
		$utils = new LrfsUtils();
		$utils->parseDatabasePropetiesFile();
		$utils->databaseConnect($utils->seniorsDatabaseName);
		//TODO controle duplication (criteres nom prenom date de naissance)
		$query = "SELECT membre.mat_mem AS idMembre, nom_club " 
				."FROM Membre, club, cmsl "
				."WHERE ((nom_mem =\"".$nomMembre."\") AND "
				."(pre_mem=\"".$prenomMembre."\") AND "
				."(ddn_mem=\"".$dateNaissanceMembre."\") AND "
				."(membre.mat_mem = cmsl.mat_mem) AND (cmsl.mat_club) = (club.mat_club))";
		$stmt = $utils->dbc->prepare($query);
		$stmt->execute();
		$resultsDuplication=$stmt->fetchAll(PDO::FETCH_ASSOC);
		$duplication = sizeof($resultsDuplication);
		// Si aucun n'existe avec les meme coordonnée on insere sinon rejet
		if ($duplication==0){
			// gathering data
			$stmt = $utils->dbc->prepare("SELECT count(*) as nbrMembre from Membre");
			$stmt->execute();
			$results=$stmt->fetchAll(PDO::FETCH_ASSOC);
			// gestion des ecart entre licence et membre
			$stmt = $utils->dbc->prepare("SELECT count(*) as nbrLicence from Licence");
			$stmt->execute();
			$resultsLicences=$stmt->fetchAll(PDO::FETCH_ASSOC);
			// gestion des ecart entre cmsl et membre
			$stmt = $utils->dbc->prepare("SELECT count(*) as nbrCmsl from cmsl");
			$stmt->execute();
			$resultsCmsl=$stmt->fetchAll(PDO::FETCH_ASSOC);
			$matMembre= $results[0]['nbrMembre']+1;// we get the new club matricule here
			if (($results[0]['nbrMembre']==$resultsLicences[0]['nbrLicence'])&&($resultsCmsl[0]['nbrCmsl']==$resultsLicences[0]['nbrLicence']))
				{
				$uploaddir = './imgs/membres/';
				$extenion = pathinfo($photoMembre, PATHINFO_EXTENSION);		
				// On insere dans cette partie
				$stmt = $utils->dbc->prepare("INSERT INTO membre VALUES(
						\"".$matMembre."\",
						\"".$nomMembre."\",
						\"".$prenomMembre."\",
						\"".$dateNaissanceMembre."\",
						\"".$communeNaissanceMembre."\",
						\"".$matWilaya."\",
						\"".$numAct."\",
						\"".$parentMembre."\",
						\"".$adrMembre."\",
						\"".$uploaddir.$nomMembre."_".$prenomMembre."_".$dateNaissanceMembre.".".$extenion."\", \"J\", \"1\",
						\"".$groupSanguin."\",
						\"".$dossard."\")"
				);
				$stmt->execute();
				// On insere dans la table LICENCE
				$noLic="31".sprintf("%'04s",$matMembre)."J";
				$jour=date('d');
				$mois=date('m');
				$annee=date('y');
				$dateCreation=$annee."-".$mois."-".$jour;
				$stmt = $utils->dbc->prepare("INSERT INTO licence VALUES(
						\"".$matMembre."\",
						\"".$noLic."\",
						\"".$duree."\",
						\"".$dateCreation."\",
						\"".$finValidite."\",
						\"1\",
						\"".$dateCreation."\")"
				);
				$stmt->execute();
				// On insere dans la table CMSL
				$stmt = $utils->dbc->prepare("INSERT INTO cmsl VALUES(
						\"".$matSaison."\",
						\"".$matClub."\",
						\"".$matMembre."\",
						\"".$matMembre."\",
						\"1\",
						\"1\",
						\"1\",
						\"".$dateCreation."\")"
				);
				$stmt->execute();
				}
			else {
				print "[{\"erreur\": \"Ecart : <b>nbLicence</b>=".$resultsLicences[0]['nbrLicence'].", <b>nbCmsl</b>=".$resultsCmsl[0]['nbrCmsl'].", <b>nbMembre:</b>=".$matMembre-1
				."<br/>Veuillez verifier la coherence de vos donnees!\"}]";
			}
		}
		else {			
				print "[
					{
					\"erreur\": \"membre dej&agrave; existant sous le matricule :".$resultsDuplication[0]['idMembre'].", dans le club: ".$resultsDuplication[0]['nom_club']."\"}]";
		}
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
				"SELECT MAT_CLUB as matClub, NOM_CLUB as nomClub "
				."FROM CLUB "
				."ORDER BY nomClub ASC"
		);
		$stmt->execute();
		$results=$stmt->fetchAll(PDO::FETCH_ASSOC);
		$utils = null;
		$json=json_encode($results);
		echo $json;
	}
	/**
	 * Cette methode retourne la liste des informations des clubs
	 */
	public static function getClubsInformations(){
		// Establishing db connection
		$utils= new LrfsUtils();
		$utils->parseDatabasePropetiesFile();
		$utils->databaseConnect($utils->seniorsDatabaseName);
		// gathering data
		$stmt = $utils->dbc->prepare(
				"SELECT club.mat_club, ligue.lib_lig, lib_wil, lib_div, nom_club, lib_club, adr_club, dat_cre_club, no_agr_club, no_tel_club, no_fax_club, email_club, sigle_club "
				."FROM club, ligue, wilaya, division, cds "
				."WHERE ( "
				."(club.mat_club = cds.mat_club) AND "
				."(cds.mat_div = division.mat_div) AND "
				."(club.mat_wil = wilaya.mat_wil) AND "
				."(club.mat_lig = ligue.mat_lig) "
				.") " 
				."ORDER BY lib_div, nom_club ASC"
		);
		$stmt->execute();
		$results=$stmt->fetchAll(PDO::FETCH_ASSOC);
		$utils = null;
		$json=ControllerSvc::convertSqlResultToJson($results);
		echo $json;
	}
	/**
	 * Cette methode retourne la liste des informations des membres
	 */
	public static function getMembresInformations(){
		// Establishing db connection
		$utils= new LrfsUtils();
		$utils->parseDatabasePropetiesFile();
		$utils->databaseConnect($utils->seniorsDatabaseName);
		// gathering data
		$stmt = $utils->dbc->prepare(
				"SELECT club.nom_club, membre.mat_mem, nom_mem, pre_mem, ddn_mem, ldnc_mem, photo_mem "
				."FROM membre, cmsl, club " 
				."WHERE ( "
				    ."(membre.mat_mem = cmsl.mat_mem) AND "
				    ."(cmsl.mat_club = club.mat_club) "
				    .") "
				."ORDER BY nom_club, nom_mem, pre_mem ASC");
		$stmt->execute();
		$results=$stmt->fetchAll(PDO::FETCH_ASSOC);
		$utils = null;
		$json=ControllerSvc::convertSqlResultToJson($results);
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
	 * Cette méthode retourne la liste des saisons
	 */
	public static function getSaisonsList(){
		// Establishing db connection
		$utils= new LrfsUtils();
		$utils->parseDatabasePropetiesFile();
		$utils->databaseConnect($utils->seniorsDatabaseName);
		// gathering data
		$stmt = $utils->dbc->prepare(
				"SELECT MAT_SAI as matSaison, DAT_DEB_SAI as dateSaison "
				."FROM SAISON "
				."ORDER BY matSaison ASC"
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
if (isset($_GET)) extract($_GET);
if (isset($_POST)) extract($_POST);
switch($method){
	case "id":{
		ControllerSvc::insertDivision($libDiv, $matLigue);
		break;
	}
	case "ic":{
		ControllerSvc::insertClub($matDivision, $matLigue, $matWilaya, $nomClub, $nomCompletClub, $adressClub, $dateCreationClub, $numAgrement, $numTel, $numFax, $emailClub, $photoClub, $matSaison);
		break;
	}
	case "im":{
		ControllerSvc::insertMembre($matDivision, $matClub, $matWilaya, $nomMembre, $prenomMembre, $dateNaissanceMembre, $communeNaissanceMembre, $numAct, $parentMembre, $adrMembre, $groupSanguin, $finValidite, $duree, $dossard, $photoMembre, $matSaison);
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
	case "gsl":{
		ControllerSvc::getSaisonsList();
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
	case "gci":{
		ControllerSvc::getClubsInformations();
		break;
	}
	case "gmi":{
		ControllerSvc::getMembresInformations();
		break;
	}
}
header('Content-type: application/json');
?>
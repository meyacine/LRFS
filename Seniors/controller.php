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
			$matMembre= $results[0]['nbrMembre']+1;
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
				// recupperation du nom du club
				$requete = $utils->dbc->prepare("SELECT nom_club from club");
				$requete->execute();
				$resultatClub=$requete->fetchAll(PDO::FETCH_ASSOC);
				$stmt = $utils->dbc->prepare("INSERT INTO licence VALUES(
						\"".$matMembre."\",
						\"".$noLic."\",
						\"".$duree."\",
						\"".$dateCreation."\",
						\"".$finValidite."\",
						\"1\",
						\"".$dateCreation."\", 
						\"./imgs/licences/".$resultatClub[0]['nom_club']."/LIC".sprintf("%'05s",$matMembre)."_".$nomMembre."_".$prenomMembre.".jpg\")"
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
				// Generation de la licence de joueurs 
				ControllerSvc::generateLicenceMembre($matMembre);
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
	 * Cette méthode permet de generer la licences de joueurs 
	 * @param $matMembre
	 */
	public static function generateLicenceMembre($matMembre){
		// Connexion BDD
		$utils = new LrfsUtils();
		$utils->parseDatabasePropetiesFile();
		$utils->databaseConnect($utils->seniorsDatabaseName);
		// Recupperation de la saison
		$req="SELECT mat_sai FROM saison WHERE (actif_sai='1') ";
		$stmt = $utils->dbc->prepare($req);
		$stmt->execute();
		$ligne=$stmt->fetchAll(PDO::FETCH_ASSOC);
		$mat_sai=$ligne[0]['mat_sai'];
		// Creation de l'image
		$image=imagecreatetruecolor (500,300 );
		$blanc = imagecolorallocate($image, 255, 255, 255);
		$noir = imagecolorallocate($image, 0, 0, 0);
		$rouge = imagecolorallocate($image, 255, 0, 0);
		$vert = imagecolorallocate($image, 0, 255, 0);
		$bleu = imagecolorallocate($image, 0, 0, 255);
		$gris= imagecolorallocate($image, 128, 128, 128);
		imagerectangle($image, 0, 0, 499, 299, $blanc);
		imagerectangle($image, 5, 5, 495, 295, $vert);
		imagerectangle($image, 10,10, 490, 290, $rouge);
		imagerectangle($image, 10, 10, 489, 289, $blanc);
		imagerectangle($image, 11, 11, 488, 288, $blanc);
		imagerectangle($image, 12, 12, 487, 287, $blanc);
		imagerectangle($image, 13, 13, 486, 286, $blanc);
		imagefill($image, 1, 1, $vert);
		imagefill($image, 6, 6, $rouge);
		//On recuppere l'image à mettre au fond de la licence
		$fond="./imgs/lnf_fond.jpg";
		$data_fond=getimagesize($fond);
		// 0 pour la largeur
		// 1 pour la hauteur
		// 2 pour le type 1=gif 2=jpg 3=png
		// 3 pour la chaine complete "height=xxx width=yyy"
		$fondtoload=imagecreatefromjpeg($fond);
		$larg=$data_fond[0];
		$haut=$data_fond[1];
		$x=500;
		$y=($x*$haut)/$larg;
		if ($y>$x) { $y=$x; $x=($y*$larg)/$haut; }
		$posx=(100-$x)/2;
		$posy=(100-$y)/2;
		imagecopyresized($image, $fondtoload, 16, 16, 0, 0, 468, 268, $data_fond[0], $data_fond[1]);
		imagerectangle($image, 385, 15, 485, 115, $noir);
		// charger la photo du joueur avec sa taille
		$req="SELECT M.nom_mem, M.pre_mem, M.ddn_mem, M.ldnc_mem, M.ldnw_mem, M.photo_mem, M.type_mem, C.nom_club, C.Lib_club, L.no_lic, S.dat_deb_sai, S.dat_fin_sai, L.dat_cre_lic, L.val_lic, M.groupe_mem,M.no_doss ".
			 "FROM membre M, club C, cmsl, saison S, licence L ".
			 "WHERE ( (S.actif_sai='1') AND (M.mat_mem='$matMembre') AND (M.mat_mem=cmsl.mat_mem) AND ".
			 "(cmsl.mat_club=C.mat_club) AND (cmsl.mat_sai=S.mat_sai) AND (cmsl.mat_lic=L.mat_lic) ) ".
			 "GROUP BY M.nom_mem, M.pre_mem, M.ddn_mem, M.ldnc_mem, M.ldnw_mem, M.photo_mem, C.nom_club, S.dat_deb_sai ";
		$stmt = $utils->dbc->prepare($req);
		$stmt->execute();
		$ligne=$stmt->fetchAll(PDO::FETCH_ASSOC);
		$photo_mem=$ligne[0]['photo_mem'];
		if ($photo_mem!="")
		{
			$new_lic=$ligne[0]['no_lic'];
			$data_photo=getimagesize($photo_mem);
			switch ($data_photo[2])
			{
				CASE 1 : $imagetoload=imagecreatefromgif($photo_mem); break;
				CASE 2 : $imagetoload=imagecreatefromjpeg($photo_mem); break;
				CASE 3 : $imagetoload=imagecreatefrompng($photo_mem); break;
			}// End Switch
			//collage de la photo sur la licence:
			$larg=$data_photo[0];
			$haut=$data_photo[1];
			$x=99;
			$y=($x*$haut)/$larg;
			if ($y>$x) { $y=$x; $x=($y*$larg)/$haut; }
			$posx=(100-$x)/2;
			$posy=(100-$y)/2;
			imagecopyresized($image, $imagetoload, 386+$posx, 16+$posy, 0, 0, $x, $y, $data_photo[0], $data_photo[1]);
			// collage du logo de la LNF
			$logo="./imgs/lrfs.jpg";
			$data_logo=getimagesize($logo);
			$imagetoload=imagecreatefromjpeg($logo);
			$larg=$data_logo[0];
			$haut=$data_logo[1];
			$x=60;
			$y=($x*$haut)/$larg;
			if ($y>$x) { $y=$x; $x=($y*$larg)/$haut; }
			$posx=(60-$x)/2;
			$posy=(60-$y)/2;
			imagecopyresized($image, $imagetoload, 16+$posx, 13+$posy, 0, 0, $x, $y, $data_logo[0], $data_logo[1]);
			// titre 1
			$police="../fonts/tahomabd.ttf";
			$taille=10;
			$texte="FEDERATION ALGERIENNE DE FOOTBALL";
			$rectangle=imagettfbbox($taille, 0, $police, $texte);
			$lp=$rectangle[2]-$rectangle[0];
			$hp=$rectangle[3]-$rectangle[5];
			$x=(320-$lp)/2;
			$y=20+$hp;
			ImageTTFText($image, $taille, 0, $x+66, $y, $noir, $police, $texte);
			// titre2
			$police="../fonts/ariblk.ttf";
			$taille=10;
			$texte="LIGUE REGIONALE DE FOOTBALL DE SAIDA";
			$rectangle=imagettfbbox($taille, 0, $police, $texte);
			$lp=$rectangle[2]-$rectangle[0];
			$hp=$rectangle[3]-$rectangle[5];
			$x=(320-$lp)/2;
			$y=$y+20+$hp;
			ImageTTFText($image, $taille, 0, $x+68, $y-15, $noir, $police, $texte);
			$texte="Gestion de championnat Amateur";
			ImageTTFText($image, $taille, 0, 110, 60, $noir, $police, $texte);
			//ligne de séparation
			$y=$y+$hp;
			imageline($image, 15, $y, 385, $y, $noir);
			$police="../fonts/ariblk.ttf";
			$taille=10;
			switch($ligne[0]['type_mem']){
				case 'J':{
					$texte="LICENCE JOUEUR SENIOR : ".$new_lic;
					break;
				}
				case 'D':{
					$texte="LICENCE DIRIGEANT : ".$new_lic;
					break;
				}
				case 'E':{
					$texte="LICENCE ENTRAINEUR :".$new_lic;
					break;
				}
				case 'M':{
					$texte="LICENCE MEDECIN : ".$new_lic;
					break;
				}
			}
			$rectangle=imagettfbbox($taille, 0, $police, $texte);
			$lp=$rectangle[2]-$rectangle[0];
			$hp=$rectangle[3]-$rectangle[5];
			$x=(370-$lp)/2;
			$y=$y+20+$hp;
			ImageTTFText($image, $taille, 0, $x+16, $y, $noir, $police, $texte);
			imagerectangle($image, $rectangle[6]+$x+10, $rectangle[7]+$y-5, $rectangle[2]+$x+23, $rectangle[3]+$y+10, $noir);
			// le nom et le prénom
			$police=5;
			$texte="NOM : ".$ligne[0]['nom_mem']."   PRENOM : ".$ligne[0]['pre_mem'];
			$y=125;
			$lentext=strlen($texte)*imagefontwidth($police);
			$hp=imagefontheight($police);
			$x=5;
			$textlel=1;
			if (((470-$textlel)/2) < 0) { $police=$police-1; }
			imagestring($image, $police, $x+16, $y, $texte, $noir);
			// la date de naissance
			$police=5;
			$texte="DATE DE NAISSANCE : ".ControllerSvc::decode_date($ligne[0]['ddn_mem'])." a ".$ligne[0]['ldnc_mem']." (".$ligne[0]['ldnw_mem'].")";
			$textlen=strlen($texte)*imagefontwidth($police);
			$y=150;
			$x=5;
			if ($x<0) { $x=5; }
			imagestring($image, $police, $x+16, $y, $texte, $noir);
			// Le club :
			$police=5;
			$texte="CLUB : ".$ligne[0]['nom_club']." (".$ligne[0]['Lib_club'].")";
			$y=175;
			$lentext=strlen($texte)*imagefontwidth($police);
			$hp=imagefontheight($police);
			$x=5;
			if (((470-$textlel)/2) < 0) { $police=$police-1; }
			imagestring($image, $police, $x+16, $y, $texte, $noir);
			// La validité :
			$police=5;
			$date=ControllerSvc::decode_date($ligne[0]['dat_cre_lic']);
			ControllerSvc::decomp_date($date, $j, $m, $a);
			$a=$a+$ligne[0]['val_lic'];
			$dateValiditeQuery="SELECT * from validite";
			$stmtValidite = $utils->dbc->prepare($dateValiditeQuery);
			$stmtValidite->execute();
			$ligneValidite=$stmtValidite->fetchAll(PDO::FETCH_ASSOC);
			$ddd=$ligneValidite[0]['DD'];
			$ddf=$ligneValidite[0]['DF'];
			$texte="VALIDITE du ".ControllerSvc::inverse($ddd)." au ".ControllerSvc::inverse($ddf);
			$y=200;
			$lentext=strlen($texte)*imagefontwidth($police);
			$hp=imagefontheight($police);
			$x=5;
			if (((470-$textlel)/2) < 0) { $police=$police-1; }
			imagestring($image, $police, $x+16, $y, $texte, $noir);
			// groupage
			$police=5;
			$texte="GROUPAGE : ".$ligne[0]['groupe_mem'];
			$y=225;
			$lentext=strlen($texte)*imagefontwidth($police);
			$hp=imagefontheight($police);
			$x=5;
			if (((470-$textlel)/2) < 0) { $police=$police-1; }
			imagestring($image, $police, $x+16, $y, $texte, $noir);
			// cachet et signature
			//collage de l'arriere plan du dossad
			if ($ligne[0]['type_mem']=="J")
			{
				$logo="./imgs/fair_play.jpg";
				$data_logo=getimagesize($logo);
				$imagetoload=imagecreatefromjpeg($logo);
				$larg=$data_logo[0];
				$haut=$data_logo[1];
				$x=60;
				$y=($x*$haut)/$larg;
				if ($y>$x) { $y=$x; $x=($y*$larg)/$haut; }
				$posx=(60-$x)/2;
				$posy=(60-$y)/2;
				imagecopyresized($image, $imagetoload, 390, 194, 0, 0, $x+50, $y+30, $data_logo[0], $data_logo[1]);
				//------------------------------------
				imagerectangle($image, /*385*/390, /*205*/194, 485, 284, $noir);
				$police=2;
				$texte="Dossard";
				$y=220;
				$x=(100-(strlen($texte)*imagefontwidth($police)))/2;
				$hp=imagefontheight($police);
				$texte=sprintf("%'02s",$ligne[0]['no_doss']);
				$y=$y+$hp;
				$x=(100-(strlen($texte)*imagefontwidth($police)))/2;
				$hp=imagefontheight($police);
				$font = '../fonts/arial.ttf';
				imagettftext($image, 56, 0,$x+355,$y+32, $rouge, $font, $texte);
				imagettftext($image, 8, 0,$x+380,$y+50, $noir, $font, "Dossard");
			}
			//cachet et signature
			$police=2;
			$texte="Cachet et Signature";
			$y=220;
			$x=(100-(strlen($texte)*imagefontwidth($police)))/2;
			$hp=imagefontheight($police);
			//imagestring($image, $police, 190, $y+47, $texte, $noir);
			imagettftext($image, 8, 0,190,$y+60, $noir, $font, $texte);
			//----------------------
			if (!file_exists("./imgs/licences/".$ligne[0]['nom_club'])) mkdir("./imgs/licences/".$ligne[0]['nom_club']);
			imagejpeg($image, "./imgs/licences/".$ligne[0]['nom_club']."/LIC".sprintf("%'05s",$matMembre)."_".$ligne[0]['nom_mem']."_".$ligne[0]['pre_mem'].".jpg");
			$licence="./imgs/licences/".$ligne[0]['nom_club']."/LIC".sprintf("%'05s",$matMembre)."_".$ligne[0]['nom_mem']."_".$ligne[0]['pre_mem'].".jpg";
			imagedestroy($image);
		}
		else $licence="rien.jpg";
		return $licence;
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
				"SELECT club.nom_club, membre.mat_mem, nom_mem, pre_mem, ddn_mem, ldnc_mem, photo_mem, lien_lic "
				."FROM membre, cmsl, club, licence " 
				."WHERE ( "
				    ."(membre.mat_mem = cmsl.mat_mem) AND "
					."(cmsl.mat_lic = licence.mat_lic) AND "
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
	* Retourne un Json contenant les wilayas et les nombres de joueurs présents en BDD et nés dans ces wilaya
	*/
	public static function getNombreMembreParWilayas(){
		// Establishing db connection
		$utils= new LrfsUtils();
		$utils->parseDatabasePropetiesFile();
		$utils->databaseConnect($utils->seniorsDatabaseName);
		// gathering data
		$stmt = $utils->dbc->prepare("SELECT lib_wil, count(membre.mat_mem) AS nbr_mem FROM membre, wilaya WHERE (membre.ldnw_mem = wilaya.mat_wil) GROUP BY wilaya.mat_wil ");
		$stmt->execute();
		$results=$stmt->fetchAll(PDO::FETCH_ASSOC);
		$json=ControllerSvc::convertSqlResultToJson($results);
		$utils = null;
		echo $json;
	}
	
	// usefull methods
	
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
		if ($json=="]") $json="[]";
		return $json;
	}
	
	private static function inverse($dd)
	{
		$jj=substr($dd,8,2);
		$mm=substr($dd,5,2);
		$aa=substr($dd,0,4);
		$res=$jj."/".$mm."/".$aa;
		return $res;
	}
	private static function decode_date($date)
	{
		$a=substr($date, 0, 4);
		$m=substr($date, 5, 2);
		$j=substr($date, 8, 2);
		$d=$j."/".$m."/".$a;
		return $d;
	}
	private static function decomp_date($d, &$j, &$m, &$a)
	{
		$j=substr($d, 0, 2);
		$m=substr($d, 3, 2);
		$a=substr($d, -4);
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
	case "gnmpw":{
		ControllerSvc::getNombreMembreParWilayas();
		break;
	}
}
header('Content-type: application/json');
?>
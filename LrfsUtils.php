<?php
/**
 * @author Maamar Yacine MEDDAH
 * Classe de parcours des parametres de la conf du logiciel,
 * notamment tout ce qui concerne la connexion à la bd, et ça création,
 * ainsi que les contraintes relatives aux catégories d'ages.
 * @filesource lrfs.propeties : attention ce fichier est essentiel
 * à la configuration:
 * les lignes commençant par des # sont des commentaires 
 * En revanche il faudra bien garder les nom des parametres tels que définies initialement
 */
class LrfsUtils {
	public $host;
	public $port;
	public $user;
	public $password;
	public $dbc;
	// databases
	public $seniorsDatabaseName;
	public $u20DatabaseName;
	public $u18DatabaseName;
	public $u17DatabaseName;
	public $u15DatabaseName;
	public $u13DatabaseName;
	public $dirigeantsDatabaseName;
	public $entraineursDatabaseName;
	public $arbitresDatabaseName;
	// Ages limits
	public $u20AgesMin;
	public $u20AgesMax;	
	public $u18AgesMin;
	public $u18AgesMax;
	public $u17AgesMin;
	public $u17AgesMax;
	public $u15AgesMin;
	public $u15AgesMax;
	public $u13AgesMin;
	public $u13AgesMax;
	// Autres parametres
	public $seniorsMaxAllowed;
	public $seniorsAgesMin;
	public $seniorsExeptions;
	public $seniorsExeptionLimitMin;
	public $seniorsExeptionLimitMax;
	// validite
	public $validiteMin;
	public $validiteMax;
	// saison
	public $saisonMin;
	public $saisonMax;
	/**
	 * lit le fichier de configuration lrfs.properties et set les parametres
	 */
	public function parseDatabasePropetiesFile()
	{
		$filePointer = fopen("./lrfs.properties", "r");
		while (!feof($filePointer))
		{
			$data = fgets($filePointer,4096);
			if (substr($data, 0,1)=="#"){
				// on vient de lire un commentaire
				continue;
			}			
			$dataInfo = explode(" ", $data);
			switch ($dataInfo[0]) {
				case "host": {
					$this->host = str_replace("\r\n", "", $dataInfo[2]);
					break;
				}
				case "userName": {
					$this->user = str_replace("\r\n", "", $dataInfo[2]);
					break;
				}
				case "pass": {
					$this->password = str_replace("\r\n", "", $dataInfo[2]);
					break;
				}
				case "port": {
					$this->port = str_replace("\r\n", "", $dataInfo[2]);
					break;
				}
				case "seniorsDatabaseName": {
					$this->seniorsDatabaseName = str_replace("\r\n", "", $dataInfo[2]);
					break;
				}
				case "u20DatabaseName": {
					$this->u20DatabaseName = str_replace("\r\n", "", $dataInfo[2]);
					break;
				}
				case "u18DatabaseName": {
					$this->u18DatabaseName = str_replace("\r\n", "", $dataInfo[2]);
					break;
				}
				case "u17DatabaseName": {
					$this->u17DatabaseName = str_replace("\r\n", "", $dataInfo[2]);
					break;
				}
				case "u15DatabaseName": {
					$this->u15DatabaseName = str_replace("\r\n", "", $dataInfo[2]);
					break;
				}
				case "u13DatabaseName": {
					$this->u13DatabaseName = str_replace("\r\n", "", $dataInfo[2]);
					break;
				}
				case "dirigeantsDatabaseName": {
					$this->dirigeantsDatabaseName = str_replace("\r\n", "", $dataInfo[2]);
					break;
				}
				case "entraineursDatabaseName": {
					$this->entraineursDatabaseName = str_replace("\r\n", "", $dataInfo[2]);
					break;
				}
				case "arbitresDatabaseName": {
					$this->arbitresDatabaseName = str_replace("\r\n", "", $dataInfo[2]);
					break;
				}
				case "u20AgesMin": {
					$this->u20AgesMin = str_replace("\r\n", "", $dataInfo[2]);
					break;
				}
				case "u20AgesMax": {
					$this->u20AgesMax = str_replace("\r\n", "", $dataInfo[2]);
					break;
				}
				case "u18AgesMin": {
					$this->u18AgesMin = str_replace("\r\n", "", $dataInfo[2]);
					break;
				}
				case "u18AgesMax": {
					$this->u18AgesMax = str_replace("\r\n", "", $dataInfo[2]);
					break;
				}
				case "u17AgesMin": {
					$this->u17AgesMin = str_replace("\r\n", "", $dataInfo[2]);
					break;
				}
				case "u17AgesMax": {
					$this->u17AgesMax = str_replace("\r\n", "", $dataInfo[2]);
					break;
				}
				case "u15AgesMin": {
					$this->u15AgesMin = str_replace("\r\n", "", $dataInfo[2]);
					break;
				}
				case "u15AgesMax": {
					$this->u15AgesMax = str_replace("\r\n", "", $dataInfo[2]);
					break;
				}
				case "u13AgesMin": {
					$this->u13AgesMin = str_replace("\r\n", "", $dataInfo[2]);
					break;
				}
				case "u13AgesMax": {
					$this->u13AgesMax = str_replace("\r\n", "", $dataInfo[2]);
					break;
				}
				case "seniorsMaxAllowed": {
					$this->seniorsMaxAllowed = str_replace("\r\n", "", $dataInfo[2]);
					break;
				}
				case "seniorsAgesMin": {
					$this->seniorsAgesMin = str_replace("\r\n", "", $dataInfo[2]);
					break;
				}
				case "seniorsExeptions": {
					$this->seniorsExeptions = str_replace("\r\n", "", $dataInfo[2]);
					break;
				}
				case "seniorsExeptionLimitMin": {
					$this->seniorsExeptionLimitMin = str_replace("\r\n", "", $dataInfo[2]);
					break;
				}
				case "seniorsExeptionLimitMax": {
					$this->seniorsExeptionLimitMax = str_replace("\r\n", "", $dataInfo[2]);
					break;
				}
				case "validiteMin": {
					$this->validiteMin = str_replace("\r\n", "", $dataInfo[2]);
					break;
				}
				case "validiteMax": {
					$this->validiteMax = str_replace("\r\n", "", $dataInfo[2]);
					break;
				}
				case "saisonMin": {
					$this->saisonMin = str_replace("\r\n", "", $dataInfo[2]);
					break;
				}
				case "saisonMax": {
					$this->saisonMax = str_replace("\r\n", "", $dataInfo[2]);
					break;
				}		
			}
		}
		fclose($filePointer);
	}
	/**
	 * this method initiale db_connection
	 */
	public function init($db){
		$this->parseDatabasePropetiesFile();
		$dsn = "mysql:dbname=information_schema;host=".$this->host;
		switch ($this->port){
			case "3306": {
				// mysql specific
				$dsn = "mysql:dbname=information_schema;host=".$this->host;
				break;
			}
		}
		$user = $this->user;
		$password = $this->password;
		try {
			$this->dbc = new PDO($dsn, $user, $password);
			$stmt = $this->dbc->prepare("CREATE DATABASE IF NOT EXISTS ".$db);
			$stmt->execute();
			// now we connect to our concerned db
			$dsn = "mysql:dbname=".$db.";host=".$this->host;
			$this->dbc = new PDO($dsn, $user, $password);
			$stmt = $this->dbc->prepare(""
			."CREATE TABLE IF NOT EXISTS actions ( "
			."id_action int(11) NOT NULL AUTO_INCREMENT, "
			."id_user tinyint(4) NOT NULL, "
			."nom_action text NOT NULL, "
			."heure datetime NOT NULL, "
			."PRIMARY KEY (id_action) "
			.") ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ; "
			
			."CREATE TABLE IF NOT EXISTS cds ( "
			."MAT_CLUB decimal(4,0) NOT NULL DEFAULT '0', "
			."MAT_DIV decimal(2,0) NOT NULL DEFAULT '0', "
			."MAT_SAI decimal(2,0) NOT NULL DEFAULT '0', "
			."UNIQUE KEY MAT_CLUB (MAT_CLUB,MAT_DIV,MAT_SAI) "
			.") ENGINE=MyISAM DEFAULT CHARSET=latin1; "
			
			."CREATE TABLE IF NOT EXISTS club ( "
			."MAT_CLUB decimal(4,0) NOT NULL DEFAULT '0', "
			."MAT_LIG decimal(2,0) NOT NULL DEFAULT '0', "
			."MAT_WIL decimal(2,0) NOT NULL DEFAULT '0', "
			."NOM_CLUB char(10) DEFAULT NULL, "
			."LIB_CLUB char(100) DEFAULT NULL, "
			."ADR_CLUB char(100) DEFAULT NULL, "
			."DAT_CRE_CLUB date DEFAULT NULL, "
			."NO_AGR_CLUB decimal(15,0) DEFAULT NULL, "
			."NO_TEL_CLUB decimal(14,0) DEFAULT NULL, "
			."NO_FAX_CLUB decimal(14,0) DEFAULT NULL, "
			."EMAIL_CLUB char(50) DEFAULT NULL, "
			."SIGLE_CLUB char(50) DEFAULT NULL, "
			."PRIMARY KEY (MAT_CLUB) "
			.") ENGINE=MyISAM DEFAULT CHARSET=latin1; "
			
			."CREATE TABLE IF NOT EXISTS cmsl ( "
			."MAT_SAI decimal(2,0) NOT NULL DEFAULT '0', "
			."MAT_CLUB decimal(4,0) NOT NULL DEFAULT '0', "
			."MAT_MEM char(5) NOT NULL DEFAULT '', "
			."MAT_LIC decimal(15,0) NOT NULL DEFAULT '0', "
			."MAT_UTI decimal(4,0) NOT NULL DEFAULT '0', "
			."ACTIF_LIEN char(1) DEFAULT NULL, "
			."TYPE_MODIF char(1) DEFAULT NULL, "
			."DATE_LIEN date DEFAULT NULL, "
			."PRIMARY KEY (MAT_MEM) "
			.") ENGINE=MyISAM DEFAULT CHARSET=latin1; "
			
			."CREATE TABLE IF NOT EXISTS division ( "
			."MAT_DIV decimal(2,0) NOT NULL DEFAULT '0', "
			."MAT_LIG decimal(2,0) NOT NULL DEFAULT '0', "
			."LIB_DIV char(25) DEFAULT NULL, "
			."PRIMARY KEY (MAT_DIV) "
			.") ENGINE=MyISAM DEFAULT CHARSET=latin1; "
			
			."INSERT IGNORE INTO division (MAT_DIV, MAT_LIG, LIB_DIV) VALUES "
			."('1', '1', 'Régionale Une'), "
			."('2', '1', 'Régionale Deux A'), "
			."('3', '1', 'Régionale Deux B'), "
			."('4', '1', 'Excellence Régionale'); "
					
			."CREATE TABLE IF NOT EXISTS licence ( "
			."MAT_LIC decimal(15,0) NOT NULL DEFAULT '0', "
			."NO_LIC char(16) NOT NULL DEFAULT '', "
			."VAL_LIC decimal(2,0) DEFAULT NULL, "
			."DAT_CRE_LIC date DEFAULT NULL, "
			."DAT_FIN_LIC date DEFAULT NULL, "
			."MAT_UTI decimal(4,0) DEFAULT NULL, "
			."DAT_GEN date DEFAULT NULL, "
			."PRIMARY KEY (MAT_LIC) "
			.") ENGINE=MyISAM DEFAULT CHARSET=latin1; "
					
			."CREATE TABLE IF NOT EXISTS ligue ( "
			."MAT_LIG decimal(2,0) NOT NULL DEFAULT '0', "
			."LIB_LIG char(25) DEFAULT NULL, "
			."ADR_LIG char(100) DEFAULT NULL, "
			."NO_TEL_LIG decimal(14,0) unsigned zerofill DEFAULT NULL, "
			."NO_FAX_LIG decimal(14,0) unsigned zerofill DEFAULT NULL, "
			."EMAIL_LIG char(50) DEFAULT NULL, "
			."PRIMARY KEY (MAT_LIG) "
			.") ENGINE=MyISAM DEFAULT CHARSET=latin1; "
					
			."INSERT IGNORE INTO ligue (MAT_LIG, LIB_LIG, ADR_LIG, NO_TEL_LIG, NO_FAX_LIG, EMAIL_LIG) VALUES "
			."('1', 'Régionale', 'Saida', '00000048474636', '00000048472065', 'contact@lrfsaida.net'); "
					
			."CREATE TABLE IF NOT EXISTS membre ( "
			."MAT_MEM char(5) NOT NULL DEFAULT '', "
			."NOM_MEM char(25) DEFAULT NULL, "
			."PRE_MEM char(25) DEFAULT NULL, "
			."DDN_MEM date DEFAULT NULL, "
			."LDNC_MEM char(50) DEFAULT NULL, "
			."LDNW_MEM char(50) DEFAULT NULL, "
			."NO_ACT_MEM decimal(10,0) DEFAULT NULL, "
			."FILS_DE_MEM char(50) DEFAULT NULL, "
			."ADR_MEM char(100) DEFAULT NULL, "
			."PHOTO_MEM char(150) DEFAULT NULL, "
			."TYPE_MEM char(1) DEFAULT NULL, "
			."ACTIF_MEM decimal(1,0) DEFAULT NULL, "
			."GROUPE_MEM char(3) DEFAULT NULL, "
			."no_doss decimal(2,0) NOT NULL DEFAULT '0', "
			."PRIMARY KEY (MAT_MEM) "
			.") ENGINE=MyISAM DEFAULT CHARSET=latin1; "
					
			."CREATE TABLE IF NOT EXISTS saison ( "
			."MAT_SAI decimal(2,0) NOT NULL DEFAULT '0', "
			."DAT_DEB_SAI date DEFAULT NULL, "
			."DAT_FIN_SAI date DEFAULT NULL, "
			."ACTIF_SAI char(1) DEFAULT NULL, "
			."PRIMARY KEY (MAT_SAI) "
			.") ENGINE=MyISAM DEFAULT CHARSET=latin1; "
					
			."INSERT IGNORE INTO saison (MAT_SAI, DAT_DEB_SAI, DAT_FIN_SAI, ACTIF_SAI) VALUES "
			."('1', '".$this->saisonMin."', '".$this->saisonMax."', '1'); "
					
			."CREATE TABLE IF NOT EXISTS users ( "
			."id tinyint(4) NOT NULL AUTO_INCREMENT, "
			."user char(128) NOT NULL, "
			."pass char(128) NOT NULL, "
			."lastconn datetime NOT NULL, "
			."PRIMARY KEY (id) "
			.") ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ; "
					
			."INSERT IGNORE INTO users (id, user, pass, lastconn) VALUES "
			."(1, 'YWRtaW4=', 'YWRtaW4=', '2013-09-06 18:29:37'), "
			."(2, 'YWxsaWxp', 'YWxsaWxpMQ==', '2011-09-29 15:05:18'), "
			."(3, 'eWFjaW5l', 'eWFjaW5l', '2011-10-26 07:16:00'); "
					
			."CREATE TABLE IF NOT EXISTS validite ( "
			."DD date DEFAULT NULL, "
			."DF date DEFAULT NULL "
			.") ENGINE=MyISAM DEFAULT CHARSET=latin1; "
					
			."INSERT IGNORE INTO validite (DD, DF) VALUES ('".$this->validiteMin."', '".$this->validiteMax."'); "
					
			."CREATE TABLE IF NOT EXISTS wilaya ( "
			."MAT_WIL decimal(2,0) unsigned zerofill NOT NULL DEFAULT '00', "
			."LIB_WIL char(50) DEFAULT NULL, "
			."PRIMARY KEY (MAT_WIL) "
			.") ENGINE=MyISAM DEFAULT CHARSET=latin1; "
					
			."INSERT IGNORE INTO wilaya (MAT_WIL, LIB_WIL) VALUES "
			."('01', 'Adrar'), "
			."('02', 'Chlef'), "
			."('03', 'Laghouat'), "
			."('04', 'Oum El Bouaghi'), "
			."('05', 'Batna'), "
			."('06', 'Béjaïa'), "
			."('07', 'Biskra'), "
			."('08', 'Béchar'), "
			."('09', 'Blida'), "
			."('10', 'Bouira'), "
			."('11', 'Tamanrasset'), "
			."('12', 'Tébessa'), "
			."('13', 'Tlemcen'), "
			."('14', 'Tiaret'), "
			."('15', 'Tizi Ouzou'), "
			."('16', 'Alger'), "
			."('17', 'Djelfa'), "
			."('18', 'Jijel'), "
			."('19', 'Sétif'), "
			."('20', 'Saïda'), "
			."('21', 'Skikda'), "
			."('22', 'Sidi Bel Abbes'), "
			."('23', 'Annaba'), "
			."('24', 'Guelma'), "
			."('25', 'Constantine'), "
			."('26', 'Médéa'), "
			."('27', 'Mostaganem'), "
			."('28', 'M''Sila'), "
			."('29', 'Mascara'), "
			."('30', 'Ouargla'), "
			."('31', 'Oran'), "
			."('32', 'El Bayadh'), "
			."('33', 'Illizi'), "
			."('34', 'B.B.Arréridj'), "
			."('35', 'Boumerdés'), "
			."('36', 'El Taref'), "
			."('37', 'Tindouf'), "
			."('38', 'Tissemsilt'), "
			."('39', 'El Oued'), "
			."('40', 'Khenchela'), "
			."('41', 'Souk Ahras'), "
			."('42', 'Tipaza'), "
			."('43', 'Mila'), "
			."('44', 'Ain Defla'), "
			."('45', 'Naâma'), "
			."('46', 'Ain Témouchent'), "
			."('47', 'Ghardaïa'), "
			."('48', 'Relizane'), "
			."('49', 'Etranger');"
			);
			$stmt->execute();
		} catch (PDOException $e) {
			echo 'Connexion failed : ' . $e->getMessage();
		}
	}
	
	
}
?>
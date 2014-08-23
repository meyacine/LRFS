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
	/**
	 * lit le fichier de configuration lrfs.properties et set les parametres
	 */
	public function parseDatabasePropetiesFile()
	{
		$filePointer = fopen("lrfs.properties", "r");
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
			}
		}
		fclose($filePointer);
	}
}
?>
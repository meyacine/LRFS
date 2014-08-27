<?php
$output_dir = "imgs/";

extract($_POST);
switch($method){
	case "ic":{
		$output_dir = "imgs/clubs/";
		if(isset($_FILES["photoClub"]))
		{
			//Filter the file types , if you want.
			if ($_FILES["photoClub"]["error"] > 0)
			{
				echo "Error: " . $_FILES["photoClub"]["error"] . "<br>";
			}
			else
			{
				//move the uploaded file to uploads folder;
				move_uploaded_file($_FILES["photoClub"]["tmp_name"],$output_dir.$nomClub."_".$_FILES["photoClub"]["name"]);
				echo "Uploaded File :".$_FILES["photoClub"]["name"];
			}
		}
		else {
			echo "no file to load";
		}
		break;
	}
	case "im":{
		$output_dir = "imgs/membres/";
		if(isset($_FILES["photoMembre"]))
		{
			//Filter the file types , if you want.
			if ($_FILES["photoMembre"]["error"] > 0)
			{
				echo "Error: " . $_FILES["photoMembre"]["error"] . "<br>";
			}
			else
			{
				//move the uploaded file to uploads folder;
				$fichier = $_FILES['photoMembre']['name'];
				$extenion = pathinfo($fichier, PATHINFO_EXTENSION);
				move_uploaded_file($_FILES["photoMembre"]["tmp_name"],$output_dir.$nomMembre."_".$prenomMembre."_".$dateNaissance.".".$extenion);
				echo "Uploaded File :".$_FILES["photoMembre"]["name"]." To: ".$output_dir.$nomMembre."_".$prenomMembre."_".$dateNaissance.".".$extenion;
			}
		}
		else {
			echo "no file to load";
		}
		break;
	}
}

?>
<?php
$output_dir = "imgs/clubs/";
extract($_POST);
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
?>
<?php
 
if (isset($_REQUEST['fonction']) && $_REQUEST['fonction'] != '')
{
    $_REQUEST['fonction']($_REQUEST['params']);
}
function maj_param($param) {

	$file = fopen("param.json", "w");

	if ($file == FALSE) {
		echo "Impossible d'ouvrir le fichier du fichier de paramètre";

	} else {
	
		if (fwrite($file, json_encode($param["json"])) == FALSE) {

			echo "Une erreur s'est produite lors de la mis à jour du fichier de paramètre";
		} else {

			echo "Ecriture du fichier de paramètre réalisé avec succès";
		}

		fclose($file);
	}
	


}


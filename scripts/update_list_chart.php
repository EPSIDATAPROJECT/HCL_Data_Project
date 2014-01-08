<?php
 
if (isset($_REQUEST['fonction']) && $_REQUEST['fonction'] != '')
{
    $_REQUEST['fonction']($_REQUEST['params']);
}
function update_list_chart($param) {

	$file = fopen("../lists/charts/_list.json", "w");

	if ($file == FALSE) {
		echo "Impossible d'ouvrir le fichier du fichier lists/charts/_list.json";

	} else {
	
		if (fwrite($file, $param["json"]) == FALSE) {

			echo "Une erreur s'est produite lors de la mis à jour du fichier lists/charts/_list.json";
		} else {

			echo "Ecriture du fichier lists/charts/_list.json réalisé avec succès";
		}

		fclose($file);
	}
	


}


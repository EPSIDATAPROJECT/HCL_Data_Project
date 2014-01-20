<?php

if (isset($_REQUEST['fonction']) && $_REQUEST['fonction'] != '')
{
    $_REQUEST['fonction']($_REQUEST['params']);
}

function request($search_query) {
// Initialisation des variables utiles
$filename = "CR_Projet_Data.csv";
//$search = "Y74"; "75 76"


$index_search = "";
$search_tab = array();
$result_tab = array();


//print_r($search_tab["valeurs"]);
foreach ($search_query["valeurs"] as $key => $value) {
	$index = array_keys($value);
	$search_tab[$index[0]] = 0; 
	$result_tab[$index[0]] = 0; 
}
$aggregateur = $search_query["agg"];


$row = 1;

// Ouverture du fichier csv
if (($file = fopen($filename, "r")) !== FALSE) {
	while (($data = fgetcsv($file, 0 ,";")) !== FALSE) {
		// Sur la première ligne on récupère les numéro d'index des colonnes nécéssaire à la recherche
		if ($row == 1) {
			$i = 0;
			$num = count($data);
			// 
			while ($i < $num) {
				if (array_key_exists($data[$i], $search_tab)) {
					$search_tab[$data[$i]] = $i;
				}	
				$i++;
			}
		} else {

			// Sur le reste du document, on récupère les valeurs
			//$result += $data[$index_search];
			foreach ($search_tab as $key => $value) {
				if (!empty($data[$value])) {
					$result_tab[$key] += 1;
				}
			}

		}
		$row++;
	}

	if ($aggregateur == "AVG") {
		foreach ($result_tab as $key => $value) {
			$result_tab[$key] = ($value*100)/$row;
		}
	}

	echo json_encode($result_tab);
// echo "le nb de resultat est : $result";

	fclose($file);
} else {
	echo "erreur à l'ouverture du fichier";
}

}


?>
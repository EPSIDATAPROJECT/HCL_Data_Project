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
$search_tab = array(); // va contenir les numeros de colonne du csv
$result_tab = array(); // va contenir les resultats à renvoyer
$count_result = array(); // va contenir le compte d'itérations

$has_sum = FALSE;
$has_avg = FALSE;

foreach ($search_query["agg"] as $key => $value) {
	$index = array_keys($value);
	if($index[0] == "SUM") {
		$has_sum = TRUE;
	}
	if ($index[0] == "AVG") {
		$has_avg = TRUE;
	} 
}

//print_r($search_tab["valeurs"]);
foreach ($search_query["valeurs"] as $key => $value) {
	$index = array_keys($value);
	$search_tab[$index[0]] = 0;

	$result_tab[$index[0]]["SUM"] = 0; 
	$result_tab[$index[0]]["AVG"] = 0; 

	$count_result[$index[0]] = 0;
}




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
					$count_result[$key] += 1;
				}
			}

		}
		$row++;
	}


	if ($has_sum) {
		foreach ($count_result as $key => $value) {
			$result_tab[$key]["SUM"] = $value;
		}
	}

	if ($has_avg) {
		foreach ($count_result as $key => $value) {
			$result_tab[$key]["AVG"] = ($value*100)/$row;
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
<?php
if (isset($_REQUEST['fonction']) && $_REQUEST['fonction'] != '')
{
    $_REQUEST['fonction']($_REQUEST['params']);
}

function request($column_name) {
	$filename = "CR_Projet_Data.csv";

	$column_id = 0;
	$id_dep  = 7;
	$reponse = array();
	$row = 1;

if (($file = fopen($filename, "r")) !== FALSE) {
	while (($data = fgetcsv($file, 0 ,";")) !== FALSE) {
		// Sur la première ligne on récupère les numéro d'index des colonnes nécéssaire à la recherche
		if ($row == 1) {
			$i = 0;
			$num = count($data);
			// 
			while ($column_name == $data[$i]) {
				$i++;
			}
			$column_id = $i;
		} else {
			// on a la colonne a recherche, la colonne du département
			if ($data[$id_dep] != '' && $data[$id_dep] != 'O') {
			if (!isset($reponse[$data[$id_dep]]))
				$reponse[$data[$id_dep]] = 0;


			$reponse[$data[$id_dep]] += 1;
		}



		}
		$row++;
	}
	print_r($reponse);


}
}
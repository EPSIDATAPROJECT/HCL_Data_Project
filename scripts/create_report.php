<?php
 
if (isset($_REQUEST['fonction']) && $_REQUEST['fonction'] != '')
{
    $_REQUEST['fonction']($_REQUEST['params']);
}
function create_report($param) {

	//récupération des valeurs des champs
	$titre = "tdettetd";//$param['titre'];
	$description = "dekjd lkjdhklj kjlk"; //$param['description'];
	$charts[] = 1;
	$charts[] = 3;//$param['charts'];

	//création d'un rapport : report_YmdHis
	$date = date("YmdHis");
	$filename = "report_".$date.".json";

	//Récupérer dnas charts/_list les noms des graphiques selectionnés

	$filename_charts = "../lists/charts/_list.json";
	// $filename_list_charts = "_list.json";
	 $file_charts = fopen($filename_charts, "r");

	if ($file_charts == FALSE) {
	 	echo "erreur ouverture fichier chart list";	
	} else {
	 	$fromJson = fread($file_charts, filesize($filename_charts));
		
	 fclose($file_charts);
	}

	 $arr_chart_list = json_decode($fromJson);


	 $toJson_charts = array();
	$i = 0;
	while ($charts[$i]) {
		//print_r($charts[$i]);
		$toJson_charts[]['file'] = $arr_chart_list->charts[$charts[$i]]->file;
		$i++;
	}


	$arr = array('title' => $titre,
				'description' => $description,
				'charts' => $toJson_charts);

	$json = json_encode($arr,JSON_UNESCAPED_SLASHES);
	//Ecriture dans le fichier

	$file = fopen("../lists/reports/".$filename, "w+");

	if ($file == FALSE) {
		echo "Impossible d'ouvrir le fichier";

	} else {
	
		if (fwrite($file, (string)$json) == FALSE) {
			echo "Une erreur s'est produite lors de l ecriture";
		} 
	fclose($file);
 
	}

	// Ajouter dans reports/_list
	 $report_list_name = "../lists/reports/_list.json";
	 $report_list_file = fopen($report_list_name, "r");

	if ($report_list_file == FALSE) {
		echo "Impossible d'ouvrir le fichier ";
	} else {
		$fromJson = fread($report_list_file, filesize($report_list_name));
		fclose($report_list_file);
	}

	  $list = json_decode($fromJson);

	 $obj = (object) array("file" => $filename);
	  $list->reports[] = $obj;

	$toJson = json_encode($list);

	$report_list_file = fopen($report_list_name, 'w');
	if ($report_list_file == FALSE) {
		echo "Impossible d'ouvrir le fichier ";
	} else {
		fwrite($report_list_file, $toJson);
		fclose($report_list_file);
	}


}


<?php
//tables
//rma_chart, rma_report, rma_chart_report


function sql_getListCharts() {
	$result = "";

	$result = $bdd->query("SELECT * FROM rma_chart");
	$result->setFetchMode(PDO::FETCH_OBJ);

	return $result;
}


function sql_getListReports() {
	$result = "";

	$result = $bdd->query("SELECT * FROM rma_report");
	$result->setFetchMode(PDO::FETCH_OBJ);

	return $result;
}

function sql_addReport($file, $charts) {
	$result = "";

	$bdd->->exec("INSERT INTO rma_report(id_report, file) VALUES('', $file");
}

function sql_addChart() {
	$result = "";

	return $result;
}

function sql_deleteChart() {
	$result = "";

	return $result;
}

function sql_deleteReport(){
	$result = "";

	return $result;
}





?>
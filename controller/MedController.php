<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/projinteg/model/MedModel.php";

$MedModel = new MedModel();

$acao = $_GET["acao"];

if($acao == "create"){
	$Nome = $_POST["Nome"];
	$CRM = $_POST["CRM"];

	$MedModel->inserir($Nome, $CRM);

	echo "<div class='card-panel teal lighten-2'>Medico inserido.</div>";
}  

?>
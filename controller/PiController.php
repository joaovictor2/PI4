<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/projinteg/model/PiModel.php";

$piModel = new PiModel();

$piModel->zeraPesquisa();
$qtdsintomas = $piModel->analisar();

for($i = 0; $i < 10; $i++){
	$avaliado = 
	if(isset()){
		$piModel->selecaoSintoma(8);
	}else{
		echo $_GET["sintoma<?=$i?>"];
	}
}

$doencas = $piModel->resultado();

 foreach ($doencas as $d):
 	echo "doenca = " . $d["idDoenca"];
 endforeach;





?>
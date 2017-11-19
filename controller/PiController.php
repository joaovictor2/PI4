<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/projinteg/model/PiModel.php";

$piModel = new PiModel();

$piModel->zeraPesquisa();

$acao = $_GET["acao"];


if($acao == "continuar"){
	$raiz = $_POST["primario"];
	$piModel->selecaoSintoma($raiz);
	$doencasEncontradas = $piModel->usaRaiz($raiz); // seleciona todas as doencas com o sintoma raiz

	foreach ($doencasEncontradas as $de) {
		$piModel->selecionaDoenca($de["idDoenca"]); // salva todas as doencas onde a busca deverá ser efetuada
	}

	$sintomasSecundarios = $piModel->listaSintomasSecundarios($raiz); // lista todos os sintomas que estão presentes nas doenças com o sintoma raiz

	foreach ($sintomasSecundarios as $ss) { 
		$cont = 0;
		$cont = $cont + 1; ?>
		<input class="filled-in" type="checkbox" id="sintoma<?=$cont?>" name="sintoma<?=$cont?>" value="<?= $ss["idSintoma"]?>"/>
		<label for="sintoma<?=$cont?>"><?= $ss["DescricaoSintoma"]?></label><br>

		<?php }

	}else if($acao == "avaliar"){
		$qtdsintomas = $piModel->analisar();
		for($i = 1; $i <= $qtdsintomas; $i++){
			if(isset($_POST["sintoma$i"])){
				$piModel->selecaoSintoma($_POST["sintoma$i"]);
			}
		}

	}else if($acao == "finalizar"){
		$raiz = $_POST["primario"];
		$piModel->selecaoSintoma($raiz);
		$resultado = $piModel->resultado();

		foreach ($resultado as $r) {
			echo "<div class='card-panel teal lighten-2'>Você tem " . number_format ($r["Probabilidade"], 1) ."% de chance de estar com " . $r["NomeDoenca"] . "</div>";
		}
	}

	?>
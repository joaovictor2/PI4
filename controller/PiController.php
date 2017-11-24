<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/projinteg/model/PiModel.php";

$piModel = new PiModel();

$piModel->zeraPesquisa();

$acao = $_GET["acao"];

if($acao == "continuar"){
	$raiz = $_POST["primario"];
	
	$sintomasSecundarios = $piModel->listarSintomasSecundarios($raiz); // seleciona todas os sintomas secundarios com o sintoma raiz
	
	$cont = 0;

	foreach ($sintomasSecundarios as $ss) { 
		$cont = $cont + 1; ?>
		<input class="filled-in" type="checkbox" id="sintoma<?=$cont?>" name="sintoma<?=$cont?>" value="<?= $ss["idSintoma"]?>"/>
		<label for="sintoma<?=$cont?>"><?= $ss["DescricaoSintoma"]?></label><br>

		<?php } ?>						
		<ul class="list-inline banner-social-buttons">
			<li class="list-inline-item">
				<button class="btn btn-default btn-lg" type="button" name="finalizar" id="finalizar" onclick="terminar('/projinteg/controller/PiController.php?acao=avaliar&qtdsintomas=<?=$cont?>')">
					<span class="network-name">Analisar</span>
				</button>
			</li>
		</ul>
		<?php

	}else if($acao == "avaliar"){
		$qtdsintomas = $_GET["qtdsintomas"];

		for($i = 1; $i < $qtdsintomas; $i++){
			if(isset($_POST["sintoma$i"])){
				$piModel->selecaoSintoma($_POST["sintoma$i"]);
			}
		}

		$resultado = $piModel->resultado();

		foreach ($resultado as $r) {
			echo "<center><div class='alert alert-success col-4 mensagem'>Você tem " . number_format ($r["Probabilidade"], 1) ."% de chance de estar com " . $r["NomeDoenca"] . "</div></center>";
		}

	}else if($acao == "finalizar"){
		$raiz = $_POST["primario"];
		$piModel->selecaoSintoma($raiz);
		$resultado = $piModel->resultado();

		foreach ($resultado as $r) {
			echo "<center><div class='alert alert-success col-4 mensagem'>Você tem " . number_format ($r["Probabilidade"], 1) ."% de chance de estar com " . $r["NomeDoenca"] . "</div></center>";
		}
	}

	?>
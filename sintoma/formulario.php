<?php 

require_once $_SERVER["DOCUMENT_ROOT"] . "/projinteg/model/PiModel.php";

$piModel = new PiModel();
$sintomas = $piModel->listarSintomas();

?>

<div class="card-panel">

	<h4 class="center-align">Formulário</h4>

	<form method="post" id="formsintoma" action="/projinteg/controller/PiController.php">

		<?php 
			$cont = 0;
			foreach($sintomas as $s): 
			$cont = $cont + 1;
		?>

		<input class="filled-in" type="checkbox" id="sintoma<?=$cont?>" name="sintoma<?=$cont?>" value="<?= $s["idSintoma"]?>"/>
		<label for="sintoma<?=$cont?>"><?= $s["DescricaoSintoma"]?></label><br>

		<?php  endforeach; 

		?>

		<br>
		<button class="btn waves-effect waves-light" type="submit">
			Analisar
		</button>

		<div id="mensagem"></div>

	</form>

</div>


<script type="text/javascript">
	
	("#formartista").on("submit" ,function(event) {
		event.preventDefault();

		$.ajax({
			url: $("#formsintoma").attr("action"),
			method: $("#formsintoma").attr("method"),
			data: $("#formsintoma").serialize(),
			success: function(data){
				$("#formsintoma").trigger('reset');
				$("#mensagem").html(data);
			}
		})
	});

</script>
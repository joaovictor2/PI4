<?php  

require_once('simpletest/autorun.php');
require_once('../model/PiModel.php');

class TestOfFormSintoma extends UnitTestCase{
	function testFormSintoma(){
		$piModel = new PiModel();

		$piModel->zeraPesquisa();
		$piModel->selecaoSintoma(2); // sintoma = Garaganta irritada, id = 2
		$resultado = $piModel->resultado("unico");

		foreach ($resultado as $r) {
			$this->assertEqual($r["NomeDoenca"], "Resfriado");
			$this->assertEqual(number_format ($r["Probabilidade"], 1), 20.0);
		}

		$piModel->zeraPesquisa();
		$piModel->selecaoSintoma(6); // sintoma = Irritabilidade, id = 6
		$resultado = $piModel->resultado("unico");

		foreach ($resultado as $r) {
			$this->assertEqual($r["NomeDoenca"], "Depressão");
			$this->assertEqual(number_format ($r["Probabilidade"], 1), 11.1);
		}

		$piModel->zeraPesquisa();
		$piModel->selecaoSintoma(15); // sintoma = Tosse, id = 15
		$resultado = $piModel->resultado("unico");

		foreach ($resultado as $r) {
			$this->assertEqual($r["NomeDoenca"], "Asma");
			$this->assertEqual(number_format ($r["Probabilidade"], 1), 33.3);
		}

		$piModel->zeraPesquisa();
		$piModel->selecaoSintoma(43); // sintoma = Febre, id = 43
		$resultado = $piModel->resultado("unico");

		foreach ($resultado as $r) {
			$this->assertEqual($r["NomeDoenca"], "Dengue");
			$this->assertEqual(number_format ($r["Probabilidade"], 1), 6.7);
		}

		$piModel->zeraPesquisa();
		$piModel->selecaoSintoma(18); // sintoma = Urinar excessivamente, id = 18
		$resultado = $piModel->resultado("unico");

		foreach ($resultado as $r) {
			$this->assertEqual($r["NomeDoenca"], "Diabete Tipo 1");
			$this->assertEqual(number_format ($r["Probabilidade"], 1), 16.7);
		}

		$piModel->zeraPesquisa();
		$piModel->selecaoSintoma(24); // sintoma = Infecções, id = 24
		$resultado = $piModel->resultado("unico");

		foreach ($resultado as $r) {
			$this->assertEqual($r["NomeDoenca"], "Diabetes Tipo 2");
			$this->assertEqual(number_format ($r["Probabilidade"], 1), 33.3);
		}

		$piModel->zeraPesquisa();
		$piModel->selecaoSintoma(27); // sintoma = Formigamento na Boca, id = 27
		$resultado = $piModel->resultado("unico");

		foreach ($resultado as $r) {
			$this->assertEqual($r["NomeDoenca"], "Alergia Alimentar");
			$this->assertEqual(number_format ($r["Probabilidade"], 1), 11.1);
		}

		$piModel->zeraPesquisa();
		$piModel->selecaoSintoma(38); // sintoma = Dor cabeça, id = 38
		$resultado = $piModel->resultado("unico");

		foreach ($resultado as $r) {
			$this->assertEqual($r["NomeDoenca"], "Alergia Respiratória");
			$this->assertEqual(number_format ($r["Probabilidade"], 1), 14.3);
		}

		$piModel->zeraPesquisa();
		$piModel->selecaoSintoma(39); // sintoma = Urticária, id = 39
		$resultado = $piModel->resultado("unico");

		foreach ($resultado as $r) {
			$this->assertEqual($r["NomeDoenca"], "Alergia na Pele");
			$this->assertEqual(number_format ($r["Probabilidade"], 1), 33.3);
		}

	}
}

?>
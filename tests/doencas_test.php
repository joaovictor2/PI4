<?php  

require_once('simpletest/autorun.php');
require_once('../model/PiModel.php');

class TestOfFormSintoma extends UnitTestCase{
	function testFormSintoma(){
		$piModel = new PiModel();
		$sintomasEsperados = array(0 => array("idSintoma" => 5),
			1 => array("idSintoma" => 7),
			2 => array("idSintoma" => 15),
			3 => array("idSintoma" => 22),
			4 => array("idSintoma" => 23),
			5 => array("idSintoma" => 34),
			6 => array("idSintoma" => 38),
			7 => array("idSintoma" => 43),
			8 => array("idSintoma" => 55));

		echo $sintomasEsperados[0]["idSintoma"] . "<br>";

			// 'Ansiedade','Congestão Nasal','Diarréia','Dor de Cabeça','Dor Olhos', 'Febre', 'Náuseas', 'Tosse','Vomitos');
		$this->assertEqual($piModel->listarSintomas(), $sintomasEsperados[]["idSintoma"]);
	}
}

?>
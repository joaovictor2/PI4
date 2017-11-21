<?php  

require_once('simpletest/autorun.php');
require_once('../model/MedModel.php');

class TestOfFormMed extends UnitTestCase{
	function testFormMed(){
		$medModel = new MedModel();
		$this->assertEqual($medModel->inserir('Fernando', 1234556789, 6), true);
	}
}

?>
<?php 

require_once('simpletest/autorun.php');

class AllTests extends TestSuite{

	function AllTests(){
		$this->TestSuite('AllTests');
		$this->addFile('primeiro_test.php');
		$this->addFile('form_medico_test.php');
	}

}

?>
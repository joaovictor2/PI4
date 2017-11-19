
<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/projinteg/config/BancoDados.php";


class MedModel{

	private $bd;

	function __construct(){
		$this->bd = BancoDados::obterConexao();
	}

	public function inserir($Nome, $CRM){
		$insercao = $this->bd->prepare("INSERT INTO medico (Nome, CRM) VALUES (:Nome, :CRM)");

		$insercao->bindParam(":Nome", $Nome);		
		$insercao->bindParam(":CRM", $CRM);
		$insercao->execute();
	}

	public function consultaEspecialidade(){
		$consulta = $this->bd->query("SELECT IdEspecialidade,Descricao FROM especialidade ORDER BY Descricao");
		$categorias = $consulta->fetchAll(PDO::FETCH_ASSOC);
		return $categorias;
	}

}

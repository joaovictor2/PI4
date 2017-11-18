<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/projinteg/config/BancoDados.php";


class PiModel{

	private $bd;
	private $pesquisa = "";
	private $busca = "select sintomadoenca.idDoenca, doenca.DescricaoDoenca from sintomadoenca inner join doenca on sintomadoenca.idDoenca = doenca.idDoenca where sintomadoenca.idSintoma = ";

	function __construct(){
		$this->bd = BancoDados::obterConexao();
	}

	public function listarSintomas(){
		$consulta = $this->bd->query("select * from Sintoma order by DescricaoSintoma");

		$sintomas = $consulta->fetchAll();

		return $sintomas;
	}

	public function analisar(){
		$consulta = $this->bd->prepare("select count(idSintoma) from sintoma");
		$consulta->execute();

		$qtdsintomas = $consulta->fetch();

		return $qtdsintomas["count(idSintoma)"];
	}

	public function selecaoSintoma($idSintoma){
		$this->pesquisa = $this->pesquisa . " $idSintoma " . "or sintomadoenca.idSintoma = ";
	}

	public function zeraPesquisa(){
		$this->pesquisa = "";
	}

	public function resultado(){
		$comando = $this->busca;
		$comando .= $this->pesquisa;
		$n = strlen($comando) - 29;
		$comando = substr($comando, 0, $n);

		$consulta = $this->bd->query("$comando");

		$doencas = $consulta->fetchAll();

		return $doencas;
	}

}

?>
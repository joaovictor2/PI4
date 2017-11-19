<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/projinteg/config/BancoDados.php";


class PiModel{

	private $bd;
	private $pesquisaSintoma = "";
	private $pesquisaDoenca = "";
	private $busca = "select sintomadoenca.idDoenca as CodDoenca, doenca.DescricaoDoenca as NomeDoenca, ((count(*)/(select count(sintomadoenca.idSintoma) from sintomadoenca where sintomadoenca.idDoenca = CodDoenca))*100) as Probabilidade from sintomadoenca inner join doenca on sintomadoenca.idDoenca = doenca.idDoenca where sintomadoenca.idSintoma =";
	private $fim = "group by sintomadoenca.idDoenca ORDER by Probabilidade desc";

	function __construct(){
		$this->bd = BancoDados::obterConexao();
	}

	public function listarSintomas(){
		$consulta = $this->bd->query("select * from Sintoma where idSintoma in (5, 7, 15, 22, 23, 34, 38, 43, 55) order by DescricaoSintoma");

		$sintomas = $consulta->fetchAll();

		return $sintomas;
	}

	public function analisar(){
		$comandoSintomas = "";
		$comandoSintomas .= $this->pesquisaSintoma;
		$n = strlen($comandoSintomas) - 29;
		$comandoSintomas = substr($comandoSintomas, 0, $n);
		$consulta = $this->bd->prepare("select count(idSintoma) from sintoma where idSintoma = :a");
		$consulta->bindParam(":a", $comandoSintomas);
		$consulta->execute();

		$qtdsintomas = $consulta->fetch();

		return $qtdsintomas["count(idSintoma)"];
	}

	public function selecaoSintoma($idSintoma){
		$this->pesquisaSintoma = $this->pesquisaSintoma . " $idSintoma " . "or sintomadoenca.idSintoma = ";
	}

	public function selecionaDoenca($idDoenca){
		$this->pesquisaDoenca = $this->pesquisaDoenca . " $idDoenca " . "or sintomadoenca.idDoenca = ";
	}

	public function zeraPesquisa(){
		$this->pesquisaSintoma = "";
		$this->pesquisaDoenca = "";
	}

	public function resultado(){
		$comando = $this->busca;
		$comando .= $this->pesquisaSintoma;
		$n = strlen($comando) - 29;
		$comando = substr($comando, 0, $n);
		$comando .= $this->fim;

		$consulta = $this->bd->query("$comando");

		$doencas = $consulta->fetchAll();

		return $doencas;
	}

	public function usaRaiz($idSintoma){
		$consultaDemaisSintomas = $this->bd->prepare("select * from sintomadoenca where idSintoma = :idSintoma");

		$consultaDemaisSintomas->bindParam(":idSintoma", $idSintoma);

		$consultaDemaisSintomas->execute();

		$doencasEncontradas = $consultaDemaisSintomas->fetchAll();

		return $doencasEncontradas;

	}

	public function listaSintomasSecundarios($raiz){
		$sintomasSecundarios = "select *, s.DescricaoSintoma from sintomadoenca as sd inner join sintoma as s on s.idSintoma = sd.idSintoma where idDoenca = " . $this->pesquisaDoenca;
		$n = strlen($sintomasSecundarios) - 28;
		$sintomasSecundarios = substr($sintomasSecundarios, 0, $n);
		$sintomasSecundarios .= " and sd.idSintoma <> $raiz";

		$listar = $this->bd->query("$sintomasSecundarios");

		$resultadoSintomas = $listar->fetchAll();

		return $resultadoSintomas;
	}

}

?>
<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/projinteg/config/BancoDados.php";

class PiModel{

	private $bd;
	private $pesquisaSintoma = "";
	private $busca = "select sintomadoenca.idDoenca as CodDoenca, doenca.DescricaoDoenca as NomeDoenca, (((count(*)+1)/(select count(sintomadoenca.idSintoma) from sintomadoenca where sintomadoenca.idDoenca = CodDoenca))*100) as Probabilidade from sintomadoenca inner join doenca on sintomadoenca.idDoenca = doenca.idDoenca where sintomadoenca.idSintoma =";
	private $fim = "group by sintomadoenca.idDoenca ORDER by Probabilidade desc";

	function __construct(){
		$this->bd = BancoDados::obterConexao();
	}

	public function listarSintomas(){
		$consulta = $this->bd->query("select * from Sintoma where idSintoma in (5, 7, 15, 22, 23, 34, 38, 43, 55) order by DescricaoSintoma");

		$sintomas = $consulta->fetchAll();

		return $sintomas;
	}

	public function selecaoSintoma($idSintoma){
		$this->pesquisaSintoma = $this->pesquisaSintoma . " $idSintoma " . "or sintomadoenca.idSintoma = ";
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

	public function listarSintomasSecundarios($raiz){
		$listar = $this->bd->prepare("select sintomadoenca.idSintoma, sintoma.DescricaoSintoma from sintomadoenca inner join sintoma on sintomadoenca.idSintoma = sintoma.idSintoma where sintomadoenca.idDoenca in(select sintomadoenca.iDdoenca from sintomadoenca WHERE sintomadoenca.idSintoma = :sintomaRaiz) and sintomadoenca.idSintoma <> :sintomaRaiz");

		$listar->bindParam(":sintomaRaiz", $raiz);

		$listar->execute();

		$resultadoSintomas = $listar->fetchAll();

		return $resultadoSintomas;
	}

	}

?>
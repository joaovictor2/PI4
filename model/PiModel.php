<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/projinteg/config/BancoDados.php";

class PiModel{

	private $bd;
	private $pesquisaSintoma = "";
	private $prefixoConsultaBanco = "select sintomadoenca.idDoenca as CodDoenca, doenca.DescricaoDoenca as NomeDoenca, (((count(*)+";
	private $posfixoConsultaBanco = ")/(select count(sintomadoenca.idSintoma) from sintomadoenca where sintomadoenca.idDoenca = CodDoenca))*100) as Probabilidade from sintomadoenca inner join doenca on sintomadoenca.idDoenca = doenca.idDoenca where sintomadoenca.idSintoma =";
	private $ordenacaoResultadoConsulta = "group by sintomadoenca.idDoenca ORDER by Probabilidade desc";

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
	}

	public function listarSintomasSecundarios($raiz){
		$listar = $this->bd->prepare("select sintomadoenca.idSintoma, sintoma.DescricaoSintoma from sintomadoenca inner join sintoma on sintomadoenca.idSintoma = sintoma.idSintoma where sintomadoenca.idDoenca in(select sintomadoenca.iDdoenca from sintomadoenca WHERE sintomadoenca.idSintoma = :sintomaRaiz) and sintomadoenca.idSintoma <> :sintomaRaiz");

		$listar->bindParam(":sintomaRaiz", $raiz);

		$listar->execute();

		$resultadoSintomas = $listar->fetchAll();

		return $resultadoSintomas;
	}

	public function resultado($tipoDePesquisa){
		if($tipoDePesquisa == "multiplos"){
			$quantidadeVariavelSintoma = "1";
		}else{
			$quantidadeVariavelSintoma = "0";
		}


		$codigoBusca = $this->prefixoConsultaBanco . "$quantidadeVariavelSintoma" . $this->posfixoConsultaBanco;
		$codigoBusca .= $this->pesquisaSintoma;
		$quantidadeDeCaracteres = strlen($codigoBusca) - 29;
		$codigoBusca = substr($codigoBusca, 0, $quantidadeDeCaracteres);
		$codigoBusca .= $this->ordenacaoResultadoConsulta;


		$consulta = $this->bd->prepare("$codigoBusca");
		
		$consulta->execute();

		$doencas = $consulta->fetchAll();

		return $doencas;
	}

	}

?>
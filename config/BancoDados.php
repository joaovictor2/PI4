<?php

class BancoDados{

	private static $conexao;

	public static function obterConexao(){

		if( isset($conexao) == false){

			$conexao = new PDO("mysql:dbname=piquartosemestre;host=127.0.0.1:3306","root","");
			$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$conexao->exec("set names utf8");

		}

		return $conexao;
	}

}

?>
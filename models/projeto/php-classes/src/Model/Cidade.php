<?php

namespace Projeto\Model;

use \Projeto\DB\Sql;
use \Projeto\Model;

//Classe unidade(marcações, com seus métodos específicos)
class Cidade extends Model
{



	//METODO QUE VERIFICA O TOTAL  DE CIDADES CADASTRADAS
	public static function totalCidades()
	{

		$sql = new Sql();
		$total = $sql->select("SELECT COUNT(id_cidade) as Total
			FROM tb_cidades");

		return ['cidadesTotal' => (int) $total[0]["Total"]];
	}


	public function alterarCidades()
	{

		$sql = new Sql();

		$results = $sql->select("CALL sp_edita_cidades(:id_cidade,:cidade
			)",
			array(
				":id_cidade" => $this->getid_cidade(),
				":cidade" => $this->getcidade(),

			)
		);


		$this->setData($results[0]);


	}

	public function get($id_cidade)
	{

		$sql = new Sql();

		$results = $sql->select("SELECT  * FROM  tb_cidades WHERE id_cidade = :id_cidade", [
			':id_cidade' => $id_cidade
		]);

		$this->setData($results[0]);



	}

	public static function checkList($list)
	{

		foreach ($list as &$row) {

			$p = new Unidade();
			$p->setData($row);
			$row = $p->getValues();

		}

		return $list;

	}

	//Método para pegar os valores do array
	public function getValues()
	{


		$values = parent::getValues();

		return $values;

	}



	//METODO PARA INCLUIR AS CIDADES
	public function incluirCidades()
	{

		$var = isset($_POST['cidade']) ? $_POST['cidade'] : FALSE;

		for ($cont = 0; $cont < count($var); $cont++) {

			$var[$cont];

			$cidade = $var[$cont];

			if ($cidade != "") {

				$sql = new Sql();
				$sql->select(
					"CALL sp_cadastro_cidades(:cidade)",
					array(
						":cidade" => $cidade
					)
				);
			}
		}

	}


	//METODO PARA DELETAR UMA CIDADE
	public function deleteCidade($id_cidade)
	{

		$sql = new Sql();

		$sql->query("DELETE FROM tb_cidades WHERE id_cidade = :id_cidade", [
			':id_cidade' => $id_cidade
		]);


	}

	public static function getCidades()
	{

		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_cidades
		ORDER BY cidade ASC");

	}






}
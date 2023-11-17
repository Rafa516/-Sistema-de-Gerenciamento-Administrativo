<?php

namespace Projeto\Model;

use \Projeto\DB\Sql;
use \Projeto\Model;

//Classe unidade(marcações, com seus métodos específicos)
class Componente extends Model
{

	public function alterarComponentes()
	{

		$sql = new Sql();

		$results = $sql->select("CALL sp_edita_componentes(:id_componente,:componente
			)", array(
			":id_componente" => $this->getid_componente(),
			":componente" => $this->getcomponente(),

		)
		);


		$this->setData($results[0]);


	}

	public function get($id_componente)
	{

		$sql = new Sql();

		$results = $sql->select("SELECT  * FROM  tb_componentes WHERE id_componente = :id_componente", [
			':id_componente' => $id_componente
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



	//METODO PARA INCLUIR OS COMPONENTES
	public function incluirComponentes()
	{

		$var = isset($_POST['componente']) ? $_POST['componente'] : FALSE;

		for ($cont = 0; $cont < count($var); $cont++) {

			$var[$cont];

			$componente = $var[$cont];

			if ($componente != "") {

				$sql = new Sql();
				$sql->select("CALL sp_cadastro_componentes(:componente)", array(
					":componente" => $componente
				)
				);
			}
		}

	}


	//METODO PARA DELETAR UM COMPONENTE
	public function deleteComponente($id_componente)
	{

		$sql = new Sql();

		$sql->query("DELETE FROM tb_componentes WHERE id_componente = :id_componente", [
			':id_componente' => $id_componente
		]);


	}

	public static function getComponentes()
	{

		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_componentes
		ORDER BY componente ASC");

	}






}
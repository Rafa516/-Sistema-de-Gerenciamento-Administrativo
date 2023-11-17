<?php

namespace Projeto\Model;

use \Projeto\DB\Sql;
use \Projeto\Model;


//Classe Temporario(Temporario, com seus métodos específicos)
class Temporario extends Model
{

	//MÉTODO ESTÁTICO QUE VERIFICA O ARRAY DE DADOS

	public static function checkList($list)
	{

		foreach ($list as &$row) {

			$p = new Temporario();
			$p->setData($row);
			$row = $p->getValues();

		}

		return $list;

	}




	//METODO PARA REGISTRO DOS TEMPORARIOS
	public function registrarTemporarios()
	{

		$sql = new Sql();

		$results = $sql->select("CALL sp_registro_temporario(:nome,:matricula,:cpf,:componente,:ano
		)",
			array(
				":nome" => $this->getnome(),
				":matricula" => $this->getmatricula(),
				":cpf" => $this->getcpf(),
				":componente" => $this->getcomponente(),
				":ano" => $this->getano()
			)
		);

		$this->setData($results[0]);


	}

	//METODO PARA EDIÇÃO DOS TEMPORARIOS
	public function editarTemporarios()
	{

		$sql = new Sql();

		$results = $sql->select("CALL sp_edita_temporario(:id_temporario,:nome,:matricula,:cpf,:componente,:ano
	
		)",
			array(
				":id_temporario" => $this->getid_temporario(),
				":nome" => $this->getnome(),
				":matricula" => $this->getmatricula(),
				":cpf" => $this->getcpf(),
				":componente" => $this->getcomponente(),
				":ano" => $this->getano()

			)
		);

		$this->setData($results[0]);


	}

	//METODO GET POR ID   
	public function get($id_temporario)
	{

		$sql = new Sql();

		$results = $sql->select("SELECT  * FROM  tb_temporarios 
	     	WHERE id_temporario = :id_temporario", [
			':id_temporario' => $id_temporario
		]);

		$this->setData($results[0]);


	}




	//METODO PARA DELETAR UM TEMPORARIO
	public function delete()
	{

		$sql = new Sql();

		$sql->query("DELETE FROM tb_temporarios WHERE id_temporario = :id_temporario", [
			':id_temporario' => $this->getid_temporario()
		]);


	}



	//METODO PARA PEGAR OS VALORES DO ARRAY DE DADOS
	public function getValues()
	{


		$values = parent::getValues();

		return $values;

	}


	//PAGINAÇÃO DA PÁGINA TODOS TEMPORARIOS
	public static function getPageTemporario($page = 1, $itemsPerPage = 25)
	{

		$start = ($page - 1) * $itemsPerPage;

		$sql = new Sql();

		$results = $sql->select("
			SELECT SQL_CALC_FOUND_ROWS * 
		    FROM   tb_temporarios 
		    ORDER BY nome ASC 
			LIMIT $start, $itemsPerPage");


		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");

		return [
			'data' => $results,
			'total' => (int) $resultTotal[0]["nrtotal"],
			'pages' => ceil($resultTotal[0]["nrtotal"] / $itemsPerPage)
		];

	}

	//BUSCA DA PÁGINA TODOS TEMPORARIOS

	public static function getPageSearchTemporario($search, $page = 1, $itemsPerPage = 25)
	{

		$start = ($page - 1) * $itemsPerPage;

		$sql = new Sql();

		$results = $sql->select("
			SELECT SQL_CALC_FOUND_ROWS *
			FROM  tb_temporarios  
			WHERE  nome LIKE :search  OR matricula LIKE :search OR cpf LIKE :search	OR componente LIKE :search	
			ORDER BY nome ASC
			LIMIT $start, $itemsPerPage;
		", [
			':search' => '%' . $search . '%'
		]);

		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");

		return [
			'data' => $results,
			'total' => (int) $resultTotal[0]["nrtotal"],
			'pages' => ceil($resultTotal[0]["nrtotal"] / $itemsPerPage)
		];

	}


	//BUSCAR TEMPORARIOS CADASTRADOS 
	public static function getTemporariosCadastrados()
	{

		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_temporarios
		ORDER BY nome ASC");

	}






}
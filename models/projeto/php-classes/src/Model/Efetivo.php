<?php

namespace Projeto\Model;

use \Projeto\DB\Sql;
use \Projeto\Model;


//Classe Efetivo(Efetivo, com seus métodos específicos)
class Efetivo extends Model
{

	//MÉTODO ESTÁTICO QUE VERIFICA O ARRAY DE DADOS

	public static function checkList($list)
	{

		foreach ($list as &$row) {

			$p = new Efetivo();
			$p->setData($row);
			$row = $p->getValues();

		}

		return $list;

	}

	//METODO PARA REGISTRO DOS EFETIVOS
	public function registrarEfetivos()
	{

		$sql = new Sql();

		$results = $sql->select("CALL sp_registro_efetivo(:id_unidade,:nome_servidor,:matricula,:carreira
		)",
			array(
				":id_unidade" => $this->getid_unidade(),
				":nome_servidor" => $this->getnome_servidor(),
				":matricula" => $this->getmatricula(),
				":carreira" => $this->getcarreira()
			)
		);

		$this->setData($results[0]);


	}

	//METODO PARA EDIÇÃO DOS EFETIVOS
	public function editarEfetivos()
	{

		$sql = new Sql();

		$results = $sql->select("CALL sp_edita_efetivo(:id_efetivo,:id_unidade,:nome_servidor,:matricula,:carreira
	
		)",
			array(
				":id_efetivo" => $this->getid_efetivo(),
				":id_unidade" => $this->getid_unidade(),
				":nome_servidor" => $this->getnome_servidor(),
				":matricula" => $this->getmatricula(),
				":carreira" => $this->getcarreira()

			)
		);

		$this->setData($results[0]);


	}

	//METODO GET POR ID   
	public function get($id_efetivo)
	{

		$sql = new Sql();

		$results = $sql->select("SELECT  * FROM  tb_efetivos a
		    INNER JOIN tb_unidades b ON a.id_unidade = b.id_unidade
	     	WHERE a.id_efetivo = :id_efetivo", [
			':id_efetivo' => $id_efetivo
		]);

		$this->setData($results[0]);


	}




	//METODO PARA DELETAR UM Efetivo
	public function delete()
	{

		$sql = new Sql();

		$sql->query("DELETE FROM tb_efetivos WHERE id_efetivo = :id_efetivo", [
			':id_efetivo' => $this->getid_efetivo()
		]);


	}



	//METODO PARA PEGAR OS VALORES DO ARRAY DE DADOS
	public function getValues()
	{


		$values = parent::getValues();

		return $values;

	}


	//PAGINAÇÃO DA PÁGINA TODOS EFETIVOS
	public static function getPageEfetivo($page = 1, $itemsPerPage = 25)
	{

		$start = ($page - 1) * $itemsPerPage;

		$sql = new Sql();

		$results = $sql->select("
			SELECT SQL_CALC_FOUND_ROWS * 
		    FROM   tb_efetivos a
			INNER JOIN tb_unidades b ON a.id_unidade  = b.id_unidade
		    ORDER BY a.nome_servidor ASC 
			LIMIT $start, $itemsPerPage");


		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");

		return [
			'data' => $results,
			'total' => (int) $resultTotal[0]["nrtotal"],
			'pages' => ceil($resultTotal[0]["nrtotal"] / $itemsPerPage)
		];

	}

	//BUSCA DA PÁGINA TODOS EFETIVOS

	public static function getPageSearchEfetivo($search, $page = 1, $itemsPerPage = 25)
	{

		$start = ($page - 1) * $itemsPerPage;

		$sql = new Sql();

		$results = $sql->select("
			SELECT SQL_CALC_FOUND_ROWS *
			FROM   tb_efetivos a
			INNER JOIN tb_unidades b ON a.id_unidade  = b.id_unidade  
			WHERE  a.nome_servidor LIKE :search  OR a.matricula LIKE :search OR b.nome LIKE :search  OR b.sigla LIKE :search	OR a.carreira LIKE :search	
			ORDER BY a.nome_servidor ASC
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


	//BUSCAR EFETIVOS CADASTRADOS 
	public static function getEfetivosCadastrados()
	{

		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_efetivos a
		INNER JOIN tb_unidades b ON a.id_unidade = b.id_unidade
		ORDER BY a.nome_servidor ASC");

	}






}
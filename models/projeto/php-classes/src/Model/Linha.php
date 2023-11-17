<?php

namespace Projeto\Model;

use \Projeto\DB\Sql;
use \Projeto\Model;


//Classe Linha(Linha, com seus métodos específicos)
class Linha extends Model
{

	//MÉTODO ESTÁTICO QUE VERIFICA O ARRAY DE DADOS

	public static function checkList($list)
	{

		foreach ($list as &$row) {

			$p = new Linha();
			$p->setData($row);
			$row = $p->getValues();

		}

		return $list;

	}

	//METODO QUE VERIFICA O TOTAL DE LINHAS 
	public static function linhasTotal()
	{

		$sql = new Sql();
		$total = $sql->select("SELECT COUNT(id_linha) as Total
			FROM tb_linhas WHERE codigo = 'Linhas'");

		return ['linhasTotal' => (int) $total[0]["Total"]];
	}


	public function getLinhas($id_termos)
	{

		$sql = new Sql();
		$results = $sql->select("SELECT * FROM tb_retirada_linhas_termos a 
		INNER JOIN tb_linhas b USING(id_linha) WHERE a.id_termos = :id_termos", [
			':id_termos' => $id_termos
		]);

		return ['data' => $results];

	}



	//METODO PARA DELETAR UM LINHA
	public function delete($id_linha)
	{

		$sql = new Sql();

		$sql->query("DELETE FROM tb_linhas WHERE id_linha = :id_linha", [
			':id_linha' => $id_linha
		]);


	}


	//METODO PARA PEGAR OS VALORES DO ARRAY DE DADOS
	public function getValues()
	{


		$values = parent::getValues();

		return $values;

	}

	//METODO PARA REGISTRO DAS LINHAS 
	public function registrarLinhas()
	{

		$sql = new Sql();

		$results = $sql->select("CALL sp_registro_linhas(:codigo,:cidade_linha,:valor,:valor_diario
			)",
			array(
				":codigo" => $this->getcodigo(),
				":cidade_linha" => $this->getcidade_linha(),
				":valor" => $this->getvalor(),
				":valor_diario" => $this->getvalor() * 2
			)
		);



		$this->setData($results[0]);


	}

	//METODO PARA ALTERAÇÃO DAS LINHAS 
	public function editarLinhas()
	{

		$sql = new Sql();

		$results = $sql->select("CALL sp_edita_linhas(:id_linha,:codigo,:cidade_linha,:valor,:valor_diario
			)",
			array(
				":id_linha" => $this->getid_linha(),
				":codigo" => $this->getcodigo(),
				":cidade_linha" => $this->getcidade_linha(),
				":valor" => $this->getvalor(),
				":valor_diario" => $this->getvalor() * 2


			)
		);
		$this->setData($results[0]);


	}


	public function get($id_linha)
	{

		$sql = new Sql();

		$results = $sql->select("SELECT  * FROM   tb_linhas WHERE id_linha = :id_linha", [
			':id_linha' => $id_linha
		]);

		$this->setData($results[0]);

	}


	//PAGINAÇÃO DA PÁGINA DAS LINHAS 
	public static function getPageLinha($page = 1, $itemsPerPage = 5)
	{

		$start = ($page - 1) * $itemsPerPage;

		$sql = new Sql();

		$results = $sql->select("
			SELECT SQL_CALC_FOUND_ROWS *
			FROM tb_linhas		 
			ORDER BY cidade_linha ASC
			LIMIT $start, $itemsPerPage");


		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");

		return [
			'data' => $results,
			'total' => (int) $resultTotal[0]["nrtotal"],
			'pages' => ceil($resultTotal[0]["nrtotal"] / $itemsPerPage)
		];

	}

	//BUSCA DA PÁGINA do LINHAS 

	public static function getPageSearch($search, $page = 1, $itemsPerPage = 5)
	{

		$start = ($page - 1) * $itemsPerPage;

		$sql = new Sql();

		$results = $sql->select("
			SELECT SQL_CALC_FOUND_ROWS *
			FROM tb_linhas 
			WHERE  codigo LIKE :search  OR cidade_linha LIKE :search OR  valor  LIKE :search  OR valor_diario LIKE :search
			ORDER BY cidade_linha ASC
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

	public static function getLinhasCadastradas()
	{

		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_linhas 
		ORDER BY cidade_linha ASC");

	}




}
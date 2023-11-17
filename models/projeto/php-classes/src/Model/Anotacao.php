<?php

namespace Projeto\Model;

use \Projeto\DB\Sql;
use \Projeto\Model;


//Classe Anotacao(Anotacao, com seus métodos específicos)
class Anotacao extends Model
{

	//MÉTODO ESTÁTICO QUE VERIFICA O ARRAY DE DADOS

	public static function checkList($list)
	{

		foreach ($list as &$row) {

			$p = new Anotacao();
			$p->setData($row);
			$row = $p->getValues();

		}

		return $list;

	}

	//METODO PARA ARMAZENAR HISTÓRICO DAS ANOTACOES EXCLUÍDAS
	public function historico_anotacoes($nome_user){

		$sql = new Sql();

			$results = $sql->select("CALL sp_registro_historico(:usuario,:informacao)",
			array(
				":usuario" => $nome_user,
				":informacao" => 'Título: '.$this->getnome().' | Anotação: '.$this->getanotacoes()
			)
		);

		$this->setData($results[0]);

	}



	//METODO PARA DELETAR UMA ANOTAÇÃO
	public function delete($id_anotacao)
	{

		$sql = new Sql();

		$sql->query("DELETE FROM tb_anotacoes WHERE id_anotacao = :id_anotacao", [
			':id_anotacao' => $id_anotacao
		]);



	}


	//METODO PARA PEGAR OS VALORES DO ARRAY DE DADOS
	public function getValues()
	{


		$values = parent::getValues();

		return $values;

	}

	//METODO PARA REGISTRO DAS ANOTAÇÕES
	public function registrarAnotacao()
	{

		$sql = new Sql();

		$results = $sql->select("CALL sp_registro_anotacoes(:id_usuario,:nome,:anotacoes
			)",
			array(
				":id_usuario" => $this->getid_usuario(),
				":nome" => $this->getnome(),
				":anotacoes" => $this->getanotacoes()
			)
		);



		$this->setData($results[0]);


	}

	//METODO PARA ALTERAÇÃO DAS ANOTAÇÕES
	public function editarAnotacoes()
	{

		$sql = new Sql();

		$results = $sql->select("CALL sp_edita_anotacoes(:id_anotacao,:id_usuario,:nome,:anotacoes
			)",
			array(
				":id_anotacao" => $this->getid_anotacao(),
				":id_usuario" => $this->getid_usuario(),
				":nome" => $this->getnome(),
				":anotacoes" => $this->getanotacoes()

			)
		);


		$this->setData($results[0]);


	}


	public function get($id_anotacao)
	{

		$sql = new Sql();

		$results = $sql->select("SELECT  * FROM   tb_anotacoes a
		INNER JOIN tb_usuarios b ON a.id_usuario = b.id_usuario
		WHERE id_anotacao = :id_anotacao", [
			':id_anotacao' => $id_anotacao
		]);

		$this->setData($results[0]);

	}

	//PAGINAÇÃO DA PÁGINA TODAS ANOTAÇÕES 
	public function getTodasAnotacoes($page = 1, $itemsPerPage = 25)
	{

		$start = ($page - 1) * $itemsPerPage;

		$sql = new Sql();

		$results = $sql->select("
		SELECT SQL_CALC_FOUND_ROWS *
		FROM  tb_anotacoes a 
		INNER JOIN tb_usuarios b ON  a.id_usuario = b.id_usuario 
		ORDER BY a.dt_registro_anotacao DESC
		LIMIT $start, $itemsPerPage");

		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");

		return [
			'data' => $results,
			'total' => (int) $resultTotal[0]["nrtotal"],
			'pages' => ceil($resultTotal[0]["nrtotal"] / $itemsPerPage)
		];

	}

	//BUSCA DA PÁGINA TODAS ANOTACOES

	public static function getSearchTodasAnotacoes($search, $page = 1, $itemsPerPage = 25)
	{

		$start = ($page - 1) * $itemsPerPage;

		$sql = new Sql();

		$results = $sql->select("
		SELECT SQL_CALC_FOUND_ROWS *
		FROM tb_usuarios a INNER JOIN  tb_anotacoes b ON b.id_usuario = a.id_usuario 
		WHERE b.nome LIKE :search OR b.dt_registro_anotacao LIKE :search 
		ORDER BY b.dt_registro_anotacao DESC
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




}
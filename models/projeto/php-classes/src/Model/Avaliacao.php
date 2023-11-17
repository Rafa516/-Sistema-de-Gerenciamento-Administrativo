<?php

namespace Projeto\Model;

use \Projeto\DB\Sql;
use \Projeto\Model;


//Classe Avaliacao(Avaliacao, com seus métodos específicos)
class Avaliacao extends Model
{

	//MÉTODO ESTÁTICO QUE VERIFICA O ARRAY DE DADOS

	public static function checkList($list)
	{

		foreach ($list as &$row) {

			$p = new Avaliacao();
			$p->setData($row);
			$row = $p->getValues();

		}

		return $list;

	}

	//METODO PARA ARMAZENAR HISTÓRICO DAS AVALIACOES EXCLUÍDAS
	public function historico_avaliacoes($nome_user){

		$sql = new Sql();

			$results = $sql->select("CALL sp_registro_historico(:usuario,:informacao)",
			array(
				":usuario" => $nome_user,
				":informacao" => 'Unidade: '.$this->getnome().' | Semestre: '.$this->getsemestre().' | Situação: '.$this->getsituacao().' | Observação: '.$this->getobservacao()
			)
		);

		$this->setData($results[0]);

	}


	//METODO PARA DELETAR UMA AVALIAÇÃO
	public function delete($id_avaliacao)
	{

		$sql = new Sql();

		$sql->query("DELETE FROM tb_avaliacoes WHERE id_avaliacao = :id_avaliacao", [
			':id_avaliacao' => $id_avaliacao
		]);


	}


	//METODO PARA PEGAR OS VALORES DO ARRAY DE DADOS
	public function getValues()
	{


		$values = parent::getValues();

		return $values;

	}

	//METODO PARA REGISTRO DAS AVALIAÇÕES
	public function registrarAvaliacoes()
	{

		$sql = new Sql();

		$results = $sql->select("CALL sp_registro_avaliacao(:id_unidade,:id_usuario,:semestre,:situacao,:observacao
			)",
			array(
				":id_unidade" => $this->getid_unidade(),
				":id_usuario" => $this->getid_usuario(),
				":semestre" => $this->getsemestre(),
				":situacao" => $this->getsituacao(),
				":observacao" => $this->getobservacao()
			)
		);

		$this->setData($results[0]);


	}

	//METODO PARA ALTERAÇÃO DAS AVALIAÇÕES
	public function editarAvaliacoes()
	{

		$sql = new Sql();

		$results = $sql->select("CALL sp_edita_avaliacao(:id_avaliacao,:id_unidade,:id_usuario,:semestre,:situacao,:observacao
			)",
			array(
				":id_avaliacao" => $this->getid_avaliacao(),
				":id_unidade" => $this->getid_unidade(),
				":id_usuario" => $this->getid_usuario(),
				":semestre" => $this->getsemestre(),
				":situacao" => $this->getsituacao(),
				":observacao" => $this->getobservacao(),
			)
		);

		$this->setData($results[0]);


	}


	public function get($id_avaliacao)
	{

		$sql = new Sql();

		$results = $sql->select("SELECT  * FROM   tb_avaliacoes a
		INNER JOIN tb_unidades b ON a.id_unidade = b.id_unidade
		INNER JOIN tb_usuarios c ON c.id_usuario = a.id_usuario
		WHERE id_avaliacao = :id_avaliacao", [
			':id_avaliacao' => $id_avaliacao
		]);

		$this->setData($results[0]);


	}


	//PAGINAÇÃO DA PÁGINA DAS AVALIAÇÕES
	public static function getPageAvaliacao($page = 1, $itemsPerPage = 50)
	{

		$start = ($page - 1) * $itemsPerPage;

		$sql = new Sql();

		$results = $sql->select("
			SELECT SQL_CALC_FOUND_ROWS *
			FROM tb_avaliacoes a INNER JOIN tb_unidades b
            ON a.id_unidade = b.id_unidade
			ORDER BY codigo ASC

			LIMIT $start, $itemsPerPage");


		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");

		return [
			'data' => $results,
			'total' => (int) $resultTotal[0]["nrtotal"],
			'pages' => ceil($resultTotal[0]["nrtotal"] / $itemsPerPage)
		];

	}

	//BUSCA DA PÁGINA DAS AVALIAÇÕES

	public static function getPageSearch($search, $page = 1, $itemsPerPage = 50)
	{

		$start = ($page - 1) * $itemsPerPage;

		$sql = new Sql();

		$results = $sql->select("
			SELECT SQL_CALC_FOUND_ROWS *
			FROM tb_avaliacoes a INNER JOIN tb_unidades b
			ON a.id_unidade = b.id_unidade
			WHERE a.semestre LIKE :search 
			ORDER BY b.codigo ASC
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

	public static function getAvaliacoesCadastradas()
	{

		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_avaliacoes 
		ORDER BY cidade ASC");

	}




}
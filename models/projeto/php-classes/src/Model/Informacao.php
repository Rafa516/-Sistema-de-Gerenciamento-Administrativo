<?php

namespace Projeto\Model;

use \Projeto\DB\Sql;
use \Projeto\Model;

//Classe Call(Chamados, com seus métodos específicos)
class Informacao extends Model
{


	//Método estático que verifica o array de dados
	public static function checkList($list)
	{

		foreach ($list as &$row) {

			$p = new Informacao();
			$p->setData($row);
			$row = $p->getValues();

		}

		return $list;

	}


	//Método que busca os dados do procedimento e salva no tabela de informações
	public function cadastrarIndformacao()
	{

		$sql = new Sql();

		$results = $sql->select(
			"CALL sp_cadastro_informacao(:id_usuario,:titulo,:informacoes)",
			array(
				":id_usuario" => $this->getid_usuario(),
				":titulo" => $this->gettitulo(),
				":informacoes" => $this->getinformacoes()
			)
		);

		$this->setData($results[0]);
		;

	}

	public function alterarInformacao()
	{
		$sql = new Sql();

		$results = $sql->select('CALL sp_informacao_editar(:id_informacao,:alteracao,:titulo,:informacoes)', [
			":id_informacao" => $this->getid_informacao(),
			":alteracao" => $this->getalteracao(),
			":titulo" => $this->gettitulo(),
			":informacoes" => $this->getinformacoes()
		]);
	}




	//Método que seleciona todas informações passando a ID por parâmetro
	public function get($id_informacao)
	{

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_informacoes a
		INNER JOIN tb_usuarios b ON a.id_usuario = b.id_usuario
		WHERE id_informacao = :id_informacao", [
			':id_informacao' => $id_informacao
		]);

		$this->setData($results[0]);

		return ['value' => $results[0]["id_informacao"]];

	}

    //METODO PARA ARMAZENAR HISTÓRICO DAS INFORMAÇÕES EXCLUÍDAS
	public function historico_informacao($nome_user){

		$sql = new Sql();

		$results = $sql->select("CALL sp_registro_historico(:usuario,:informacao)",
			array(
				":usuario" => $nome_user,
				":informacao" => 'Titulo da Informação: '.$this->gettitulo().' | Autor: '.$this->getnome_user()
			)
		);

		$this->setData($results[0]);

	 }


	//Método para deletar uma informação
	public function delete()
	{

		$sql = new Sql();

		$sql->query("DELETE FROM tb_informacoes WHERE id_informacao = :id_informacao", [
			':id_informacao' => $this->getid_informacao()
		]);


	}


	//Método para pegar os valores do array
	public function getValues()
	{


		$values = parent::getValues();

		return $values;

	}

	public static function getPageInformacoes($page = 1, $itemsPerPage = 5)
	{

		$start = ($page - 1) * $itemsPerPage;

		$sql = new Sql();

		$results = $sql->select("
		SELECT SQL_CALC_FOUND_ROWS *
		FROM tb_usuarios a 
		INNER JOIN tb_informacoes b ON b.id_usuario = a.id_usuario 	 
		ORDER BY b.dt_registro_informacao DESC
		LIMIT $start, $itemsPerPage");

		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");




		return [
			'data' => $results,
			'total' => (int) $resultTotal[0]["nrtotal"],
			'pages' => ceil($resultTotal[0]["nrtotal"] / $itemsPerPage)
		];

	}



	public static function getPageSearchInformacoes($search, $page = 1, $itemsPerPage = 5)
	{

		$start = ($page - 1) * $itemsPerPage;

		$sql = new Sql();

		$results = $sql->select("
			SELECT SQL_CALC_FOUND_ROWS *
			FROM tb_usuarios a 
		    INNER JOIN tb_informacoes b ON b.id_usuario = a.id_usuario 
			WHERE b.titulo LIKE :search OR b.informacoes LIKE :search  OR a.nome_user LIKE :search    
			ORDER BY b.dt_registro_informacao DESC
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
<?php

namespace Projeto\Model;

use \Projeto\DB\Sql;
use \Projeto\Model;



//Classe Itinerario(Itinerario, com seus métodos específicos)
class Itinerario extends Model
{


	//MÉTODO ESTÁTICO QUE VERIFICA O ARRAY DE DADOS

	public static function checkList($list)
	{

		foreach ($list as &$row) {

			$p = new Itinerario();
			$p->setData($row);
			$row = $p->getValues();

		}

		return $list;

	}

	//METODO PARA PEGAR OS VALORES DO ARRAY DE DADOS
	public function getValues()
	{


		$values = parent::getValues();

		return $values;

	}

	public function get($id_itinerarios)
	{

		$sql = new Sql();

		$results = $sql->select("SELECT  * FROM   tb_itinerarios a
		INNER JOIN tb_usuarios b ON b.id_usuario = a.id_usuario
		WHERE id_itinerarios = :id_itinerarios", [
			':id_itinerarios' => $id_itinerarios
		]);

		$this->setData($results[0]);

	}


	public function getLinhasItinerario($id_itinerarios_linhas)
	{

		$sql = new Sql();
		$results = $sql->select("SELECT * FROM tb_itinerarios_linhas a
		INNER JOIN tb_linhas b ON  a.id_linha = b.id_linha 
		WHERE a.id_itinerarios_linhas = :id_itinerarios_linhas ", [
			':id_itinerarios_linhas' => $id_itinerarios_linhas
		]);
		$this->setData($results[0]);

	}

	//METODO PARA CADASTRO DOS ITINERARIOS
	public function cadastrarItinerarios()
	{

		$sql = new Sql();

		$results = $sql->select("CALL sp_cadastro_itinerarios(:id_usuario,:nome_itinerario,:cidade,:observacoes

		)",
			array(
				":id_usuario" => $this->getid_usuario(),
				":nome_itinerario" => $this->getnome_itinerario(),
				":cidade" => $this->getcidade(),
				":observacoes" => $this->getobservacoes(),
			)
		);


		$this->setData($results[0]);

		$this->incluirLinhasNoItinerario();

	}



	//METODO PARA EDIÇÃO DOS ITINERARIOS
	public function editarItinerarios()
	{

		$sql = new Sql();

		$results = $sql->select("CALL sp_edita_itinerario(:id_itinerarios,:id_usuario,:nome_itinerario,:cidade,:observacoes
		)",
			array(
				":id_itinerarios" => $this->getid_itinerarios(),
				":id_usuario" => $this->getid_usuario(),
				":nome_itinerario" => $this->getnome_itinerario(),
				":cidade" => $this->getcidade(),
				":observacoes" => $this->getobservacoes(),

			)
		);

		$this->setData($results[0]);

		$this->incluirLinhasNoItinerario();





	}

	//METODO PARA ALTERAÇÃO DOS ANALISTAS
	public function alterarAnalista()
	{

		$sql = new Sql();

		$results = $sql->select("CALL sp_altera_analista_itinerario(:id_itinerarios,:id_usuario

		)",
			array(
				":id_itinerarios" => $this->getid_itinerarios(),
				":id_usuario" => $this->getid_usuario()

			)
		);

		$this->setData($results[0]);


	}

	public function historico_itinerario($nome_user){

		$sql = new Sql();

		$results = $sql->select("CALL sp_registro_historico(:usuario,:informacao)",
			array(
				":usuario" => $nome_user,
				":informacao" => 'Nome do Itinerário: '.$this->getnome_itinerario().' | Valor: R$ '.$this->getvalor_total()
			)
		);

		$this->setData($results[0]);

	 }




	//METODO PARA DELETAR UM ITINERARIO
	public function delete($id_itinerarios)
	{

		$sql = new Sql();

		$sql->query("DELETE FROM tb_itinerarios WHERE id_itinerarios = :id_itinerarios", [
			":id_itinerarios" => $id_itinerarios
		]);

	}


	//METODO PARA DELETAR UMA LINHA DO ITINERARIO
	public function deleteLinhaItinerario($id_itinerarios_linhas)
	{

		$sql = new Sql();

		$sql->query("DELETE FROM  tb_itinerarios_linhas WHERE id_itinerarios_linhas = :id_itinerarios_linhas", [
			"id_itinerarios_linhas" => $id_itinerarios_linhas
		]);


		$total = $sql->select("SELECT SUM(b.valor_diario) as Total FROM tb_itinerarios_linhas a 
		INNER JOIN tb_linhas b USING(id_linha) 
		WHERE a.id_itinerarios = :id_itinerarios ", [
			':id_itinerarios' => $this->getid_itinerarios()
		]);


		$valor_total = (double) $total[0]["Total"];

		if ($valor_total > 0) {
			$sql->query("UPDATE tb_itinerarios a  
								INNER JOIN tb_itinerarios_linhas b
								ON a.id_itinerarios = b.id_itinerarios
								INNER JOIN tb_linhas c
								ON c.id_linha = b.id_linha
								SET a.valor_total =  $valor_total
								WHERE b.id_itinerarios = :id_itinerarios", [
				":id_itinerarios" => $this->getid_itinerarios(),


			]);
		} else {

			$sql->query("UPDATE tb_itinerarios  
								SET valor_total =  0
								WHERE id_itinerarios = :id_itinerarios", [
				":id_itinerarios" => $this->getid_itinerarios(),


			]);

		}

	}


	//PAGINAÇÃO DA PÁGINA TODOS ITINERARIOS
	public static function getPageAll($page = 1, $itemsPerPage = 25)
	{

		$start = ($page - 1) * $itemsPerPage;

		$sql = new Sql();

		$results = $sql->select("
			SELECT SQL_CALC_FOUND_ROWS *
			FROM tb_usuarios a INNER JOIN tb_itinerarios b ON b.id_usuario = a.id_usuario 	 
			ORDER BY b.nome_itinerario ASC
			LIMIT $start, $itemsPerPage");


		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");

		return [
			'data' => $results,
			'total' => (int) $resultTotal[0]["nrtotal"],
			'pages' => ceil($resultTotal[0]["nrtotal"] / $itemsPerPage)
		];

	}

	//BUSCA DA PÁGINA TODOS ITINERARIOS 

	public static function getPageSearch($search, $page = 1, $itemsPerPage = 25)
	{

		$start = ($page - 1) * $itemsPerPage;

		$sql = new Sql();

		$results = $sql->select("
			SELECT SQL_CALC_FOUND_ROWS *
			FROM tb_usuarios a INNER JOIN  tb_itinerarios b ON b.id_usuario = a.id_usuario 
			WHERE  a.nome_user LIKE :search OR b.nome_itinerario LIKE :search OR b.valor_total LIKE :search
			ORDER BY b.data_registro DESC
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


	//BUSCA NA TABELA USUÁRIOS
	public static function getAnalistas()
	{

		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_usuarios   
		ORDER BY nome_user ASC");


	}

	//METODO PARA INCLUIR AS LINHAS
	public function incluirLinhasNoItinerario()
	{

		$linha = isset($_POST['id_linha']) ? $_POST['id_linha'] : FALSE;

		for ($cont = 0; $cont < count($linha); $cont++) {

			$linha[$cont];

			$id_linha = $linha[$cont];


			if ($id_linha != "") {

				$sql = new Sql();
				$sql->select(
					"CALL sp_cadastro_itinerario_linhas(:id_itinerarios,:id_linha)",
					array(
						":id_itinerarios" => $this->getid_itinerarios(),
						":id_linha" => $id_linha,

					)
				);
				//ADICIONANDO O VALOR TOTAL DO ITINERÁRIO PARA CADA ITERAÇÃO

				$total = $sql->select("SELECT SUM(b.valor_diario) as Total FROM tb_itinerarios_linhas a 
				INNER JOIN tb_linhas b USING(id_linha) 
				WHERE a.id_itinerarios = :id_itinerarios ", [
					':id_itinerarios' => $this->getid_itinerarios()
				]);

				$valor_total = (double) $total[0]["Total"];

				$sql->query("UPDATE tb_itinerarios a  
							INNER JOIN tb_itinerarios_linhas b
						    ON a.id_itinerarios = b.id_itinerarios
							INNER JOIN tb_linhas c
							ON c.id_linha = b.id_linha
							SET a.valor_total = $valor_total
						    WHERE b.id_itinerarios = :id_itinerarios 
							AND b.id_linha = :id_linha", [
					":id_itinerarios" => $this->getid_itinerarios(),
					":id_linha" => $id_linha,

				]);

			}
		}

	}


	public function getItinerarioLinhas($id_itinerarios)
	{

		$sql = new Sql();
		$results = $sql->select("SELECT * FROM tb_itinerarios_linhas a 
		INNER JOIN tb_linhas b USING(id_linha) 
		WHERE a.id_itinerarios = :id_itinerarios ", [
			':id_itinerarios' => $id_itinerarios
		]);

		return ['data' => $results];

	}

	//BUSCAR ITINERARIOS CADASTRADOS 
	public static function getItinerariosCadastrados()
	{

		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_itinerarios
		ORDER BY nome_itinerario ASC");

	}

	public static function getItinerariosGrafico()
	{

		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_itinerarios
		ORDER BY valor_total DESC");

	}










}
<?php

namespace Projeto\Model;

use \Projeto\DB\Sql;
use \Projeto\Model;


//Classe Dossie(Dossie, com seus métodos específicos)
class Dossie extends Model
{

	//MÉTODO ESTÁTICO QUE VERIFICA O ARRAY DE DADOS

	public static function checkList($list)
	{

		foreach ($list as &$row) {

			$p = new Dossie();
			$p->setData($row);
			$row = $p->getValues();

		}

		return $list;

	}


	//METODO QUE VERIFICA O TOTAL  DE DOSSIES  REGISTRADOS
	public static function totalDossies()
	{

		$sql = new Sql();
		$total = $sql->select("SELECT COUNT(id_dossie) as Total
			FROM tb_dossiers");

		return ['dossiersTotal' => (int) $total[0]["Total"]];
	}



	//METODO PARA REGISTRO DOS DOSSIES
	public function registrarDossies()
	{

		$sql = new Sql();

		$results = $sql->select("CALL sp_registro_dossiers(:id_usuario,:id_temporario,:regime
		)",
			array(
				":id_usuario" => $this->getid_usuario(),
				":id_temporario" => $this->getid_temporario(),
				":regime" => $this->getregime()
			)
		);

		$this->setData($results[0]);


		Dossie::moveArquivo();

	}

	//METODO PARA EDIÇÃO DOS DOSSIES
	public function editarDossies()
	{

		$sql = new Sql();

		$var = isset($_POST['ano_arquivo']) ? $_POST['ano_arquivo'] : FALSE;

		$ano_arquivo = $var;

		$sql->query("UPDATE tb_arquivos_dossiers a  
		INNER JOIN tb_dossiers b
		ON a.id_dossie = b.id_dossie
		SET a.ano_arquivo = :ano_arquivo
		WHERE a.id_dossie = :id_dossie", [
			":id_dossie" => $this->getid_dossie(),
			":ano_arquivo" => $ano_arquivo,

		]);

		$results = $sql->select("CALL sp_edita_dossie(:id_dossie,:id_temporario,:id_usuario,:regime
	
		)",
			array(
				":id_dossie" => $this->getid_dossie(),
				":id_temporario" => $this->getid_temporario(),
				":id_usuario" => $this->getid_usuario(),
				":regime" => $this->getregime()

			)
		);

		$this->setData($results[0]);




	}

	//METODO GET POR ID   
	public function get($id_dossie)
	{

		if (numArquivosDossiers($id_dossie) == 0) {
			$sql = new Sql();

			$results = $sql->select("SELECT  * FROM  tb_dossiers a 
			INNER JOIN tb_temporarios b ON b.id_temporario = a.id_temporario
			INNER JOIN tb_usuarios c ON c.id_usuario = a.id_usuario
	     	WHERE id_dossie = :id_dossie", [
				':id_dossie' => $id_dossie
			]);

			$this->setData($results[0]);

		} else {
			$sql = new Sql();

			$results = $sql->select("SELECT  * FROM  tb_dossiers a 
	     	INNER JOIN  tb_arquivos_dossiers b USING(id_dossie)
			INNER JOIN tb_temporarios c ON c.id_temporario = a.id_temporario
			INNER JOIN tb_usuarios d ON d.id_usuario = a.id_usuario
	     	WHERE id_dossie = :id_dossie", [
				':id_dossie' => $id_dossie
			]);

			$this->setData($results[0]);


		}




	}



	public function getArquivo($id_arquivo_dossie)
	{

		$sql = new Sql();

		$results = $sql->select("SELECT  * FROM  tb_arquivos_dossiers 
	     	WHERE id_arquivo_dossie = :id_arquivo_dossie", [
			':id_arquivo_dossie' => $id_arquivo_dossie
		]);

		$this->setData($results[0]);



	}


	//METODO PARA DELETAR UM DOSSIE
	public function delete()
	{

		$sql = new Sql();

		$sql->query("DELETE FROM tb_dossiers WHERE id_dossie = :id_dossie", [
			':id_dossie' => $this->getid_dossie()
		]);


		$img = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR .
			"res" . DIRECTORY_SEPARATOR .
			"arquivos_dossiers" . DIRECTORY_SEPARATOR .
			$this->getarquivo_dossie();
		unlink($img);

	}

	//METODO PARA DELETAR UM ARQUIVO
	public function deleteArquivo()
	{

		$sql = new Sql();

		$sql->query("DELETE FROM tb_arquivos_dossiers WHERE id_arquivo_dossie = :id_arquivo_dossie", [
			':id_arquivo_dossie' => $this->getid_arquivo_dossie()
		]);


		$img = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR .
			"res" . DIRECTORY_SEPARATOR .
			"arquivos_dossiers" . DIRECTORY_SEPARATOR .
			$this->getarquivo_dossie();
		unlink($img);

	}





	//METODO PARA PEGAR OS VALORES DO ARRAY DE DADOS
	public function getValues()
	{


		$values = parent::getValues();

		return $values;

	}


	//PAGINAÇÃO DA PÁGINA TODOS DOSSIES
	public static function getPageDossieTemporario($page = 1, $itemsPerPage = 25)
	{

		$start = ($page - 1) * $itemsPerPage;

		$sql = new Sql();

		$results = $sql->select("
			SELECT SQL_CALC_FOUND_ROWS *
		    FROM tb_usuarios a 
			INNER JOIN  tb_dossiers b ON b.id_usuario = a.id_usuario
			INNER JOIN tb_temporarios c ON c.id_temporario = b.id_temporario 
		    WHERE b.regime = 'Contrato Temporário'
		    ORDER BY c.nome 
			LIMIT $start, $itemsPerPage");


		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");

		return [
			'data' => $results,
			'total' => (int) $resultTotal[0]["nrtotal"],
			'pages' => ceil($resultTotal[0]["nrtotal"] / $itemsPerPage)
		];

	}

	//BUSCA DA PÁGINA TODOS DOSSIES

	public static function getPageSearchDossieTemporario($search, $page = 1, $itemsPerPage = 25)
	{

		$start = ($page - 1) * $itemsPerPage;

		$sql = new Sql();

		$results = $sql->select("
			SELECT SQL_CALC_FOUND_ROWS *
			FROM tb_usuarios a 
			INNER JOIN  tb_dossiers b ON b.id_usuario = a.id_usuario 
			INNER JOIN tb_temporarios c ON c.id_temporario = b.id_temporario
			WHERE  regime = 'Contrato Temporário' AND c.nome LIKE :search  OR c.matricula LIKE :search OR c.cpf LIKE :search
			
			ORDER BY c.nome ASC
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


	//METODO PARA ENVIAR O ARQUIVO

	public function moveArquivo()
	{

		$file = isset($_FILES['arquivo_dossie']) ? $_FILES['arquivo_dossie'] : FALSE;

		$var = isset($_POST['ano_arquivo']) ? $_POST['ano_arquivo'] : FALSE;


		//loop para ler os arquivos
		for ($cont = 0; $cont < count($file['name']); $cont++) {


			$directory = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR .
				"res" . DIRECTORY_SEPARATOR .
				"arquivos_dossiers" . DIRECTORY_SEPARATOR .

				$file['name'][$cont];

			$arquivo_dossie = $file['name'][$cont];
			$ano_arquivo = $var;

			$sql = new Sql();
			$sql->select(
				"CALL sp_arquivo_dossie_add(:id_dossie,:id_usuario,:arquivo_dossie,:ano_arquivo)",
				array(
					":id_dossie" => $this->getid_dossie(),
					":id_usuario" => $this->getid_usuario(),
					":arquivo_dossie" => $arquivo_dossie,
					":ano_arquivo" => $ano_arquivo
				)
			);


			move_uploaded_file($file['tmp_name'][$cont], $directory);

		}


	}

	//METODO PARA VERIFICAR O TOTAL DE ARQUIVO DE CADA DOCUMENTO
	public static function numArquivosDossiers($id_dossie)
	{

		$sql = new Sql();
		$total = $sql->select("SELECT SQL_CALC_FOUND_ROWS *
			FROM  tb_arquivos_dossiers WHERE id_dossie = :id_dossie", [
			':id_dossie' => $id_dossie
		]);
		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");

		return ['arquivos' => (int) $resultTotal[0]["nrtotal"]];
	}


	public static function nomeArquivos($id_dossie)
	{

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_arquivos_dossiers WHERE id_dossie = :id_dossie", [
			':id_dossie' => $id_dossie
		]);

		return ['nome' => $results[0]["arquivo_dossie"]];

	}

	//METODO PARA LISTAR OS ARQUIVOS
	public function showArquivo($id_dossie)
	{
		$sql = new Sql();


		$resultsExistFile = $sql->select("SELECT * FROM tb_arquivos_dossiers a
	    INNER JOIN tb_usuarios b ON  a.id_usuario = b.id_usuario
		WHERE id_dossie = :id_dossie ", [
			':id_dossie' => $id_dossie
		]);

		$countResultsFile = count($resultsExistFile);
		if ($countResultsFile > 0) {
			foreach ($resultsExistFile as &$result) {
				foreach ($result as $key => $value) {
					if ($key === "arquivo_dossie") {
						$result["arquivo"] = '/res/arquivos_dossiers/' . $result['arquivo_dossie'];
					}
				}
			}



			return $resultsExistFile;
		}


	}



}
<?php

namespace Projeto\Model;

use \Projeto\DB\Sql;
use \Projeto\Model;


//Classe Documento(Documento, com seus métodos específicos)
class Documento extends Model
{

	//MÉTODO ESTÁTICO QUE VERIFICA O ARRAY DE DADOS

	public static function checkList($list)
	{

		foreach ($list as &$row) {

			$p = new Documento();
			$p->setData($row);
			$row = $p->getValues();

		}

		return $list;

	}


	//METODO QUE VERIFICA O TOTAL  DE DOCUMENTOS REGISTRADOS
	public static function totalDocumentos()
	{

		$sql = new Sql();
		$total = $sql->select("SELECT COUNT(id_documento) as Total
			FROM tb_documentos");

		return ['documentosTotal' => (int) $total[0]["Total"]];
	}



	//METODO PARA REGISTRO DOS DOCUMENTOS
	public function registrarDocumentos()
	{

		$sql = new Sql();

		$results = $sql->select("CALL sp_registro_documentos(:id_usuario,:nome_documento,:dt_documento
		)",
			array(
				":id_usuario" => $this->getid_usuario(),
				":nome_documento" => $this->getnome_documento(),
				":dt_documento" => $this->getdt_documento()
			)
		);

		$this->setData($results[0]);

		Documento::moveArquivo();

	}

	//METODO PARA EDIÇÃO DOS DOCUMENTOS
	public function editarDocumentos()
	{

		$sql = new Sql();

		$results = $sql->select("CALL sp_edita_documento(:id_documento,:id_usuario,:nome_documento,:dt_documento
	
		)",
			array(
				":id_documento" => $this->getid_documento(),
				":id_usuario" => $this->getid_usuario(),
				":nome_documento" => $this->getnome_documento(),
				":dt_documento" => $this->getdt_documento()


			)
		);

		$this->setData($results[0]);


	}

	//METODO GET POR ID   
	public function get($id_documento)
	{

		if (numArquivosDocumentos($id_documento) == 0) {
			$sql = new Sql();

			$results = $sql->select("SELECT  * FROM  tb_documentos a
			INNER JOIN tb_usuarios b ON a.id_usuario = b.id_usuario
			WHERE id_documento = :id_documento", [
				':id_documento' => $id_documento
			]);

			$this->setData($results[0]);

		} else {
			$sql = new Sql();

			$results = $sql->select("SELECT  * FROM  tb_documentos a
			INNER JOIN tb_arquivos_documentos b USING(id_documento)
			INNER JOIN tb_usuarios c ON a.id_usuario = c.id_usuario
			WHERE id_documento = :id_documento", [
				':id_documento' => $id_documento
			]);

			$this->setData($results[0]);

		}



	}



	public function getArquivo($id_arquivoD)
	{

		$sql = new Sql();

		$results = $sql->select("SELECT  * FROM  tb_arquivos_documentos a
		INNER JOIN tb_documentos b ON a.id_documento = b.id_documento
	     	WHERE a.id_arquivoD = :id_arquivoD", [
			':id_arquivoD' => $id_arquivoD
		]);

		$this->setData($results[0]);



	}

	//METODO PARA ARMAZENAR HISTÓRICO DOS DOCUMENTOS EXCLUÍDOS
	public function historico_documentos($nome_user){

		$sql = new Sql();

			$results = $sql->select("CALL sp_registro_historico(:usuario,:informacao)",
			array(
				":usuario" => $nome_user,
				":informacao" => 'Nome do Documento: '.$this->getnome_documento()
			)
		);

		$this->setData($results[0]);

	}

	//METODO PARA ARMAZENAR HISTÓRICO DOS ARQUIVOS EXCLUÍDOS
	public function historico_arquivos($nome_user){

		$sql = new Sql();

			$results = $sql->select("CALL sp_registro_historico(:usuario,:informacao)",
			array(
				":usuario" => $nome_user,
				":informacao" => 'Arquivo: '.$this->getarquivo_documento().' | Nome do Documento: '.$this->getnome_documento()
			)
		);

		$this->setData($results[0]);

	}

	//METODO PARA DELETAR UM DOCUMENTO
	public function delete()
	{

		$sql = new Sql();

		$sql->query("DELETE FROM tb_documentos WHERE id_documento = :id_documento", [
			':id_documento' => $this->getid_documento()
		]);


		$img = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR .
			"res" . DIRECTORY_SEPARATOR .
			"arquivos_documentos" . DIRECTORY_SEPARATOR .
			$this->getarquivo_documento();
		unlink($img);

	}

	//METODO PARA DELETAR UM ARQUIVO
	public function deleteArquivo()
	{

		$sql = new Sql();

		$sql->query("DELETE FROM tb_arquivos_documentos WHERE id_arquivoD = :id_arquivoD", [
			':id_arquivoD' => $this->getid_arquivoD()
		]);


		$img = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR .
			"res" . DIRECTORY_SEPARATOR .
			"arquivos_documentos" . DIRECTORY_SEPARATOR .
			$this->getarquivo_documento();
		unlink($img);

	}




	//METODO PARA PEGAR OS VALORES DO ARRAY DE DADOS
	public function getValues()
	{


		$values = parent::getValues();

		return $values;

	}


	//PAGINAÇÃO DA PÁGINA TODOS DOCUMENTOS 
	public static function getPageAll($page = 1, $itemsPerPage = 25)
	{

		$start = ($page - 1) * $itemsPerPage;

		$sql = new Sql();

		$results = $sql->select("
			SELECT SQL_CALC_FOUND_ROWS *
		    FROM tb_usuarios a INNER JOIN  tb_documentos b ON b.id_usuario = a.id_usuario 
		    ORDER BY b.dt_documento DESC
			LIMIT $start, $itemsPerPage");


		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");

		return [
			'data' => $results,
			'total' => (int) $resultTotal[0]["nrtotal"],
			'pages' => ceil($resultTotal[0]["nrtotal"] / $itemsPerPage)
		];

	}

	//BUSCA DA PÁGINA TODOS DOCUMENTOS

	public static function getPageSearch($search, $page = 1, $itemsPerPage = 25)
	{

		$start = ($page - 1) * $itemsPerPage;

		$sql = new Sql();

		$results = $sql->select("
			SELECT SQL_CALC_FOUND_ROWS *
			FROM tb_usuarios a INNER JOIN  tb_documentos b ON b.id_usuario = a.id_usuario 
			WHERE  b.nome_documento LIKE :search  OR b.dt_documento LIKE :search 
			ORDER BY b.dt_documento DESC
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




	//BUSCA DA PÁGINA TODOS documentos ADMINISTRADOR
	public static function getPageSearchAll($search, $page = 1, $itemsPerPage = 25)
	{

		$start = ($page - 1) * $itemsPerPage;

		$sql = new Sql();

		$results = $sql->select("
			SELECT SQL_CALC_FOUND_ROWS *
			FROM tb_usuarios a INNER JOIN  tb_documentos b ON b.id_usuario = a.id_usuario
			WHERE  a.nome_documento LIKE OR a.dt_documento LIKE :search 
			ORDER BY a.dt_documento DESC
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


	//METODO PARA ENVIAR O AQRUIVO

	public function moveArquivo()
	{

		$file = isset($_FILES['arquivo_documento']) ? $_FILES['arquivo_documento'] : FALSE;



		//loop para ler os arquivos
		for ($cont = 0; $cont < count($file['name']); $cont++) {


			$directory = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR .
				"res" . DIRECTORY_SEPARATOR .
				"arquivos_documentos" . DIRECTORY_SEPARATOR .

				$file['name'][$cont];

			$arquivo_documento = $file['name'][$cont];



			$sql = new Sql();
			$sql->select(
				"CALL sp_arquivo_documento_add(:id_documento,:id_usuario, :arquivo_documento)",
				array(
					":id_documento" => $this->getid_documento(),
					":id_usuario" => $this->getid_usuario(),
					":arquivo_documento" => $arquivo_documento
				)
			);


			move_uploaded_file($file['tmp_name'][$cont], $directory);

		}



	}

	//METODO PARA VERIFICAR O TOTAL DE ARQUIVO DE CADA DOCUMENTO
	public static function numArquivosDocumentos($id_documento)
	{

		$sql = new Sql();
		$total = $sql->select("SELECT SQL_CALC_FOUND_ROWS *
			FROM  tb_arquivos_documentos WHERE id_documento = :id_documento", [
			':id_documento' => $id_documento
		]);
		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");

		return ['arquivos' => (int) $resultTotal[0]["nrtotal"]];
	}


	public static function nomeArquivos($id_documento)
	{

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_arquivos_documentos WHERE id_documento = :id_documento", [
			':id_documento' => $id_documento
		]);

		return ['nome' => $results[0]["arquivo_rollout"]];

	}

	//METODO PARA LISTAR OS ARQUIVOS
	public function showArquivo($id_documento)
	{
		$sql = new Sql();


		$resultsExistFile = $sql->select("SELECT * FROM tb_arquivos_documentos a
		INNER JOIN tb_usuarios b ON a.id_usuario = b.id_usuario
		WHERE id_documento = :id_documento ", [
			':id_documento' => $id_documento
		]);

		$countResultsFile = count($resultsExistFile);
		if ($countResultsFile > 0) {
			foreach ($resultsExistFile as &$result) {
				foreach ($result as $key => $value) {
					if ($key === "arquivo_documento") {
						$result["arquivo"] = '/res/arquivos_documentos/' . $result['arquivo_documento'];
					}
				}
			}



			return $resultsExistFile;
		}


	}



}
<?php

namespace Projeto\Model;

use \Projeto\DB\Sql;
use \Projeto\Model;

//Classe unidade(marcações, com seus métodos específicos)
class Unidade extends Model
{



	public function getUnidadesID($id_usuario)
	{

		$sql = new Sql();

		return $sql->select("
			SELECT * FROM tb_usuarios a INNER JOIN tb_unidades b ON a.id_usuario = b.id_usuario WHERE b.id_usuario = :id_usuario ORDER BY b.data_registro DESC
		", [

			':id_usuario' => $id_usuario
		]);

	}


	//Método estático que verifica o array de dados
	public static function checkList($list)
	{

		foreach ($list as &$row) {

			$p = new Unidade();
			$p->setData($row);
			$row = $p->getValues();

		}

		return $list;

	}



	public static function totalUnidadeID($id_usuario)
	{

		$sql = new Sql();
		$total = $sql->select("SELECT SQL_CALC_FOUND_ROWS *
			FROM tb_unidades WHERE id_usuario = :id_usuario", [
			':id_usuario' => $id_usuario
		]);
		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");


		return ['unidadesTotalID' => (int) $resultTotal[0]["nrtotal"]];
	}


	//Método estático para a verificação do total de fotos de cada unidade
	public static function numFotos($id_unidade)
	{

		$sql = new Sql();
		$total = $sql->select("SELECT SQL_CALC_FOUND_ROWS *
			FROM  tb_unidades_fotos WHERE id_unidade = :id_unidade", [
			':id_unidade' => $id_unidade
		]);
		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");

		return ['fotos' => (int) $resultTotal[0]["nrtotal"]];
	}

	public static function totalUnidades()
	{

		$sql = new Sql();
		$total = $sql->select("SELECT SQL_CALC_FOUND_ROWS *
			FROM tb_unidades");
		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");


		return ['unidadesTotal' => (int) $resultTotal[0]["nrtotal"]];
	}


	//Método que busca os dados do procedimento e salva no tabela de marcações
	public function salvarUnidade()
	{

		$sql = new Sql();

		$results = $sql->select(
			"CALL sp_cadastro_unidade(:id_usuario,:nome,:sigla,:localidade,:telefone,:unidade)",
			array(
				":id_usuario" => $this->getid_usuario(),
				":nome" => $this->getnome(),
				":sigla" => $this->getsigla(),
				":localidade" => $this->getlocalidade(),
				":telefone" => $this->gettelefone(),
				":unidade" => $this->getunidade(),
			)
		);

		$this->setData($results[0]);

		Unidade::movePhotos();
		Unidade::salvarLocalizacao();

	}


	//METODO PARA ALTERAÇÃO DAS INFORMAÇÕES DAS UNIDADES
	public function alterarUnidades()
	{

		$sql = new Sql();

		$results = $sql->select("CALL sp_edita_unidades(:id_unidade,:id_usuario,:nome,:sigla,:codigo,:diretor,:vice_diretor,
			:chefe_secretaria,:localidade,:telefone,:etapa,:qtd_turmas,
			:turnos,:educacao_integral,:tel_diretor,:tel_vice,:tel_chefe_secretaria
			)",
			array(
				":id_unidade" => $this->getid_unidade(),
				":id_usuario" => $this->getid_usuario(),
				":nome" => $this->getnome(),
				":sigla" => $this->getsigla(),
				":codigo" => $this->getcodigo(),
				":diretor" => $this->getdiretor(),
				":vice_diretor" => $this->getvice_diretor(),
				"chefe_secretaria" => $this->getchefe_secretaria(),
				":localidade" => $this->getlocalidade(),
				":telefone" => $this->gettelefone(),
				":etapa" => $this->getetapa(),
				":qtd_turmas" => $this->getqtd_turmas(),
				":turnos" => $this->getturnos(),
				":educacao_integral" => $this->geteducacao_integral(),
				":tel_diretor" => $this->gettel_diretor(),
				":tel_vice" => $this->gettel_vice(),
				":tel_chefe_secretaria" => $this->gettel_chefe_secretaria()

			)
		);


		$this->setData($results[0]);

		$this->incluirSupervisores();
		$this->incluirCoordenadores();

	}

	//METODO PARA ALTERAÇÃO DAS INFORMAÇÕES DAS UNIDADES
	public function alterarUnidadeAdministrativa()
	{

		$sql = new Sql();

		$results = $sql->select("CALL sp_edita_unidades_administrativas(:id_unidade,:id_usuario,:nome,:sigla,:codigo,
			:coordenador,:unigep,:uniae,:uniag,:unieb,:uniplat)",
			array(
				":id_unidade" => $this->getid_unidade(),
				":id_usuario" => $this->getid_usuario(),
				":nome" => $this->getnome(),
				":sigla" => $this->getsigla(),
				":codigo" => $this->getcodigo(),
				":coordenador" => $this->getcoordenador(),
				":unigep" => $this->getunigep(),
				":uniae" => $this->getuniae(),
				":uniag" => $this->getuniag(),
				"unieb" => $this->getunieb(),
				":uniplat" => $this->getuniplat()
			)
		);

		$this->setData($results[0]);


	}

	//METODO PARA INCLUIR OS TELEFONES DOS SUPERVISORES
	public function salvarAlterarContatoSupervisor()
	{

		$telefone = isset($_POST['telefone_supervisor']) ? $_POST['telefone_supervisor'] : FALSE;

		$sql = new Sql();

		$sql->query("UPDATE tb_supervisores    
							SET telefone_supervisor = :telefone
						    WHERE id_supervisor = :id_supervisor ", [
			":id_supervisor" => $this->getid_supervisor(),
			":telefone" => $telefone,


		]);




	}

	//METODO PARA INCLUIR OS TELEFONES DOS COORDENADORES PEDAGÓGICOS
	public function salvarAlterarContatoCoordenador()
	{

		$telefone = isset($_POST['telefone_coordenador']) ? $_POST['telefone_coordenador'] : FALSE;

		$sql = new Sql();

		$sql->query("UPDATE tb_coordenadores    
							SET telefone_coordenador = :telefone
						    WHERE id_coordenador = :id_coordenador ", [
			":id_coordenador" => $this->getid_coordenador(),
			":telefone" => $telefone,


		]);




	}

	public function salvarLocalizacao()
	{


		$sql = new Sql();

		$results = $sql->select(
			"CALL sp_localidade_unidade_add(:id_unidade,:id_usuario,:lng,:lat)",
			array(
				":id_unidade" => $this->getid_unidade(),
				":id_usuario" => $this->getid_usuario(),
				":lng" => $this->getlng(),
				":lat" => $this->getlat()
			)
		);

		$this->setData($results[0]);

	}

	public static function getUnidadesEscolares()
	{

		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_unidades
			WHERE unidade = 'Unidade Escolar'
			ORDER BY codigo ASC"
		);

	}

	public static function getUnidades()
	{

		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_unidades
			ORDER BY nome ASC"
		);

	}

	public function alterarLocalizacao()
	{


		$sql = new Sql();

		$results = $sql->select(
			"CALL sp_alterar_localizacao(:id_localidade,:id_usuario,:lng,:lat)",
			array(
				":id_localidade" => $this->getid_localidade(),
				":id_usuario" => $this->getid_usuario(),
				":lng" => $this->getlng(),
				":lat" => $this->getlat()
			)
		);

		$this->setData($results[0]);

	}

	public static function listAllUnidadesEscolares()
	{

		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_localidades a 
			INNER JOIN  tb_unidades b ON b.id_unidade = a.id_unidade
			WHERE b.unidade = 'Unidade Escolar'"
		);

	}

	public static function listAllUnidadesAdministrativas()
	{

		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_localidades a 
			INNER JOIN  tb_unidades b ON b.id_unidade = a.id_unidade
			WHERE b.unidade = 'Unidade Administrativa (CRE)'"
		);

	}


	//Método que seleciona todas marcações passando a ID por parâmetro
	public function get($id_unidade)
	{


		if (numFotos($id_unidade) == 0) {
			$sql = new Sql();

			$results = $sql->select("SELECT * FROM tb_unidades a
			INNER JOIN tb_localidades b ON a.id_unidade = b.id_unidade
			INNER JOIN tb_usuarios c ON a.id_usuario = c.id_usuario	
			WHERE a.id_unidade = :id_unidade", [
				':id_unidade' => $id_unidade
			]);


			$this->setData($results[0]);

		} else {
			$sql = new Sql();

			$results = $sql->select("SELECT * FROM tb_unidades a
			INNER JOIN tb_localidades b ON a.id_unidade = b.id_unidade
			INNER JOIN tb_usuarios c ON a.id_usuario = c.id_usuario
			INNER JOIN tb_unidades_fotos d ON a.id_unidade = d.id_unidade
			WHERE a.id_unidade = :id_unidade", [
				':id_unidade' => $id_unidade
			]);


			$this->setData($results[0]);


		}
	}



	public function getFoto($id_foto)
	{

		$sql = new Sql();

		$results = $sql->select("SELECT  * FROM  tb_unidades_fotos
	     	WHERE id_foto = :id_foto", [
			':id_foto' => $id_foto
		]);

		$this->setData($results[0]);



	}




	public static function nomeFotos($id_unidade)
	{

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_unidades_fotos WHERE id_unidade = :id_unidade", [
			':id_unidade' => $id_unidade
		]);

		return ['nome' => $results[0]["nome_foto"]];

	}


     //METODO PARA ARMAZENAR HISTÓRCO DOS DOCUMENTOS INCLUIDOS 
	public function historico_unidades($nome_user){

		$sql = new Sql();

			$results = $sql->select("CALL sp_registro_historico(:usuario,:informacao)",
			array(
				":usuario" => $nome_user,
				":informacao" => 'Código da Unidade: '.$this->getcodigo().' | Nome: '.$this->getnome().
								 ' | Sigla: '.$this->getsigla().' | localidade: '.$this->getlocalidade()
			)
		);

		$this->setData($results[0]);

	}


	//Método para deletar uma unidade
	public function delete()
	{

		$sql = new Sql();

		$sql->query("DELETE FROM tb_unidades WHERE id_unidade = :id_unidade", [
			':id_unidade' => $this->getid_unidade()
		]);

	}

	//METODO PARA DELETAR UM ARQUIVO
	public function deleteFoto()
	{

		$sql = new Sql();

		$sql->query("DELETE FROM tb_unidades_fotos WHERE id_foto = :id_foto", [
			':id_foto' => $this->getid_foto()
		]);


		$img = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR .
			"res" . DIRECTORY_SEPARATOR .
			"ft_unidade" . DIRECTORY_SEPARATOR .
			$this->getnome_foto();
		unlink($img);

	}



	//Método para pegar os valores do array
	public function getValues()
	{


		$values = parent::getValues();

		return $values;

	}

	//Método para verificar e mover as fotos para  a pasta de destino e seu nome para o banco de dados
	public function movePhotos()
	{

		$file = isset($_FILES['nome_foto']) ? $_FILES['nome_foto'] : FALSE;



		//loop para ler as imagens
		for ($cont = 0; $cont < count($file['name']); $cont++) {


			$directory = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR .
				"res" . DIRECTORY_SEPARATOR .
				"ft_unidade" . DIRECTORY_SEPARATOR .

				$file['name'][$cont];

			$namePhoto = $file['name'][$cont];



			$sql = new Sql();
			$sql->select(
				"CALL sp_image_unidade_add(:id_unidade,:id_usuario,:nome_foto)",
				array(
					":id_unidade" => $this->getid_unidade(),
					":id_usuario" => $this->getid_usuario(),
					":nome_foto" => $namePhoto
				)
			);

			move_uploaded_file($file['tmp_name'][$cont], $directory);

		}


	}

	//Método para listar as imagens referentes a cada marcação
	public function showPhotos($id_unidade)
	{
		$sql = new Sql();


		$resultsExistPhoto = $sql->select("SELECT * FROM tb_unidades_fotos WHERE id_unidade = :id_unidade ", [
			':id_unidade' => $id_unidade
		]);

		$countResultsPhoto = count($resultsExistPhoto);
		if ($countResultsPhoto > 0) {
			foreach ($resultsExistPhoto as &$result) {
				foreach ($result as $key => $value) {
					if ($key === "nome_foto") {
						$result["desphoto"] = '/res/ft_unidade/' . $result['nome_foto'];
					}
				}
			}



			return $resultsExistPhoto;
		}
	}

	//Método para listar todos as fotos de cada marcação e passar pro parâmetro a ID
	public function getPhotos($id_foto)
	{

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_unidade_fotos WHERE id_foto = :id_foto", [
			':id_foto' => $id_foto
		]);

	}


	//PAGINAÇÃO DA PÁGINA TABELAS COM LOCAIS
	public static function getPage($page = 1, $itemsPerPage = 10)
	{

		$start = ($page - 1) * $itemsPerPage;

		$sql = new Sql();

		$results = $sql->select("
			SELECT SQL_CALC_FOUND_ROWS *
			FROM  tb_unidades 
			ORDER BY codigo ASC
		
			LIMIT $start, $itemsPerPage");

		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");

		return [
			'data' => $results,
			'total' => (int) $resultTotal[0]["nrtotal"],
			'pages' => ceil($resultTotal[0]["nrtotal"] / $itemsPerPage)
		];

	}


	//BUSCA DA PÁGINA TABELAS COM LOCAIS

	public static function getPageSearch($search, $page = 1, $itemsPerPage = 10)
	{

		$start = ($page - 1) * $itemsPerPage;

		$sql = new Sql();

		$results = $sql->select("
			SELECT SQL_CALC_FOUND_ROWS *
			FROM tb_unidades 
			WHERE nome LIKE :search OR localidade LIKE :search OR etapa LIKE :search 
			OR sigla LIKE :search  OR codigo LIKE :search 
			ORDER BY codigo ASC
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


	//METODO PARA INCLUIR OS SUPERVISORES
	public function incluirSupervisores()
	{

		$var = isset($_POST['supervisor']) ? $_POST['supervisor'] : FALSE;

		for ($cont = 0; $cont < count($var); $cont++) {

			$var[$cont];

			$supervisor = $var[$cont];


			if ($supervisor != "") {

				$sql = new Sql();
				$sql->select(
					"CALL sp_cadastro_supervisores(:id_unidade,:supervisor)",
					array(
						":id_unidade" => $this->getid_unidade(),
						":supervisor" => $supervisor
					)
				);
			}
		}

	}

	//METODO PARA INCLUIR OS COORDENADORES
	public function incluirCoordenadores()
	{

		$var = isset($_POST['coordenador_pedagogico']) ? $_POST['coordenador_pedagogico'] : FALSE;

		for ($cont = 0; $cont < count($var); $cont++) {

			$var[$cont];

			$coordenador_pedagogico = $var[$cont];

			if ($coordenador_pedagogico != "") {

				$sql = new Sql();
				$sql->select(
					"CALL sp_cadastro_coordenadores(:id_unidade,:coordenador_pedagogico)",
					array(
						":id_unidade" => $this->getid_unidade(),
						":coordenador_pedagogico" => $coordenador_pedagogico
					)
				);
			}
		}

	}

	public function getSupervisores($id_unidade)
	{

		$sql = new Sql();
		$results = $sql->select("SELECT * FROM tb_supervisores a 
		INNER JOIN tb_unidades b USING(id_unidade) 
		WHERE a.id_unidade = :id_unidade", [
			':id_unidade' => $id_unidade
		]);

		return ['data' => $results];

	}


	public function getSupervisor($id_supervisor)
	{

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_supervisores
	     WHERE id_supervisor = :id_supervisor", [
			':id_supervisor' => $id_supervisor
		]);

		$this->setData($results[0]);

	}


	public function getCoordenadores($id_unidade)
	{

		$sql = new Sql();
		$results = $sql->select("SELECT * FROM tb_coordenadores a 
		INNER JOIN tb_unidades b USING(id_unidade) 
		WHERE a.id_unidade = :id_unidade", [
			':id_unidade' => $id_unidade
		]);

		return ['data' => $results];

	}


	public function getcoordenadorPedagogico($id_coordenador)
	{

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_coordenadores
	     WHERE id_coordenador = :id_coordenador", [
			':id_coordenador' => $id_coordenador
		]);

		$this->setData($results[0]);

	}

	//METODO PARA DELETAR UM SUPERVISOR
	public function deleteSupervisor($id_supervisor)
	{

		$sql = new Sql();

		$sql->query("DELETE FROM tb_supervisores WHERE id_supervisor = :id_supervisor", [
			':id_supervisor' => $id_supervisor
		]);


	}

	//METODO PARA DELETAR UM COORDENADOR
	public function deleteCoordenador($id_coordenador)
	{

		$sql = new Sql();

		$sql->query("DELETE FROM tb_coordenadores WHERE id_coordenador = :id_coordenador", [
			':id_coordenador' => $id_coordenador
		]);


	}


	public static function totalInfantil()
	{

		$sql = new Sql();
		$total = $sql->select("SELECT COUNT(id_unidade) as Total
			FROM tb_unidades WHERE etapa = 'Educação Infantil'");

		return ['totalInfantil' => (int) $total[0]["Total"]];
	}

	public static function totalInfantilFundamental()
	{

		$sql = new Sql();
		$total = $sql->select("SELECT COUNT(id_unidade) as Total
			FROM tb_unidades WHERE etapa = 'Educação Infantil  e Ensino Fundamental'");

		return ['totalInfantilFundamental' => (int) $total[0]["Total"]];
	}

	public static function totalFundamental()
	{

		$sql = new Sql();
		$total = $sql->select("SELECT COUNT(id_unidade) as Total
			FROM tb_unidades WHERE etapa = 'Ensino Fundamental'");

		return ['totalFundamental' => (int) $total[0]["Total"]];
	}

	public static function totalFundamentalMedio()
	{

		$sql = new Sql();
		$total = $sql->select("SELECT COUNT(id_unidade) as Total
			FROM tb_unidades WHERE etapa = 'Ensino Fundamental e Ensino Médio'");

		return ['totalFundamentalMedio' => (int) $total[0]["Total"]];
	}

	public static function totalMedio()
	{

		$sql = new Sql();
		$total = $sql->select("SELECT COUNT(id_unidade) as Total
			FROM tb_unidades WHERE etapa = 'Ensino Médio'");

		return ['totalMedio' => (int) $total[0]["Total"]];
	}

	public static function totalDiretores()
	{

		$sql = new Sql();
		$total = $sql->select("SELECT COUNT(diretor) as Total
			FROM tb_unidades
			WHERE unidade = 'Unidade Escolar' AND diretor != ''");

		return ['totalDiretores' => (int) $total[0]["Total"]];
	}

	public static function totalViceDiretores()
	{

		$sql = new Sql();
		$total = $sql->select("SELECT COUNT(vice_diretor) as Total
			FROM tb_unidades
			WHERE unidade = 'Unidade Escolar' AND vice_diretor != ''");

		return ['totalViceDiretores' => (int) $total[0]["Total"]];
	}


	public static function totalSupervisores()
	{

		$sql = new Sql();
		$total = $sql->select("SELECT COUNT(id_supervisor) as Total
			FROM tb_supervisores ");

		return ['totalSupervisores' => (int) $total[0]["Total"]];
	}

	public static function totalCoordenadores()
	{

		$sql = new Sql();
		$total = $sql->select("SELECT COUNT(id_coordenador) as Total
			FROM tb_coordenadores ");

		return ['totalCoordenadores' => (int) $total[0]["Total"]];
	}

	public static function totalChefeSecretaria()
	{

		$sql = new Sql();
		$total = $sql->select("SELECT COUNT(chefe_secretaria) as Total
			FROM tb_unidades 
			WHERE unidade = 'Unidade Escolar' AND chefe_secretaria != ''");

		return ['totalChefeSecretaria' => (int) $total[0]["Total"]];
	}



	public static function getUnidadesGrafico()
	{

		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_unidades
		WHERE unidade = 'Unidade Escolar'
		ORDER BY qtd_turmas DESC");

	}

	public static function getUnidadesEducacaoInfantil()
	{

		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_unidades
		WHERE unidade = 'Unidade Escolar' AND etapa = 'Educação Infantil'
		ORDER BY sigla DESC");

	}

	public static function getUnidadesInfantilFundamental()
	{

		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_unidades
		WHERE unidade = 'Unidade Escolar' AND etapa = 'Educação Infantil  e Ensino Fundamental'
		ORDER BY sigla DESC");

	}

	public static function getUnidadesFundamental()
	{

		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_unidades
		WHERE unidade = 'Unidade Escolar' AND etapa = 'Ensino Fundamental'
		ORDER BY sigla DESC");

	}

	public static function getUnidadesFundamentalMedio()
	{

		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_unidades
		WHERE unidade = 'Unidade Escolar' AND etapa = 'Ensino Fundamental e Ensino Médio'
		ORDER BY sigla DESC");

	}

	public static function getUnidadesMedio()
	{

		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_unidades
		WHERE unidade = 'Unidade Escolar' AND etapa = 'Ensino Médio'
		ORDER BY sigla DESC");

	}

	public static function getDiretores()
	{

		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_unidades
		WHERE unidade = 'Unidade Escolar'AND diretor !=''
		ORDER BY sigla DESC");

	}

	public static function getViceDiretores()
	{

		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_unidades
		WHERE unidade = 'Unidade Escolar'AND vice_diretor !=''
		ORDER BY sigla DESC");

	}

	public static function getListaSupervisores()
	{

		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_supervisores a
	    INNER JOIN tb_unidades b ON a.id_unidade = b.id_unidade
		ORDER BY sigla DESC");

	}

	public static function getChefeSecretaria()
	{

		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_unidades
		WHERE unidade = 'Unidade Escolar'AND vice_diretor !=''
		ORDER BY sigla DESC");

	}

	public static function getListaCoordenadoresPedagogicos()
	{

		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_coordenadores a
	    INNER JOIN tb_unidades b ON a.id_unidade = b.id_unidade
		ORDER BY sigla DESC");

	}











}
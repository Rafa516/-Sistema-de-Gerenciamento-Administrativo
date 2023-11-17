<?php

namespace Projeto\Model;

use \Projeto\DB\Sql;
use \Projeto\Model;


//Classe Pagamento(Pagamento, com seus métodos específicos)
class Pagamento extends Model
{

	//MÉTODO ESTÁTICO QUE VERIFICA O ARRAY DE DADOS

	public static function checkList($list)
	{

		foreach ($list as &$row) {

			$p = new Pagamento();
			$p->setData($row);
			$row = $p->getValues();

		}

		return $list;

	}


	//METODO QUE VERIFICA O TOTAL  DE PAGAMENTOS REGISTRADOS
	public static function totalPagamentos()
	{

		$sql = new Sql();
		$total = $sql->select("SELECT COUNT(id_pagamento) as Total
			FROM tb_pagamentos");

		return ['dossiersTotal' => (int) $total[0]["Total"]];
	}



	//METODO PARA REGISTRO DOS PAGAMENTOS
	public function registrarPagamentos()
	{

		$sql = new Sql();

		$results = $sql->select("CALL sp_registro_pagamentos(:id_temporario,:id_grade,:id_horas_pagas,:id_usuario,:cod_carencia,:data_inicial,:data_final,:dias,
		:dias_pagos,:horas_pagas,:valor_horas_pagas,:vencimento_pag,:gaped,:gaa,:gazr,:gaee,:soma,:um_doze_avos
		)",
			array(
				":id_temporario" => $this->getid_temporario(),
				":id_grade" => $this->getid_grade(),
				":id_horas_pagas" => $this->getid_horas_pagas(),
				":id_usuario" => $this->getid_usuario(),
				":cod_carencia" => $this->getcod_carencia(),
				":data_inicial" => $this->getdata_inicial(),
				":data_final" => $this->getdata_final(),
				":dias" => $this->getdias(),
				":dias_pagos" => $this->getdias_pagos(),
				":horas_pagas" => $this->gethoras_pagas(),
				":valor_horas_pagas" => $this->getvalor_horas_pagas(),
				":vencimento_pag" => $this->getvencimento_pag(),
				":gaped" => $this->getgaped(),
				":gaa" => $this->getgaa(),
				":gazr" => $this->getgazr(),
				":gaee" => $this->getgaee(),
				":soma" => $this->getsoma(),
				":um_doze_avos" => $this->getum_doze_avos(),
			)
		);

		$this->setData($results[0]);



	}

	//METODO PARA REGISTRO DOS PAGAMETOS
	public function editarPagamentos()
	{

		$sql = new Sql();

		$results = $sql->select("CALL sp_edtitar_pagamentos(:id_pagamento,:id_temporario,:id_grade,:id_horas_pagas,:id_usuario,:cod_carencia,:data_inicial,:data_final,:dias,
		:dias_pagos,:horas_pagas,:valor_horas_pagas,:vencimento_pag,:gaped,:gaa,:gazr,:gaee,:soma,:um_doze_avos
		)",
			array(
				":id_pagamento" => $this->getid_pagamento(),
				":id_temporario" => $this->getid_temporario(),
				":id_grade" => $this->getid_grade(),
				":id_horas_pagas" => $this->getid_horas_pagas(),
				":id_usuario" => $this->getid_usuario(),
				":cod_carencia" => $this->getcod_carencia(),
				":data_inicial" => $this->getdata_inicial(),
				":data_final" => $this->getdata_final(),
				":dias" => $this->getdias(),
				":dias_pagos" => $this->getdias_pagos(),
				":horas_pagas" => $this->gethoras_pagas(),
				":valor_horas_pagas" => $this->getvalor_horas_pagas(),
				":vencimento_pag" => $this->getvencimento_pag(),
				":gaped" => $this->getgaped(),
				":gaa" => $this->getgaa(),
				":gazr" => $this->getgazr(),
				":gaee" => $this->getgaee(),
				":soma" => $this->getsoma(),
				":um_doze_avos" => $this->getum_doze_avos(),
			)
		);

		$this->setData($results[0]);
	}



	//METODO PARA INCLUIR OBSERVAÇÃO DO PAGAMENTO
	public function incluirObservacoes()
	{

		$sql = new Sql();

		$results = $sql->select("CALL sp_incluir_observacoes(:id_pagamento,:id_usuario,:observacoes
		)",
			array(
				":id_pagamento" => $this->getid_pagamento(),
				":id_usuario" => $this->getid_usuario(),
				":observacoes" => $this->getobservacoes(),

			)
		);

		$this->setData($results[0]);



	}


	//METODO PARA REGISTRO DOS DOCUMENTOS
	public function registrarGrades()
	{

		$sql = new Sql();

		$results = $sql->select("CALL sp_registro_grades(:nome_progressao,:valor,:hora_padrao
		)",
			array(
				":nome_progressao" => $this->getnome_progressao(),
				":valor" => $this->getvalor() + 4,
				":hora_padrao" => 9.6
			)
		);

		$this->setData($results[0]);



	}


	//METODO GET POR ID   
	public function get($id_pagamento)
	{

		$sql = new Sql();

		$results = $sql->select("SELECT  * FROM  tb_pagamentos a 
	     	INNER JOIN  tb_temporarios b ON a.id_temporario = b.id_temporario
			INNER JOIN tb_grades c ON c.id_grade = a.id_grade
			INNER JOIN tb_horas_pagas d ON d.id_horas_pagas = a.id_horas_pagas
			INNER JOIN tb_usuarios e ON e.id_usuario = a.id_usuario
	     	WHERE id_pagamento = :id_pagamento", [
			':id_pagamento' => $id_pagamento
		]);

		$this->setData($results[0]);



	}


	//METODO GET POR ID   
	public function getGrade($id_grade)
	{

		$sql = new Sql();

		$results = $sql->select("SELECT  * FROM  tb_grades 
	     	WHERE id_grade = :id_grade", [
			':id_grade' => $id_grade
		]);

		$this->setData($results[0]);



	}


	public function deleteGrade()
	{

		$sql = new Sql();

		$sql->query("DELETE FROM tb_grades WHERE id_grade = :id_grade", [
			':id_grade' => $this->getid_grade()
		]);

	}



	//METODO PARA DELETAR UM PAGAMENTO
	public function deletePagamento()
	{

		$sql = new Sql();

		$sql->query("DELETE FROM tb_pagamentos WHERE id_pagamento = :id_pagamento", [
			':id_pagamento' => $this->getid_pagamento()
		]);


	}


	//METODO PARA PEGAR OS VALORES DO ARRAY DE DADOS
	public function getValues()
	{


		$values = parent::getValues();

		return $values;

	}


	//PAGINAÇÃO DA PÁGINA TODOS PAGAMENTOS
	public static function getPagePagamentoTemporario($page = 1, $itemsPerPage = 25)
	{

		$start = ($page - 1) * $itemsPerPage;

		$sql = new Sql();

		$results = $sql->select("
			SELECT SQL_CALC_FOUND_ROWS *
		    FROM tb_temporarios a 
			INNER JOIN  tb_pagamentos b ON b.id_temporario = a.id_temporario
			INNER JOIN tb_horas_pagas c ON c.id_horas_pagas = b.id_horas_pagas
		    ORDER BY c.id_horas_pagas 
			LIMIT $start, $itemsPerPage");


		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");

		return [
			'data' => $results,
			'total' => (int) $resultTotal[0]["nrtotal"],
			'pages' => ceil($resultTotal[0]["nrtotal"] / $itemsPerPage)
		];

	}

	//BUSCA DA PÁGINA TODOS PAGAMENTOS

	public static function getPageSearchPagamentoTemporario($search, $page = 1, $itemsPerPage = 25)
	{

		$start = ($page - 1) * $itemsPerPage;

		$sql = new Sql();

		$results = $sql->select("
			SELECT SQL_CALC_FOUND_ROWS *
			 FROM tb_temporarios a 
			 INNER JOIN  tb_pagamentos b ON b.id_temporario = a.id_temporario
			 INNER JOIN tb_horas_pagas c ON c.id_horas_pagas = b.id_horas_pagas	
			WHERE a.nome LIKE :search OR b.cod_carencia LIKE :search  OR a.matricula LIKE :search OR a.cpf LIKE :search	
			OR c.mes LIKE :search
			ORDER BY c.id_horas_pagas ASC
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





	//BUSCAR GRADES CADASTRADAS 
	public static function getGradesCadastradas()
	{

		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_grades
		 ORDER BY valor ASC");

	}


}
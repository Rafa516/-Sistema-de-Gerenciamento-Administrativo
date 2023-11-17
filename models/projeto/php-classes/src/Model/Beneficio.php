<?php

namespace Projeto\Model;

use \Projeto\DB\Sql;
use \Projeto\Model;


//Classe Beneficio(Beneficio, com seus métodos específicos)
class Beneficio extends Model
{

	//MÉTODO ESTÁTICO QUE VERIFICA O ARRAY DE DADOS

	public static function checkList($list)
	{

		foreach ($list as &$row) {

			$p = new Beneficio();
			$p->setData($row);
			$row = $p->getValues();

		}

		return $list;

	}




	//METODO PARA REGISTRO DOS BENEFICIOS
	public function registrarBeneficios()
	{

		$sql = new Sql();

		$results = $sql->select("CALL sp_registro_beneficios(:beneficio,:id_temporario,:id_usuario,:inicio,:fim,
			:processo,:carencia,:data_processo,:mes,:ano,:situacao,:exercicio,:observacoes
		)",
			array(
				":beneficio" => $this->getbeneficio(),
				":id_temporario" => $this->getid_temporario(),
				":id_usuario" => $this->getid_usuario(),
				":inicio" => $this->getinicio(),
				":fim" => $this->getfim(),
				":processo" => $this->getprocesso(),
				":carencia" => $this->getcarencia(),
				":data_processo" => $this->getdata_processo(),
				":mes" => $this->getmes(),
				":ano" => $this->getano(),
				":situacao" => $this->getsituacao(),
				":exercicio" => $this->getexercicio(),
				":observacoes" => $this->getobservacoes()
			)
		);

		$this->setData($results[0]);

	}



	//METODO PARA EDIÇÃO DOS BENEFICIOS
	public function editarBeneficios()
	{

		$sql = new Sql();

		$results = $sql->select("CALL sp_edita_beneficio(:id_beneficio,:beneficio,:id_temporario,:id_usuario,:inicio,:fim,
		:processo,:carencia,:data_processo,:mes,:ano,:situacao,:exercicio,:observacoes
	)",
			array(
				":id_beneficio" => $this->getid_beneficio(),
				":beneficio" => $this->getbeneficio(),
				":id_temporario" => $this->getid_temporario(),
				":id_usuario" => $this->getid_usuario(),
				":inicio" => $this->getinicio(),
				":fim" => $this->getfim(),
				":processo" => $this->getprocesso(),
				":carencia" => $this->getcarencia(),
				":data_processo" => $this->getdata_processo(),
				":mes" => $this->getmes(),
				":ano" => $this->getano(),
				":situacao" => $this->getsituacao(),
				":exercicio" => $this->getexercicio(),
				":observacoes" => $this->getobservacoes()
			)
		);

		$this->setData($results[0]);


	}

	//METODO PARA REGISTRO DOS DADOS DOOOOO TRANSPORTE EFETIVO
	public function registrarTransporteEfetivo()
	{

		$sql = new Sql();

		$results = $sql->select("CALL sp_registro_transporte_efetivos(:id_efetivo,:id_itinerarios,:id_usuario,:beneficio,:processo,
			:data_processo,:situacao,:mes,:ano,:referencia
		)",
			array(
				":id_efetivo" => $this->getid_efetivo(),
				":id_itinerarios" => $this->getid_itinerarios(),
				":id_usuario" => $this->getid_usuario(),
				":beneficio" => $this->getbeneficio(),
				":processo" => $this->getprocesso(),
				":data_processo" => $this->getdata_processo(),
				":situacao" => $this->getsituacao(),
				":mes" => $this->getmes(),
				":ano" => $this->getano(),
				":referencia" => $this->getreferencia(),
			)
		);

		$this->setData($results[0]);

	}

	//METODO PARA ALTERAR DADOS DO TRANSPORTE EFETIVO
	public function alterarTransporteEfetivo()
	{

		$sql = new Sql();

		$results = $sql->select("CALL sp_alterar_transporte_efetivos(:id_beneficio_efetivo,:id_efetivo,:id_itinerarios,:id_usuario,:beneficio,:processo,
			:data_processo,:situacao,:mes,:ano,:referencia
		)",
			array(
				":id_beneficio_efetivo" => $this->getid_beneficio_efetivo(),
				":id_efetivo" => $this->getid_efetivo(),
				":id_itinerarios" => $this->getid_itinerarios(),
				":id_usuario" => $this->getid_usuario(),
				":beneficio" => $this->getbeneficio(),
				":processo" => $this->getprocesso(),
				":data_processo" => $this->getdata_processo(),
				":situacao" => $this->getsituacao(),
				":mes" => $this->getmes(),
				":ano" => $this->getano(),
				":referencia" => $this->getreferencia()


			)
		);

		$this->setData($results[0]);



	}
	//METODO PARA REGISTRO DO REPAG EFETIVO
	public function registrarRepagEfetivo()
	{

		$sql = new Sql();

		$results = $sql->select("CALL sp_registro_repag_efetivos(:id_beneficio_efetivo,:jus,:valor_recebido,:custeio,:receber,:devolver,:dias,
		:vencimento,:frequencia,:ano_frequencia
		)",
			array(
				":id_beneficio_efetivo" => $this->getid_beneficio_efetivo(),
				":jus" => $this->getjus(),
				":valor_recebido" => $this->getvalor_recebido(),
				":custeio" => $this->getcusteio(),
				":receber" => $this->getreceber(),
				":devolver" => $this->getdevolver(),
				":dias" => $this->getdias(),
				":vencimento" => $this->getvencimento(),
				":frequencia" => $this->getfrequencia(),
				":ano_frequencia" => $this->getano_frequencia()

			)
		);

		$total_receber = $sql->select("SELECT SUM(b.receber) as Total FROM tb_beneficios_efetivos a 
				INNER JOIN tb_repag_efetivos b USING(id_beneficio_efetivo) 
				WHERE a.id_beneficio_efetivo = :id_beneficio_efetivo ", [
			':id_beneficio_efetivo' => $this->getid_beneficio_efetivo()
		]);

		$total_devolver = $sql->select("SELECT SUM(b.devolver) as Total FROM tb_beneficios_efetivos a 
				INNER JOIN tb_repag_efetivos b USING(id_beneficio_efetivo) 
				WHERE a.id_beneficio_efetivo = :id_beneficio_efetivo ", [
			':id_beneficio_efetivo' => $this->getid_beneficio_efetivo()
		]);

		$valor_receber = (double) $total_receber[0]["Total"];
		$valor_devolver = (double) $total_devolver[0]["Total"];

		$sql->query("UPDATE tb_beneficios_efetivos a  
							INNER JOIN tb_repag_efetivos b
						    ON a.id_beneficio_efetivo = b.id_beneficio_efetivo
							SET a.total_transporte = $valor_receber , a.total_devolver = $valor_devolver
						    WHERE b.id_beneficio_efetivo = :id_beneficio_efetivo", [
			":id_beneficio_efetivo" => $this->getid_beneficio_efetivo(),


		]);

		$this->setData($results[0]);

	}

	//METODO PARA REGISTRO DO REPAG TEMPORARIO
	public function registrarRepagTemporario()
	{

		$sql = new Sql();

		$results = $sql->select("CALL sp_registro_repag_temporario(:id_beneficio,:id_itinerarios,:jus,:valor_recebido,:custeio,:receber,
		:devolver,:dias,:vencimento,:frequencia,:ano_frequencia
		)",
			array(
				":id_beneficio" => $this->getid_beneficio(),
				":id_itinerarios" => $this->getid_itinerarios(),
				":jus" => $this->getjus(),
				":valor_recebido" => $this->getvalor_recebido(),
				":custeio" => $this->getcusteio(),
				":receber" => $this->getreceber(),
				":devolver" => $this->getdevolver(),
				":dias" => $this->getdias(),
				":vencimento" => $this->getvencimento(),
				":frequencia" => $this->getfrequencia(),
				":ano_frequencia" => $this->getano_frequencia()

			)
		);

		$total_receber = $sql->select("SELECT SUM(b.receber) as Total FROM tb_beneficios a 
				INNER JOIN tb_repag_temporarios b USING(id_beneficio) 
				WHERE a.id_beneficio = :id_beneficio ", [
			':id_beneficio' => $this->getid_beneficio()
		]);

		$total_devolver = $sql->select("SELECT SUM(b.devolver) as Total FROM tb_beneficios a 
				INNER JOIN tb_repag_temporarios b USING(id_beneficio) 
				WHERE a.id_beneficio = :id_beneficio ", [
			':id_beneficio' => $this->getid_beneficio()
		]);

		$valor_receber = (double) $total_receber[0]["Total"];
		$valor_devolver = (double) $total_devolver[0]["Total"];

		$sql->query("UPDATE tb_beneficios a  
							INNER JOIN tb_repag_temporarios b
						    ON a.id_beneficio = b.id_beneficio
							SET a.total_transporte = $valor_receber , a.total_devolver = $valor_devolver
						    WHERE b.id_beneficio = :id_beneficio", [
			":id_beneficio" => $this->getid_beneficio(),


		]);

		$this->setData($results[0]);

	}

	//METODO PARA ALTERAR DO REPAG EFETIVO
	public function alterarRepagEfetivo()
	{

		$sql = new Sql();

		$results = $sql->select("CALL sp_alterar_repag_efetivos(:id_repag_efetivo,:id_beneficio_efetivo,:jus,:valor_recebido,:custeio,:receber,
		:devolver,:dias,:vencimento,:frequencia,:ano_frequencia
		)",
			array(
				":id_repag_efetivo" => $this->getid_repag_efetivo(),
				":id_beneficio_efetivo" => $this->getid_beneficio_efetivo(),
				":jus" => $this->getjus(),
				":valor_recebido" => $this->getvalor_recebido(),
				":custeio" => $this->getcusteio(),
				":receber" => $this->getreceber(),
				":devolver" => $this->getdevolver(),
				":dias" => $this->getdias(),
				":vencimento" => $this->getvencimento(),
				":frequencia" => $this->getfrequencia(),
				":ano_frequencia" => $this->getano_frequencia()

			)
		);

		$total_receber = $sql->select("SELECT SUM(b.receber) as Total FROM tb_beneficios_efetivos a 
				INNER JOIN tb_repag_efetivos b USING(id_beneficio_efetivo) 
				WHERE a.id_beneficio_efetivo = :id_beneficio_efetivo ", [
			':id_beneficio_efetivo' => $this->getid_beneficio_efetivo()
		]);

		$total_devolver = $sql->select("SELECT SUM(b.devolver) as Total FROM tb_beneficios_efetivos a 
				INNER JOIN tb_repag_efetivos b USING(id_beneficio_efetivo) 
				WHERE a.id_beneficio_efetivo = :id_beneficio_efetivo ", [
			':id_beneficio_efetivo' => $this->getid_beneficio_efetivo()
		]);

		$valor_receber = (double) $total_receber[0]["Total"];
		$valor_devolver = (double) $total_devolver[0]["Total"];

		$sql->query("UPDATE tb_beneficios_efetivos a  
							INNER JOIN tb_repag_efetivos b
						    ON a.id_beneficio_efetivo = b.id_beneficio_efetivo
							SET a.total_transporte = $valor_receber , a.total_devolver = $valor_devolver
						    WHERE b.id_beneficio_efetivo = :id_beneficio_efetivo", [
			":id_beneficio_efetivo" => $this->getid_beneficio_efetivo(),


		]);

		$this->setData($results[0]);

	}


	//METODO PARA ALTERAR DO REPAG TEMPORARIO
	public function alterarRepagTemporario()
	{

		$sql = new Sql();

		$results = $sql->select("CALL sp_alterar_repag_temporario(:id_repag_temporario,:id_beneficio,:id_itinerarios,:jus,:valor_recebido,
		:custeio,:receber,:devolver,:dias,:vencimento,:frequencia,:ano_frequencia
		)",
			array(
				":id_repag_temporario" => $this->getid_repag_temporario(),
				":id_beneficio" => $this->getid_beneficio(),
				":id_itinerarios" => $this->getid_itinerarios(),
				":jus" => $this->getjus(),
				":valor_recebido" => $this->getvalor_recebido(),
				":custeio" => $this->getcusteio(),
				":receber" => $this->getreceber(),
				":devolver" => $this->getdevolver(),
				":dias" => $this->getdias(),
				":vencimento" => $this->getvencimento(),
				":frequencia" => $this->getfrequencia(),
				":ano_frequencia" => $this->getano_frequencia()

			)
		);

		$total_receber = $sql->select("SELECT SUM(b.receber) as Total FROM tb_beneficios a 
				INNER JOIN tb_repag_temporarios b USING(id_beneficio) 
				WHERE a.id_beneficio = :id_beneficio ", [
			':id_beneficio' => $this->getid_beneficio()
		]);

		$total_devolver = $sql->select("SELECT SUM(b.devolver) as Total FROM tb_beneficios a 
				INNER JOIN tb_repag_temporarios b USING(id_beneficio) 
				WHERE a.id_beneficio = :id_beneficio ", [
			':id_beneficio' => $this->getid_beneficio()
		]);

		$valor_receber = (double) $total_receber[0]["Total"];
		$valor_devolver = (double) $total_devolver[0]["Total"];

		$sql->query("UPDATE tb_beneficios a  
							INNER JOIN tb_repag_temporarios b
						    ON a.id_beneficio = b.id_beneficio
							SET a.total_transporte = $valor_receber , a.total_devolver = $valor_devolver
						    WHERE b.id_beneficio = :id_beneficio", [
			":id_beneficio" => $this->getid_beneficio(),


		]);

		$this->setData($results[0]);

	}






	//METODO PARA INCLUIR OBSERVAÇÃO DO TRANSPORTE EFETIVOS
	public function incluirObservacoes()
	{

		$sql = new Sql();

		$results = $sql->select("CALL sp_incluir_observacoes_transporte_efetivo(:id_beneficio_efetivo,:id_usuario,:obs_transporte_efetivo
		)",
			array(
				":id_beneficio_efetivo" => $this->getid_beneficio_efetivo(),
				":id_usuario" => $this->getid_usuario(),
				":obs_transporte_efetivo" => $this->getobs_transporte_efetivo(),

			)
		);

		$this->setData($results[0]);



	}

	public function getRepagEfetivoIncluido($id_beneficio_efetivo)
	{

		$sql = new Sql();
		$results = $sql->select("SELECT * FROM tb_repag_efetivos a 
		INNER JOIN tb_beneficios_efetivos b ON a.id_beneficio_efetivo = b.id_beneficio_efetivo
		INNER JOIN tb_itinerarios c ON b.id_itinerarios = c.id_itinerarios
		INNER JOIN tb_efetivos d ON d.id_efetivo = b.id_efetivo
		WHERE a.id_beneficio_efetivo = :id_beneficio_efetivo 
		ORDER BY a.frequencia ASC", [
			':id_beneficio_efetivo' => $id_beneficio_efetivo
		]);

		return ['data' => $results];

	}

	public function getRepagTemporarioIncluido($id_beneficio)
	{

		$sql = new Sql();
		$results = $sql->select("SELECT * FROM tb_repag_temporarios a 
		INNER JOIN tb_beneficios b ON a.id_beneficio = b.id_beneficio
		INNER JOIN tb_itinerarios c ON a.id_itinerarios = c.id_itinerarios
		INNER JOIN tb_temporarios d ON d.id_temporario = b.id_temporario
		WHERE a.id_beneficio = :id_beneficio 
		ORDER BY a.frequencia ASC", [
			':id_beneficio' => $id_beneficio
		]);

		return ['data' => $results];

	}

	//METODO GET POR ID   
	public function get($id_beneficio)
	{

		$sql = new Sql();

		$results = $sql->select("SELECT  * FROM  tb_beneficios a
          INNER JOIN tb_temporarios b ON a.id_temporario = b.id_temporario
		  INNER JOIN tb_usuarios c ON a.id_usuario = c.id_usuario
		  WHERE a.id_beneficio = :id_beneficio", [
			':id_beneficio' => $id_beneficio
		]);

		$this->setData($results[0]);



	}

	//METODO GET POR ID   
	public function getRepag($id_repag_efetivo)
	{

		$sql = new Sql();

		$results = $sql->select("SELECT  * FROM  tb_repag_efetivos a
          INNER JOIN tb_beneficios_efetivos b ON a.id_beneficio_efetivo = b.id_beneficio_efetivo
		  INNER JOIN tb_itinerarios c ON c.id_itinerarios =  b.id_itinerarios
		  INNER JOIN tb_efetivos d ON d.id_efetivo = b.id_efetivo
	     WHERE a.id_repag_efetivo = :id_repag_efetivo", [
			':id_repag_efetivo' => $id_repag_efetivo
		]);

		$this->setData($results[0]);


	}

	public function getRepagTemporario($id_repag_temporario)
	{

		$sql = new Sql();

		$results = $sql->select("SELECT  * FROM  tb_repag_temporarios a
          INNER JOIN tb_beneficios b ON a.id_beneficio = b.id_beneficio
		  INNER JOIN tb_itinerarios c ON c.id_itinerarios =  a.id_itinerarios
		  INNER JOIN tb_temporarios d ON d.id_temporario = b.id_temporario
	     WHERE a.id_repag_temporario = :id_repag_temporario", [
			':id_repag_temporario' => $id_repag_temporario
		]);

		$this->setData($results[0]);


	}

	public static function numRepags($id_beneficio_efetivo)
	{

		$sql = new Sql();
		$total = $sql->select("SELECT SQL_CALC_FOUND_ROWS *
			FROM  tb_repag_efetivos WHERE id_beneficio_efetivo = :id_beneficio_efetivo", [
			':id_beneficio_efetivo' => $id_beneficio_efetivo
		]);
		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");

		return ['repags' => (int) $resultTotal[0]["nrtotal"]];
	}

	public static function numRepagsTemporarios($id_beneficio)
	{

		$sql = new Sql();
		$total = $sql->select("SELECT SQL_CALC_FOUND_ROWS *
			FROM  tb_repag_temporarios WHERE id_beneficio = :id_beneficio", [
			':id_beneficio' => $id_beneficio
		]);
		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");

		return ['repags' => (int) $resultTotal[0]["nrtotal"]];
	}

	public function getTransporteEfetivo($id_beneficio_efetivo)
	{


		if (numRepags($id_beneficio_efetivo) == 0) {
			$sql = new Sql();

			$results = $sql->select("SELECT  * FROM  tb_beneficios_efetivos a
			INNER JOIN tb_efetivos b ON a.id_efetivo = b.id_efetivo
			INNER JOIN tb_unidades c ON b.id_unidade = c.id_unidade
			INNER JOIN tb_itinerarios d ON a.id_itinerarios = d.id_itinerarios
			INNER JOIN tb_usuarios e ON a.id_usuario = e.id_usuario
			WHERE a.id_beneficio_efetivo = :id_beneficio_efetivo", [
				':id_beneficio_efetivo' => $id_beneficio_efetivo
			]);

			$this->setData($results[0]);
		} else {
			$sql = new Sql();

			$results = $sql->select("SELECT  * FROM  tb_beneficios_efetivos a
          INNER JOIN tb_efetivos b ON a.id_efetivo = b.id_efetivo
		  INNER JOIN tb_unidades c ON b.id_unidade = c.id_unidade
		  INNER JOIN tb_itinerarios d ON a.id_itinerarios = d.id_itinerarios
		  INNER JOIN tb_usuarios e ON a.id_usuario = e.id_usuario
		  INNER JOIN tb_repag_efetivos f ON a.id_beneficio_efetivo = f.id_beneficio_efetivo
		  WHERE a.id_beneficio_efetivo = :id_beneficio_efetivo", [
				':id_beneficio_efetivo' => $id_beneficio_efetivo
			]);

			$this->setData($results[0]);
		}



	}
	//DELETAR REPAG EFETIVO
	public function deleteRepag()
	{

		$sql = new Sql();

		$sql->query("DELETE FROM tb_repag_efetivos  WHERE id_repag_efetivo = :id_repag_efetivo", [
			':id_repag_efetivo' => $this->getid_repag_efetivo()
		]);

		$total_receber = $sql->select("SELECT SUM(b.receber) as Total FROM tb_beneficios_efetivos a 
				INNER JOIN tb_repag_efetivos b USING(id_beneficio_efetivo) 
				WHERE a.id_beneficio_efetivo = :id_beneficio_efetivo ", [
			':id_beneficio_efetivo' => $this->getid_beneficio_efetivo()
		]);

		$total_devolver = $sql->select("SELECT SUM(b.devolver) as Total FROM tb_beneficios_efetivos a 
				INNER JOIN tb_repag_efetivos b USING(id_beneficio_efetivo) 
				WHERE a.id_beneficio_efetivo = :id_beneficio_efetivo ", [
			':id_beneficio_efetivo' => $this->getid_beneficio_efetivo()
		]);


		$valor_receber = (double) $total_receber[0]["Total"];
		$valor_devolver = (double) $total_devolver[0]["Total"];

		if ($valor_receber > 0) {

			$sql->query("UPDATE tb_beneficios_efetivos a  
							INNER JOIN tb_repag_efetivos b
						    ON a.id_beneficio_efetivo = b.id_beneficio_efetivo
							SET a.total_transporte = $valor_receber
						    WHERE b.id_beneficio_efetivo = :id_beneficio_efetivo", [
				":id_beneficio_efetivo" => $this->getid_beneficio_efetivo(),


			]);
		} else {
			$sql->query("UPDATE tb_beneficios_efetivos  
								SET total_transporte =  0
								WHERE id_beneficio_efetivo = :id_beneficio_efetivo", [
				":id_beneficio_efetivo" => $this->getid_beneficio_efetivo(),


			]);

		}

		if ($valor_devolver > 0) {

			$sql->query("UPDATE tb_beneficios_efetivos a  
							INNER JOIN tb_repag_efetivos b
						    ON a.id_beneficio_efetivo = b.id_beneficio_efetivo
							SET a.total_devolver = $valor_devolver
						    WHERE b.id_beneficio_efetivo = :id_beneficio_efetivo", [
				":id_beneficio_efetivo" => $this->getid_beneficio_efetivo(),


			]);
		} else {
			$sql->query("UPDATE tb_beneficios_efetivos  
								SET total_devolver =  0
								WHERE id_beneficio_efetivo = :id_beneficio_efetivo", [
				":id_beneficio_efetivo" => $this->getid_beneficio_efetivo(),


			]);

		}



	}

	//DELETAR REPAG EFETIVO
	public function deleteRepagTemporario()
	{

		$sql = new Sql();

		$sql->query("DELETE FROM tb_repag_temporarios  WHERE id_repag_temporario = :id_repag_temporario", [
			':id_repag_temporario' => $this->getid_repag_temporario()
		]);

		$total_receber = $sql->select("SELECT SUM(b.receber) as Total FROM tb_beneficios a 
				INNER JOIN tb_repag_temporarios b USING(id_beneficio) 
				WHERE a.id_beneficio = :id_beneficio ", [
			':id_beneficio' => $this->getid_beneficio()
		]);

		$total_devolver = $sql->select("SELECT SUM(b.devolver) as Total FROM tb_beneficios a 
				INNER JOIN tb_repag_temporarios b USING(id_beneficio) 
				WHERE a.id_beneficio = :id_beneficio ", [
			':id_beneficio' => $this->getid_beneficio()
		]);


		$valor_receber = (double) $total_receber[0]["Total"];
		$valor_devolver = (double) $total_devolver[0]["Total"];

		if ($valor_receber > 0) {

			$sql->query("UPDATE tb_beneficios a  
							INNER JOIN tb_repag_temporarios b
						    ON a.id_beneficio = b.id_beneficio
							SET a.total_transporte = $valor_receber
						    WHERE b.id_beneficio = :id_beneficio", [
				":id_beneficio" => $this->getid_beneficio(),


			]);
		} else {
			$sql->query("UPDATE tb_beneficios
								SET total_transporte =  0
								WHERE id_beneficio = :id_beneficio", [
				":id_beneficio" => $this->getid_beneficio(),


			]);

		}

		if ($valor_devolver > 0) {

			$sql->query("UPDATE tb_beneficios a  
							INNER JOIN tb_repag_temporarios b
						    ON a.id_beneficio = b.id_beneficio
							SET a.total_devolver = $valor_devolver
						    WHERE b.id_beneficio = :id_beneficio", [
				":id_beneficio" => $this->getid_beneficio(),


			]);
		} else {
			$sql->query("UPDATE tb_beneficios  
								SET total_devolver =  0
								WHERE id_beneficio = :id_beneficio", [
				":id_beneficio" => $this->getid_beneficio(),


			]);

		}



	}
	//METODO PARA ARMAZENAR HISTÓRCO DE EXCLUSÃO DOS BENEFICIOS  
	public function historico_beneficio($nome_user)
	{

		$sql = new Sql();


		if ($this->getreferencia() == "Efetivos") {

			$results = $sql->select(
				"CALL sp_registro_historico(:usuario,:informacao)",
				array(
					":usuario" => $nome_user,
					":informacao" => 'Beneficio Efetivo: ' . $this->getbeneficio() . ' | Nome: ' . $this->getnome_servidor() . ' | Matrícula: ' .
						$this->getmatricula() . ' | Folha: ' . $this->getmes() . '|' . $this->getano().
						' | Processo: ' . $this->getprocesso() . ' | Data Processo: ' . $this->getdata_processo() .' | situacao: ' . 
						$this->getsituacao() .' | Observação: ' .  $this->getobs_transporte_efetivo()
				)
			);

			$this->setData($results[0]);

		} elseif ($this->getreferencia() == "Vigilantes") {

			$results = $sql->select(
				"CALL sp_registro_historico(:usuario,:informacao)",
				array(
					":usuario" => $nome_user,
					":informacao" => 'Beneficio Vigilantes: ' . $this->getbeneficio() . ' | Nome: ' . $this->getnome_servidor() . ' | Matrícula: ' .
						$this->getmatricula() . ' | Folha: ' . $this->getmes() . '|' . $this->getano().
						' | Processo: ' . $this->getprocesso() . ' | Data Processo: ' . $this->getdata_processo() .' | situacao: ' . 
						$this->getsituacao() .' | Observação: ' .  $this->getobs_transporte_efetivo()
				)
			);

			$this->setData($results[0]);

		} else {

			$results = $sql->select(
				"CALL sp_registro_historico(:usuario,:informacao)",
				array(
					":usuario" => $nome_user,
					":informacao" => 'Beneficio: ' . $this->getbeneficio() . ' | Nome: ' . $this->getnome() . ' | Matrícula: ' .
						$this->getmatricula(). ' | CPF: ' . $this->getcpf() . ' | Folha: ' . $this->getmes() . '|' . $this->getano().
						' | Data início: ' . $this->getinicio().' | Data fim: ' . $this->getfim() . ' | Processo: ' . $this->getprocesso() . 
						' | Data Processo: ' . $this->getdata_processo() .' | situacao: ' . $this->getsituacao() .' | carencia: ' . $this->getcarencia() .' | exercicio: ' . $this->getexercicio() .
						' | Observação: ' . $this->getobservacoes() 
				)
			);

			$this->setData($results[0]);
		}





	}
 //METODO PARA ARMAZENAR HISTÓRCO DE EXCLUSÃO  DOS REPAGS DOS TEMPORARIOS  
	public function historico_repag($nome_user)
	{

		$sql = new Sql();


			$results = $sql->select(
				"CALL sp_registro_historico(:usuario,:informacao)",
				array(
					":usuario" => $nome_user,
					":informacao" => 'REPAG TEMPORARRIOS | Jus: R$ ' . $this->getjus() .' | Valor recebido: R$ ' . $this->getvalor_recebido() .' | Custeio: R$ ' . $this->getcusteio() .
									 ' | Receber: R$ ' . $this->getreceber() .' | Dias: ' . $this->getdias().' | Vencimento: R$ ' . $this->getvencimento(). 
									 ' | Frequência: ' . $this->getfrequencia(). ' | Ano ' . $this->getano().' | Beneficio: '. $this->getbeneficio() . 
									 ' | Nome: ' . $this->getnome() . ' | Matrícula: '.$this->getmatricula() . ' | Folha: ' . $this->getmes() . '/' . $this->getano()
				)
			);

			$this->setData($results[0]);

	}

	//METODO PARA ARMAZENAR HISTÓRCO DE EXCLUSÃO  DOS REPAGS DOS EFETIVOS 
	public function historico_repag_efetivos($nome_user)
	{

		$sql = new Sql();

		if ($this->getreferencia() == "Efetivos") {

			$results = $sql->select(
				"CALL sp_registro_historico(:usuario,:informacao)",
				array(
					":usuario" => $nome_user,
					":informacao" => 'REPAG EFETIVOS | Jus: R$ ' . $this->getjus() .' | Valor recebido: R$ ' . $this->getvalor_recebido() .' | Custeio: R$ ' . $this->getcusteio() .
									 ' | Receber: R$ ' . $this->getreceber() .' | Dias: ' . $this->getdias().' | Vencimento: R$ ' . $this->getvencimento(). 
									 ' | Frequência: ' . $this->getfrequencia(). ' | Ano ' . $this->getano().' | Beneficio: '. $this->getbeneficio() . 
									 ' | Nome: ' . $this->getnome_servidor() . ' | Matrícula: '.$this->getmatricula() . ' | Folha: ' . $this->getmes() . '/' . $this->getano()
				)
			);

			$this->setData($results[0]);

		} else {

			
			$results = $sql->select(
				"CALL sp_registro_historico(:usuario,:informacao)",
				array(
					":usuario" => $nome_user,
					":informacao" => 'REPAG VIGILANTES | Jus: R$ ' . $this->getjus() .' | Valor recebido: R$ ' . $this->getvalor_recebido() .' | Custeio: R$ ' . $this->getcusteio() .
									 ' | Receber: R$ ' . $this->getreceber() .' | Dias: ' . $this->getdias().' | Vencimento: R$ ' . $this->getvencimento(). 
									 ' | Frequência: ' . $this->getfrequencia(). ' | Ano ' . $this->getano().' | Beneficio: '. $this->getbeneficio() . 
									 ' | Nome: ' . $this->getnome_servidor() . ' | Matrícula: '.$this->getmatricula() . ' | Folha: ' . $this->getmes() . '/' . $this->getano()
				)
			);

			$this->setData($results[0]);

		}
	}

	//METODO PARA DELETAR UM BENEFICIO
	public function delete()
	{

		$sql = new Sql();

		$sql->query("DELETE FROM tb_beneficios WHERE id_beneficio = :id_beneficio", [
			':id_beneficio' => $this->getid_beneficio()
		]);

		$this->historico();


	}


	//METODO PARA DELETAR UM TRANSPORTE DO EFETIVO
	public function deleteTransporteEfetivo()
	{

		$sql = new Sql();

		$sql->query("DELETE FROM tb_beneficios_efetivos WHERE id_beneficio_efetivo = :id_beneficio_efetivo", [
			':id_beneficio_efetivo' => $this->getid_beneficio_efetivo()
		]);

	}




	//METODO PARA PEGAR OS VALORES DO ARRAY DE DADOS
	public function getValues()
	{

		$values = parent::getValues();

		return $values;

	}


	//PAGINAÇÃO DA PÁGINA TODOS BENEFICIOS ALIMENTAÇÃO
	public static function getPageAlimentacao($page = 1, $itemsPerPage = 25)
	{

		$start = ($page - 1) * $itemsPerPage;

		$sql = new Sql();

		$results = $sql->select("
			SELECT SQL_CALC_FOUND_ROWS *
		    FROM  tb_beneficios a
			INNER JOIN tb_temporarios b ON a.id_temporario = b.id_temporario
		    WHERE beneficio = 'Auxílio Alimentação'
		    ORDER BY a.mes DESC
			LIMIT $start, $itemsPerPage");


		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");

		return [
			'data' => $results,
			'total' => (int) $resultTotal[0]["nrtotal"],
			'pages' => ceil($resultTotal[0]["nrtotal"] / $itemsPerPage)
		];

	}

	//BUSCA DA PÁGINA TODOS DOCUMENTOS

	public static function getPageSearchAlimentacao($search, $page = 1, $itemsPerPage = 25)
	{

		$start = ($page - 1) * $itemsPerPage;

		$sql = new Sql();

		$results = $sql->select("
			SELECT SQL_CALC_FOUND_ROWS *
			 FROM  tb_beneficios a
			INNER JOIN tb_temporarios b ON a.id_temporario = b.id_temporario
			WHERE beneficio = 'Auxílio Alimentação' AND (b.nome LIKE :search OR b.matricula LIKE :search OR
			b.cpf LIKE :search OR a.ano LIKE :search OR
			a.situacao LIKE :search  OR a.mes LIKE :search OR a.carencia LIKE :search 
			OR a.exercicio LIKE :search)
		   ORDER BY a.mes DESC
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

	//PAGINAÇÃO DA PÁGINA TODOS BENEFICIOS transporte
	public static function getPageTransporte($page = 1, $itemsPerPage = 25)
	{

		$start = ($page - 1) * $itemsPerPage;

		$sql = new Sql();

		$results = $sql->select("
			SELECT SQL_CALC_FOUND_ROWS *
			FROM  tb_beneficios a
			INNER JOIN tb_temporarios b ON a.id_temporario = b.id_temporario
		    WHERE beneficio = 'Auxílio Transporte'
		    ORDER BY a.mes DESC
			LIMIT $start, $itemsPerPage");


		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");

		return [
			'data' => $results,
			'total' => (int) $resultTotal[0]["nrtotal"],
			'pages' => ceil($resultTotal[0]["nrtotal"] / $itemsPerPage)
		];

	}

	//BUSCA DA PÁGINA TODOS BENEFICIOS AUXILIO TRANSPORTE

	public static function getPageSearchTransporte($search, $page = 1, $itemsPerPage = 25)
	{

		$start = ($page - 1) * $itemsPerPage;

		$sql = new Sql();

		$results = $sql->select("
			SELECT SQL_CALC_FOUND_ROWS *
		    FROM  tb_beneficios a
			INNER JOIN tb_temporarios b ON a.id_temporario = b.id_temporario
			WHERE beneficio = 'Auxílio Transporte' AND (b.nome LIKE :search OR b.matricula LIKE :search OR
			b.cpf LIKE :search OR a.ano LIKE :search OR
			a.situacao LIKE :search  OR a.mes LIKE :search OR a.carencia LIKE :search 
			OR a.exercicio LIKE :search)
			ORDER BY a.mes DESC
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



	//PAGINAÇÃO DA PÁGINA TODOS BENEFICIOS TRANSPORTE EFETIVOS
	public static function getPageTransporteEfetivos($page = 1, $itemsPerPage = 25)
	{

		$start = ($page - 1) * $itemsPerPage;

		$sql = new Sql();

		$results = $sql->select("
			SELECT SQL_CALC_FOUND_ROWS *
			FROM  tb_beneficios_efetivos a
			INNER JOIN tb_efetivos b ON a.id_efetivo = b.id_efetivo
			INNER JOIN tb_unidades c ON b.id_unidade = c.id_unidade
		    WHERE a.beneficio = 'Auxílio Transporte' AND a.referencia = 'Efetivos'
		    ORDER BY a.mes DESC
			LIMIT $start, $itemsPerPage");


		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");

		return [
			'data' => $results,
			'total' => (int) $resultTotal[0]["nrtotal"],
			'pages' => ceil($resultTotal[0]["nrtotal"] / $itemsPerPage)
		];

	}

	//BUSCA DA PÁGINA TODOS BENEFICIOS AUXILIO TRANSPORTE VIGILANTES

	public static function getPageSearchTransporteEfetivos($search, $page = 1, $itemsPerPage = 25)
	{

		$start = ($page - 1) * $itemsPerPage;

		$sql = new Sql();

		$results = $sql->select("
			SELECT SQL_CALC_FOUND_ROWS *
		    FROM  tb_beneficios_efetivos a
			INNER JOIN tb_efetivos b ON a.id_efetivo = b.id_efetivo
			INNER JOIN tb_unidades c ON b.id_unidade = c.id_unidade
		    WHERE a.beneficio = 'Auxílio Transporte' AND a.referencia = 'Efetivos' AND (b.nome_servidor LIKE :search OR b.matricula LIKE :search OR
			c.nome LIKE :search OR a.ano LIKE :search OR
			a.situacao LIKE :search  OR a.mes LIKE :search OR c.sigla LIKE :search 
			OR b.carreira LIKE :search)
			ORDER BY a.mes DESC
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

	//PAGINAÇÃO DA PÁGINA TODOS BENEFICIOS TRANSPORTE EFETIVOS
	public static function getPageTransporteVigilantes($page = 1, $itemsPerPage = 25)
	{

		$start = ($page - 1) * $itemsPerPage;

		$sql = new Sql();

		$results = $sql->select("
			SELECT SQL_CALC_FOUND_ROWS *
			FROM  tb_beneficios_efetivos a
			INNER JOIN tb_efetivos b ON a.id_efetivo = b.id_efetivo
			INNER JOIN tb_unidades c ON b.id_unidade = c.id_unidade
		    WHERE a.beneficio = 'Auxílio Transporte' AND a.referencia = 'Vigilantes'
		    ORDER BY a.mes DESC
			LIMIT $start, $itemsPerPage");


		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");

		return [
			'data' => $results,
			'total' => (int) $resultTotal[0]["nrtotal"],
			'pages' => ceil($resultTotal[0]["nrtotal"] / $itemsPerPage)
		];

	}

	//BUSCA DA PÁGINA TODOS BENEFICIOS AUXILIO TRANSPORTE VIGILANTES

	public static function getPageSearchTransporteVigilantes($search, $page = 1, $itemsPerPage = 25)
	{

		$start = ($page - 1) * $itemsPerPage;

		$sql = new Sql();

		$results = $sql->select("
			SELECT SQL_CALC_FOUND_ROWS *
		    FROM  tb_beneficios_efetivos a
			INNER JOIN tb_efetivos b ON a.id_efetivo = b.id_efetivo
			INNER JOIN tb_unidades c ON b.id_unidade = c.id_unidade
		    WHERE a.beneficio = 'Auxílio Transporte' AND a.referencia = 'Vigilantes' AND (b.nome_servidor LIKE :search OR b.matricula LIKE :search OR
			c.nome LIKE :search OR a.ano LIKE :search OR
			a.situacao LIKE :search  OR a.mes LIKE :search OR c.sigla LIKE :search 
			OR b.carreira LIKE :search)
			ORDER BY a.mes DESC
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
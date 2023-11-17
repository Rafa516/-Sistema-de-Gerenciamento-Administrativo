<?php

namespace Projeto\Model;

use \Projeto\DB\Sql;
use \Projeto\Model;


//Classe HorasPagas(HorasPagas, com seus métodos específicos)
class HorasPagas extends Model
{

	//MÉTODO ESTÁTICO QUE VERIFICA O ARRAY DE DADOS

	public static function checkList($list)
	{

		foreach ($list as &$row) {

			$p = new HorasPagas();
			$p->setData($row);
			$row = $p->getValues();

		}

		return $list;

	}

	public function getValues()
	{


		$values = parent::getValues();

		return $values;

	}



	//METODO PARA ALTERAÇÃO DAS HORAS PAGAS
	public function editarHorasPagas()
	{

		$sql = new Sql();

		$results = $sql->select("CALL sp_edita_horas_pagas(:id_horas_pagas,:valor_horas,:vencimento,:referencia1,:referencia2
			)",
			array(
				":id_horas_pagas" => $this->getid_horas_pagas(),
				":valor_horas" => $this->getvencimento() / $this->getreferencia1(),
				":vencimento" => $this->getvencimento(),
				":referencia1" => $this->getreferencia1(),
				":referencia2" => $this->getreferencia1() / 9.6,
			)
		);


		$this->setData($results[0]);


	}

	public function get($id_horas_pagas)
	{

		$sql = new Sql();

		$results = $sql->select("SELECT  * FROM   tb_horas_pagas WHERE id_horas_pagas = :id_horas_pagas", [
			':id_horas_pagas' => $id_horas_pagas
		]);

		$this->setData($results[0]);

	}
	//BUSCAR VALORAS DAS HORAS PAGAS CADASTRADAS
	public static function getHorasPagasCadastradas()
	{

		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_horas_pagas
		 ORDER BY id_horas_pagas ASC");

	}






}
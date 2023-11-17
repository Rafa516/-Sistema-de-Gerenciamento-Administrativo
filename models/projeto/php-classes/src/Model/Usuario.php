<?php

namespace Projeto\Model;


use \Projeto\Model;
use \Projeto\DB\Sql;
use \Projeto\Mailer;

//Classe Usuario(Usuários, com seus métodos específicos)
class Usuario extends Model
{

	const SESSION = "Usuario";
	const ERROR = "UsuarioError";
	const ERROR_REGISTER = "UsuarioErrorRegister";
	const SUCCESS = "UsuarioSucesss";
	const SECRET = "Php7_Secret";
	const SECRET_IV = "Php7_Secret_IV";


	//Método estático para verificação e validação do usuário comum e do administrador
	public static function login($login, $senha)
	{

		$sql = new Sql();

		$results = $sql->select(
			"SELECT * FROM tb_usuarios  WHERE login = :login",
			array(
				":login" => $login
			)
		);

		if (count($results) === 0) {
			throw new \Exception("Falha na sua tentativa de login.Conta não cadastrada");
		}


		$data = $results[0];


		if (password_verify($senha, $data['senha']) === true) {

			$Usuario = new Usuario();

			$data['nome_user'] = utf8_encode($data['nome_user']);

			$Usuario->setData($data);


			$_SESSION[Usuario::SESSION] = $Usuario->getValues();

			return $Usuario;

		} else {

			throw new \Exception("Falha na sua tentativa de login. Senha inválida");



		}

	}





	//Método estático para verificar se o email do usuário já existe
	public static function checkEmailExist($email)
	{

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_usuarios WHERE email = :email", [
			':email' => $email
		]);

		return (count($results) > 0);

	}

	//Método estático para verificar se o login do usuário já existe
	public static function checkLoginExist($login)
	{

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_usuarios WHERE login = :login", [
			':login' => $login
		]);

		return (count($results) > 0);

	}


	//Método estático para encerrar a sessão do usuário (logout)
	public static function logout()
	{

		$_SESSION[Usuario::SESSION] = NULL;

	}

	//Método estático para criptografar as senhas registradas dos usuários
	public static function getPasswordHash($senha)
	{

		return password_hash($senha, PASSWORD_DEFAULT, [
			'cost' => 12
		]);

	}

	//Método estático para pegar a sessão dos usuários
	public static function getFromSession()
	{

		$Usuario = new Usuario();

		if (isset($_SESSION[Usuario::SESSION]) && (int) $_SESSION[Usuario::SESSION]['id_usuario'] > 0) {

			$Usuario->setData($_SESSION[Usuario::SESSION]);

		}

		return $Usuario;

	}

	//Método estático para verificar a autenticidade do usuário comum, e verificar se ele esta com a sessão iniciada ou não.
	public static function verificaLogin($inadmin = true)
	{

		if (
			(bool) $_SESSION[Usuario::SESSION]["id_usuario"] !== $inadmin
			||
			(int) $_SESSION[Usuario::SESSION]["inadmin"] !== 0
		) {

			header("Location: /");
			exit;

		}

	}

	//Método estático para verificar a autenticidade do usuário Administrador, e verificar se ele esta com a sessão iniciada ou não.
	public static function verificaLoginAdmin($inadmin = true)
	{

		if (

			(bool) $_SESSION[Usuario::SESSION]["id_usuario"] !== $inadmin
			||
			(int) $_SESSION[Usuario::SESSION]["inadmin"] !== 1
		) {

			header("Location: /admin/login");
			exit;

		}

	}


	//Método para selecionar todos os usuários e passar a ID como parâmetro
	public function get($id_usuario)
	{

		$sql = new Sql();

		$results = $sql->select(
			"SELECT * FROM tb_usuarios  WHERE id_usuario = :id_usuario",
			array(
				":id_usuario" => $id_usuario
			)
		);


		$this->setData($results[0]);

	}

	//Método para salvar os dados do procedimento de registro do usuário comum.
	public function cadastroUsuario()
	{

		$sql = new Sql();

		$results = $sql->select(
			"CALL sp_cadastro_usuario(:nome_user,:login,:senha,:email,:inadmin,:foto)",
			array(
				":nome_user" => $this->getnome_user(),
				":login" => $this->getlogin(),
				":senha" => Usuario::getPasswordHash($this->getsenha()),
				":email" => $this->getemail(),
				":inadmin" => $this->getinadmin(),
				":foto" => $this->getfoto()

			)
		);

		$this->setData($results[0]);

	}

	//Método para editar os dados do procedimento  do usuário comum.
	public function editarUsuario()
	{

		$sql = new Sql();

		$results = $sql->select(
			"CALL sp_editar_usuario(:id_usuario,:nome_user,:inadmin)",
			array(
				":id_usuario" => $this->getid_usuario(),
				":nome_user" => $this->getnome_user(),
				":inadmin" => $this->getinadmin()
			)
		);

		$this->setData($results[0]);

	}

	public function editarSenha()
	{

		$sql = new Sql();

		$results = $sql->select(
			"CALL sp_editar_senha(:id_usuario,:senha)",
			array(
				":id_usuario" => $this->getid_usuario(),
				":senha" => Usuario::getPasswordHash($this->getsenha()),
			)
		);

		$this->setData($results[0]);

	}


	//Método para editar a imagem do perfil
	public function alterarImagemPerfil()
	{
		$sql = new Sql();

		$results = $sql->select('CALL sp_alterar_imagem_perfil(:id_usuario,:foto)', [
			":id_usuario" => $this->getid_usuario(),
			":foto" => Usuario::getImage($this->getfoto())
			,
		]);

		if ($this->getfoto() != 0) {

			$img = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR .
				"res" . DIRECTORY_SEPARATOR .
				"ft_perfil" . DIRECTORY_SEPARATOR .
				$this->getfoto();
			unlink($img);

		} else {
			$img = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR .
				"res" . DIRECTORY_SEPARATOR .
				"ft_perfil" . DIRECTORY_SEPARATOR .
				$this->getfoto();
			$img;


		}

	}

	//Método estático para nome_userar e mover a imagem para a pasta de destino 
	public static function getImage($value)
	{
		$name_file = date('Ymdhms');

		$directory = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR .
			"res" . DIRECTORY_SEPARATOR .
			"ft_perfil" . DIRECTORY_SEPARATOR .
			$name_file;

		$foto = isset($_FILES['foto']) ? $_FILES['foto'] : FALSE;

		if (!$foto['error']) {

			move_uploaded_file($foto['tmp_name'], $directory);

			return $name_file;

		} else {

			return 0;

		}
	}

	//Método para deletar os usuários
	public function deletarUsuario()
	{

		$sql = new Sql();

		$sql->query("DELETE FROM tb_usuarios WHERE id_usuario = :id_usuario", [
			':id_usuario' => $this->getid_usuario()
		]);

		if ($this->getinadmin() == 1 && $this->getfoto() != 0) {

			$img = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR .
				"res" . DIRECTORY_SEPARATOR .
				"ft_perfil" . DIRECTORY_SEPARATOR .
				$this->getfoto();
			unlink($img);
		} else {

			$img = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR .
				"res" . DIRECTORY_SEPARATOR .
				"ft_perfil" . DIRECTORY_SEPARATOR .
				$this->getfoto();

		}

	}

	//PAGINAÇÃO DA PÁGINA  USUÁRIOS
	public function getPageUsers($page = 1, $itemsPerPage = 25)
	{

		$start = ($page - 1) * $itemsPerPage;

		$sql = new Sql();

		$results = $sql->select("
			SELECT SQL_CALC_FOUND_ROWS *
			FROM tb_usuarios  ORDER BY data_registro desc
			LIMIT $start, $itemsPerPage");

		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");

		return [
			'data' => $results,
			'total' => (int) $resultTotal[0]["nrtotal"],
			'pages' => ceil($resultTotal[0]["nrtotal"] / $itemsPerPage)
		];

	}


	//BUSCA DA PÁGINA USUÁRIOS

	public static function getPageSearchUsers($search, $page = 1, $itemsPerPage = 25)
	{

		$start = ($page - 1) * $itemsPerPage;

		$sql = new Sql();

		$results = $sql->select("
			SELECT SQL_CALC_FOUND_ROWS *
			FROM tb_usuarios
			WHERE id_usuario LIKE :search  OR email LIKE :search OR nome_user LIKE :search OR login LIKE :search
			OR email LIKE :search   
			ORDER BY data_registro DESC
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

	//Método estático para verificar o total de usuários registrados
	public static function total()
	{

		$sql = new Sql();
		$total = $sql->select("SELECT SQL_CALC_FOUND_ROWS *
			FROM tb_usuarios");
		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");

		return ['totalUsuarios' => (int) $resultTotal[0]["nrtotal"]];
	}

	//METODO QUE VERIFICA O TOTAL  de ADMIN CADASTRADOS
	public static function totalAdmin()
	{

		$sql = new Sql();
		$total = $sql->select("SELECT COUNT(id_usuario) as Total
			FROM tb_usuarios WHERE inadmin = 1");

		return ['adminTotal' => (int) $total[0]["Total"]];
	}

	public static function totalUsuariosComuns()
	{

		$sql = new Sql();
		$total = $sql->select("SELECT COUNT(id_usuario) as Total
			FROM tb_usuarios WHERE inadmin = 0");

		return ['totalUsuariosComuns' => (int) $total[0]["Total"]];
	}




	//PAGINAÇÃO DA PÁGINA MINHAS ANOTAÇÕES 
	public function getMinhasAnotacoes($page = 1, $itemsPerPage = 25)
	{

		$start = ($page - 1) * $itemsPerPage;

		$sql = new Sql();

		$results = $sql->select("
			SELECT SQL_CALC_FOUND_ROWS *
			FROM  tb_anotacoes 
			WHERE id_usuario = :id_usuario 
			ORDER BY dt_registro_anotacao DESC
			LIMIT $start, $itemsPerPage", [

			':id_usuario' => $this->getid_usuario()
		]);

		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");

		return [
			'data' => $results,
			'total' => (int) $resultTotal[0]["nrtotal"],
			'pages' => ceil($resultTotal[0]["nrtotal"] / $itemsPerPage)
		];

	}

	//BUSCA DA PÁGINA MINHAS ANOTACOES

	public static function getSearchMinhasAnotacoes($search, $page = 1, $itemsPerPage = 25)
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


	//Método estático que seta a mensagem de erro
	public static function setError($msg)
	{

		$_SESSION[Usuario::ERROR] = $msg;

	}

	//Método estático que pega a mensagem de erro
	public static function getError()
	{

		$msg = (isset($_SESSION[Usuario::ERROR]) && $_SESSION[Usuario::ERROR]) ? $_SESSION[Usuario::ERROR] : '';

		Usuario::clearError();

		return $msg;

	}

	//Método estático que limpa a mensagem de erro
	public static function clearError()
	{

		$_SESSION[Usuario::ERROR] = NULL;

	}
	//Método estático que seta a mensagem de sucesso
	public static function setSuccess($msg)
	{

		$_SESSION[Usuario::SUCCESS] = $msg;

	}

	//Método estático que seta a mensagem de sucesso
	public static function getSuccess()
	{

		$msg = (isset($_SESSION[Usuario::SUCCESS]) && $_SESSION[Usuario::SUCCESS]) ? $_SESSION[Usuario::SUCCESS] : '';

		Usuario::clearSuccess();

		return $msg;

	}
	//Método estático que limpa a mensagem de sucesso
	public static function clearSuccess()
	{

		$_SESSION[Usuario::SUCCESS] = NULL;

	}

	public static function setErrorRegister($msg)
	{

		$_SESSION[Usuario::ERROR_REGISTER] = $msg;

	}

	public static function getErrorRegister()
	{

		$msg = (isset($_SESSION[Usuario::ERROR_REGISTER]) && $_SESSION[Usuario::ERROR_REGISTER]) ? $_SESSION[Usuario::ERROR_REGISTER] : '';

		Usuario::clearErrorRegister();

		return $msg;

	}

	public static function clearErrorRegister()
	{

		$_SESSION[Usuario::ERROR_REGISTER] = NULL;

	}
	//Método estático para recuperar senha
	public static function getForgot($email, $inadmin = true)
	{
		$sql = new Sql();

		$results = $sql->select(
			"SELECT * FROM  tb_usuarios  WHERE email = :email",
			array(
				":email" => $email

			)
		);

		if (count($results) === 0) {

			throw new \Exception("E-mail não cadastrado no sistema");

		} else {
			$data = $results[0];

			$results2 = $sql->select(
				"CALL sp_userspasswordsrecoveries_create(:id_usuario,:desip)",
				array(
					":id_usuario" => $data["id_usuario"],
					":desip" => $_SERVER["REMOTE_ADDR"]
				)
			);

			if (count($results2) === 0) {
				throw new \Exception("Não foi possível recuperar a senha.");

			} else {
				$dataRecovery = $results2[0];

				$code = openssl_encrypt($dataRecovery['idrecovery'], 'AES-128-CBC', pack("a16", Usuario::SECRET), 0, pack("a16", Usuario::SECRET_IV));

				$code = base64_encode($code);


				$link = "http://localhost/resetar-senha?code=$code";



				$mailer = new Mailer(
					$data['email'],
					$data['nome_user'],
					"Redefinir sua senha",
					"forgot",
					array(
						"name" => $data['nome_user'],
						"link" => $link
					)
				);

				$mailer->send();

				return $link;

			}
		}
	}

	public static function validForgotDecrypt($code)
	{

		$code = base64_decode($code);

		$idrecovery = openssl_decrypt($code, 'AES-128-CBC', pack("a16", Usuario::SECRET), 0, pack("a16", Usuario::SECRET_IV));

		$sql = new Sql();

		$results = $sql->select("
			SELECT *
			FROM tb_userspasswordsrecoveries a
			INNER JOIN tb_usuarios b USING(id_usuario)
			WHERE
				a.idrecovery = :idrecovery
				AND
				a.dtrecovery IS NULL
				AND
				DATE_ADD(a.dtregister, INTERVAL 1 HOUR) >= NOW();
		",
			array(
				":idrecovery" => $idrecovery
			)
		);

		if (count($results) === 0) {

			header("Location: /resetar-senha-erro");
			exit;

		} else {

			return $results[0];
		}

	}




	public static function setForgotUsed($idrecovery)
	{

		$sql = new Sql();

		$sql->query(
			"UPDATE tb_userspasswordsrecoveries SET dtrecovery = NOW() WHERE idrecovery = :idrecovery",
			array(
				":idrecovery" => $idrecovery
			)
		);

	}



	public function setPassword($senha)
	{

		$sql = new Sql();

		$sql->query(
			"UPDATE tb_usuarios SET senha = :senha WHERE id_usuario = :id_usuario",
			array(
				":senha" => $senha,
				":id_usuario" => $this->getid_usuario()

			)
		);

	}


	//PAGINAÇÃO DA PÁGINA HISTORICO EXCLUSAO
	public static function getPageAll($page = 1, $itemsPerPage = 25)
	{

		$start = ($page - 1) * $itemsPerPage;

		$sql = new Sql();

		$results = $sql->select("
			SELECT SQL_CALC_FOUND_ROWS *
		    FROM tb_historico_exclusao 
		    ORDER BY dt_registro DESC
			LIMIT $start, $itemsPerPage");


		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");

		return [
			'data' => $results,
			'total' => (int) $resultTotal[0]["nrtotal"],
			'pages' => ceil($resultTotal[0]["nrtotal"] / $itemsPerPage)
		];

	}

	//BUSCA DA PÁGINA HISTORICO EXCLUSÃO

	public static function getPageSearch($search, $page = 1, $itemsPerPage = 25)
	{

		$start = ($page - 1) * $itemsPerPage;

		$sql = new Sql();

		$results = $sql->select("
			SELECT SQL_CALC_FOUND_ROWS *
			FROM tb_historico_exclusao 
			WHERE  usuario LIKE :search  OR informacao LIKE :search 
			ORDER BY dt_registro DESC
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



?>
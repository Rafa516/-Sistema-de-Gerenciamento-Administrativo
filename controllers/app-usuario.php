<?php

use \Projeto\Page;
use \Projeto\Model\Usuario;
use \Projeto\Model\Componente;
use \Projeto\Model\Cidade;
use \Projeto\Model\Itinerario;
use \Projeto\Model\Unidade;


//------------------ROTA DA PÁGINA DE LOGIN--------------------------------//

$app->get('/', function() {  

	
	$page = new Page([
		"header"=>false,
		"footer"=>false
	]);

	$page->setTpl("login-usuario",[
		'error'=>Usuario::getError(),
		'profileMsg'=>Usuario::getSuccess(),
		'errorRegister'=>Usuario::getErrorRegister(),
	]);

});

//---------ROTA DO FORMULÁRIO DE LOGIN----------------------//

$app->post('/login', function() {

	try {

		Usuario::login($_POST['login'], $_POST['senha']);

	} catch(Exception $e) {

		Usuario::setError($e->getMessage());

		header("Location: /");
		exit;

	}

	header("Location: /usuario/home");
	exit;

});


//---------ROTA DA PÁGINA RECUPERAR SENHA ----------------------//

$app->get("/recuperar-senha", function() {

	$page = new Page([
		"header"=>false,
		"footer"=>false
	]);

	$page->setTpl("recuperar-senha",[
		'error'=>usuario::getError(),
		'profileMsg'=>Usuario::getSuccess()

	]);	

});



//---------ROTA DA PÁGINA RECUPERAR SENHA  ENVIO DO FORMULÁRIO (POST)----------------------//

$app->post("/recuperar-senha", function(){

	try {

		Usuario::getForgot($_POST["email"]);

	} catch(Exception $e) {

		Usuario::setError($e->getMessage());

		header("Location:/recuperar-senha");
		exit;
	}

	Usuario::setSuccess("E-mail de recuperação enviado!
	Verifique as instruções no seu e-mail.");

	header("Location: /recuperar-senha");
	exit;
	
});

//---------ROTA DA PÁGINA ALTERAR SENHA ----------------------//

$app->get("/resetar-senha", function() {

	$user = Usuario::validForgotDecrypt($_GET["code"]);

	$page = new Page([
		"header"=>false,
		"footer"=>false
	]);

	$page->setTpl("resetar-senha",[
		'error'=>Usuario::getError(),
		'profileMsg'=>Usuario::getSuccess(),
		'name'=>$user["nome_user"],
		'code'=>$_GET["code"]

	]);	

});

//---------ROTA DA PÁGINA ALTERAR SENHA (POST)----------------------//
$app->post("/resetar-senha", function(){

	$forgot = Usuario::validForgotDecrypt($_POST["code"]);	


	Usuario::setForgotUsed($forgot["idrecovery"]);

	$usuario = new Usuario();

	$usuario->get((int)$forgot["id_usuario"]);

	$senha = Usuario::getPasswordHash($_POST["senha"]);

	$usuario->setPassword($senha);

	Usuario::setSuccess("Senha Alterada com succeso!");

	header("Location: /");
	exit;

	

});
//---------ROTA DA PÁGINA DE ERRO AO ALTERAR SENHA----------------------//
$app->get("/resetar-senha-erro", function() {

	
	$page = new Page([
		"header"=>false,
		"footer"=>false
	]);

	$page->setTpl("resetar-senha-erro");	

});


//---------ROTA DO FORMULÁRIO DE REGISTRO USUÁRIO ----------------------//
$app->post("/registro", function(){

	if (Usuario::checkEmailExist($_POST['email']) === true) {

		Usuario::setErrorRegister("Este endereço de e-mail já está sendo usado por outro usuário.");
		header("Location: /");
		exit;

	}

	if (Usuario::checkLoginExist($_POST['login']) === true) {

		Usuario::setErrorRegister("Este Login já está sendo usado por outro usuário.");
		header("Location:/");
		exit;

	}

	$usuario = new Usuario();

	$usuario->setData([
		'inadmin'=>0,
		'login'=>$_POST['login'],
		'nome_user'=>$_POST['nome_user'],	
		'email'=>$_POST['email'],
		'senha'=>$_POST['senha'],
		'foto'=>0
	]);

	$usuario->cadastroUsuario();

	Usuario::setSuccess("Usuário cadastrado com sucesso");

	header('Location: /');
	exit;

});


//---------ROTA PARA ENCERRAR A SESSÃO----------------------//

$app->get('/usuario/logout', function() {

	Usuario::logout();

	header("Location: /");
	exit;

});


//---------ROTA PARA A PÁGINA INICIAL----------------------//

$app->get('/usuario/home', function() {  


	Usuario::verificaLogin();

	$page = new Page();

	$page->setTpl("usuario");

});

$app->get('/usuario/painel', function() {  


	Usuario::verificaLogin();

	$itinerarios = new Itinerario();

	$unidades = new Unidade();

	$page = new Page();

	$page->setTpl("usuario-painel",[
		"itinerarios"=>$itinerarios->getItinerariosGrafico(),
		"unidades"=>$unidades->getUnidadesGrafico(),
		"educacaoInfantil"=>$unidades->getUnidadesEducacaoInfantil(),
		"educacaoInfantilFundamental"=>$unidades->getUnidadesInfantilFundamental(),
		"educacaoFundamental"=>$unidades->getUnidadesFundamental(),
		"educacaoFundamentalMedio"=>$unidades->getUnidadesFundamentalMedio(),
		"educacaoMedio"=>$unidades->getUnidadesMedio(),
		"diretores"=>$unidades->getDiretores(),
		"viceDiretores"=>$unidades->getViceDiretores(),
		"supervisores"=>$unidades->getListaSupervisores(),
		"chefeSecretaria"=>$unidades->getChefeSecretaria(),
		"coordenadoresPedagogicos"=>$unidades->getListaCoordenadoresPedagogicos()


	]);

});

//---------ROTA PARA A PÁGINA UTILIDADES----------------------//

$app->get('/usuario/utilidades', function() {  


	Usuario::verificaLogin();

	$itinerarios = new Itinerario();

	$componentes = new Componente();

	$cidades = new Cidade();

	$page = new Page();

	$page->setTpl("usuario-utilidades",[
            "itinerarios"=>$itinerarios->getItinerariosCadastrados(), 
			"componentes"=>$componentes->getComponentes(),
			"cidades"=>$cidades->getCidades()     
        ]);

});

//---------ROTA PARA ALTERAR OS DADOS DO USUÁRIO - POST----------------------//

$app->post("/usuario/perfil/editar/:id_usuario", function ($id_usuario) {

	$usuario = new Usuario();

	$usuario->get((int)$id_usuario);

	$usuario->setData($_POST);

	$usuario-> editarUsuario();

	header('Location: /');
	exit;

});


//---------ROTA PARA  A PÁGINA DO PERFIL DO USUÁRIO----------------------//

$app->get('/usuario/perfil', function() {  


	Usuario::verificaLogin();

	$page = new Page();

	$page->setTpl("usuario-perfil",[
	'alteracaoErro'=>Usuario::getError(),
	'alteracaoSucesso'=>Usuario::getSuccess()
	]);

});



//---------ROTA PARA ALTERAR OS DADOS DO USUÁRIO - POST----------------------//

$app->get('/usuario/anotacoes', function() {  


	Usuario::verificaLogin();

	$page = new Page();

	$page->setTpl("usuario-anotacoes");

});

//---------ROTA PARA ALTERAR A FOTO DO PERFIL DO USUÁRIO - POST---------------------//

$app->post("/usuario/perfil/editar-imagem/:id_usuario", function ($id_usuario) {

	$usuario = new Usuario();

	$usuario->get((int)$id_usuario);


	$usuario->setData($_POST);

	$usuario->alterarImagemPerfil();

	header('Location: /');
	exit;

});

//---------ROTA PARA ALTERAR SENHA DO USUÁRIO  - POST---------------------//

$app->post("/perfil/alterar-senha", function(){



	if ($_POST['senha_atual'] === $_POST['nova_senha']) {

		Usuario::setError("A sua nova senha deve ser diferente da atual.");
		header("Location: /usuario/perfil");
		exit;		

	}

	$usuario = Usuario::getFromSession();

	if (!password_verify($_POST['senha_atual'], $usuario->getsenha())) {

		Usuario::setError("A senha atual está inválida.");
		header("Location: /usuario/perfil");
		exit;			

	}

	$usuario->setsenha($_POST['nova_senha']);

	$usuario->editarSenha();

	Usuario::setSuccess("Senha alterada com sucesso.");

	header("Location: /usuario/perfil");
	exit;

});





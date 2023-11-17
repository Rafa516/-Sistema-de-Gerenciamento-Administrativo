<?php

use \Projeto\Page;
use \Projeto\Model\Usuario;
use \Projeto\Model\Informacao;

//---------ROTA PARA DELETAR UMA INFORMAÇÃO ----------------------//

$app->get("/usuario/informacoes/delete/:id_informacao,:nome_user",function($id_informacao,$nome_user){

	$informacoes = new Informacao();

	$informacoes->get((int)$id_informacao);

	$informacoes->historico_informacao($nome_user);

	$informacoes->delete();

	header("Location: /usuario/informacoes");
 	exit;
});

$app->get('/usuario/informacoes', function() {  


	Usuario::verificaLogin();



	$informacoes = new Informacao();

	$search = (isset($_GET['search'])) ? $_GET['search'] : "";
	$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;

	if ($search != '') {

		$pagination = $informacoes::getPageSearchInformacoes($search, $page);

	} else {

		$pagination = $informacoes::getPageInformacoes($page);

	}

	$pages = [];

	for ($i=1; $i <= $pagination['pages']; $i++) { 
		array_push($pages, [
			'link'=>'/usuario/informacoes?page='.$i,
			'page'=>$i,
			'search'=>$search,
		]);
	}


	$page = new Page();

	$page->setTpl("usuario-informacoes",[
	"informacoesMensagem"=>Usuario::getSuccess(),
	 "search"=>$search,
	 "pages"=>$pages,
	 "informacoes"=>$pagination['data']
	]);

});

//---------ROTA PARA A PÁGINA DE REGISTRO DE INFORMAÇÕES ----------------------//

$app->get('/usuario/informacoes/registro', function() {  


    Usuario::verificaLogin();

	$page = new Page();

	$page->setTpl("usuario-cadastro-informacoes",[
	'errorRegister'=>Usuario::getErrorRegister(),
	'CallOpenMsg'=> Usuario::getSuccess()
	]);

});


//---------ROTA POST DO FORMULÁRIO DE REGISTRO DE INFORMAÇÕES  ----------------------//

$app->post("/usuario/informacoes/registrar", function(){

    Usuario::verificaLogin();


	$informacoes = new Informacao();

	if ($_POST['informacoes'] == '' &&  $_POST['informacoes'] == '') {

			Usuario::setErrorRegister("Escreva uma Informação");
			header("Location: /usuario/informacoes/registro");
			exit;

	}

	$informacoes->setData($_POST);

	

	$informacoes->cadastrarIndformacao();



	Usuario::setSuccess("Informação Registrada");

	header("Location: /usuario/informacoes");
	exit;


});


//---------ROTA PARA A PÁGINA DE EDIÇÃO DAS INFORMAÇÕES----------------------//

$app->get('/usuario/informacoes/alterar/:id_informacao', function($id_informacao){
 
   Usuario::verificaLogin();

 
   $informacoes = new Informacao();
 
   $informacoes->get((int)$id_informacao);
 
   $page = new Page();
 
   $page ->setTpl("usuario-editar-informacoes", array(
        "informacoes"=>$informacoes->getValues(),
		'CallOpenMsg'=> Usuario::getSuccess(), 
		'errorRegister'=>Usuario::getErrorRegister()  
    ));
 
});


//---------ROTA POST DO FORMULÁRIO PARA A PÁGINA DE EDIÇÃO DAS INFORMAÇÕES----------------------//

$app->post("/usuario/informacoes/alterar/:id_informacao", function($id_informacao){

    Usuario::verificaLogin();

	$informacoes = new Informacao();

	$informacoes->get((int)$id_informacao);

	$informacoes->setData($_POST);

	$informacoes->alterarInformacao();

	Usuario::setSuccess("Informação Alterada com sucesso");

	header("Location: /usuario/informacoes");
	exit;

});

?>

<?php

use \Projeto\PageAdmin;
use \Projeto\Model\Usuario;
use \Projeto\Model\Unidade;

//---------ROTA PARA DELETAR UMA UNIDADE ----------------------//

$app->get("/admin/unidade/delete/:id_unidade,:nome_user",function($id_unidade,$nome_user){

    $unidade = new Unidade();
    
    $unidade->get((int)$id_unidade);

	$unidade->historico_unidades($nome_user);

    $unidade->delete($id_unidade);

    header("Location: /admin/dados-unidades");
    exit;
});

//---------ROTA PARA DELETAR UMA IMAGEM ----------------------//

$app->get("/admin/unidade-imagem/delete/:id_foto",function($id_foto){

	$unidade = new Unidade();
   
	$unidade->getFoto((int)$id_foto);
 
	$unidade->deleteFoto();

   
	header("Location: /admin/unidades/imagens/".$id_unidade);
	exit;
});

//---------ROTA PARA DELETAR UM SUPERVISOR ----------------------//

$app->get("/admin/delete/supervisor/:id_supervisor",function($id_supervisor){

    $unidade = new Unidade();
    
    $unidade->getSupervisor((int)$id_supervisor);

    $unidade->deleteSupervisor($id_supervisor);

    header("Location: /admin/unidade/informacoes/".$id_unidade);
    exit;
});

//---------ROTA PARA DELETAR UM COORDENADOR ----------------------//

$app->get("/admin/delete/coordenador/:id_coordenador",function($id_coordenador){

    $unidade = new Unidade();
    
    $unidade->getCoordenadorPedagogico((int)$id_coordenador);

    $unidade->deleteCoordenador($id_coordenador);

    header("Location: /admin/unidade/informacoes/".$id_unidade);
    exit;
});

//---------ROTA PARA A PÁGINA PARA CADASTRAR UNIDADE ESCOLAR----------------------//

$app->get('/admin/cadastrar-unidade', function() {  


	Usuario::verificaLoginAdmin();

	$page = new PageAdmin();

	$page->setTpl("admin-cadastrar-unidade",[
		'unidadeOpenMsg'=>Usuario::getSuccess(),
		'errorRegister'=>Usuario::getErrorRegister()
	]);

});

//---------ROTA PARA PAGINA DE CADASTRO DE UMA UNIDADE----------------------//


$app->post("/admin/cadastrar-unidade/registro", function(){

	Usuario::verificaLoginAdmin();

	$unidade = new Unidade();

	if ($_POST['lat'] == '' &&  $_POST['lng'] == '') {

			Usuario::setErrorRegister("Marque um local no mapa");
			header("Location: /admin/cadastrar-unidade");
			exit;

	}

	$unidade->setData($_POST);
	var_dump($unidade);

	$unidade->salvarUnidade();

	Usuario::setSuccess("Local registrado com sucesso!!");

	header("Location: /admin/dados-unidades");
	exit;


});

//---------ROTA PARA A PÁGINA PARA CADASTRAR OU ALTERAR TELEFONE SUPERVISOR----------------------//

$app->get('/admin/cadastrar-alterar-contato-supervisor/:id_supervisor', function($id_supervisor){


	Usuario::verificaLoginAdmin();

	$unidade = new Unidade();

	$unidade->getSupervisor((int)$id_supervisor);

	$page = new PageAdmin();

	$page->setTpl("admin-cadastrar-alterar-contato-supervisor",[
		'unidadeOpenMsg'=>Usuario::getSuccess(),
		'errorRegister'=>Usuario::getErrorRegister(),
		"values"=>$unidade->getValues()

	]);

});


//---------ROTA PARA PAGINA DE CADASTRO OU ALETRAÇÃO TELEFONE SUPERVISOR----------------------//


$app->post("/admin/cadastrar-alterar-contato-supervisor/registro/:id_supervisor", function($id_supervisor){

	Usuario::verificaLoginAdmin();

	$unidade = new Unidade();

    $unidade->getSupervisor((int)$id_supervisor);

	$unidade->setData($_POST);

	$unidade->salvarAlterarContatoSupervisor();

	Usuario::setSuccess("Contato Alterado ou Incluído com Sucesso");

	header("Location: /admin/cadastrar-alterar-contato-supervisor/".$id_supervisor);
	exit;


});

//---------ROTA PARA A PÁGINA PARA CADASTRAR OU ALTERAR TELEFONE COORDENADOR----------------------//

$app->get('/admin/cadastrar-alterar-contato-coordenador/:id_coordenador', function($id_coordenador){


	Usuario::verificaLoginAdmin();

	$unidade = new Unidade();

	$unidade->getcoordenadorPedagogico((int)$id_coordenador);

	$page = new PageAdmin();

	$page->setTpl("admin-cadastrar-alterar-contato-coordenador",[
		'unidadeOpenMsg'=>Usuario::getSuccess(),
		'errorRegister'=>Usuario::getErrorRegister(),
		"values"=>$unidade->getValues()

	]);

});

//---------ROTA PARA PAGINA DE CADASTRO OU ALETRAÇÃO TELEFONE COORDENADOR----------------------//


$app->post("/admin/cadastrar-alterar-contato-coordenador/registro/:id_coordenador", function($id_coordenador){

	Usuario::verificaLoginAdmin();

	$unidade = new Unidade();

   $unidade->getcoordenadorPedagogico((int)$id_coordenador);

	$unidade->setData($_POST);

	$unidade->salvarAlterarContatoCoordenador();

	Usuario::setSuccess("Contato Alterado ou Incluído com Sucesso");

	header("Location: /admin/cadastrar-alterar-contato-coordenador/".$id_coordenador);
	exit;


});

//---------ROTA PARA A PÁGINA DO MAPA COM TODOS LOCAIS MARCADOS----------------------//

$app->get('/admin/unidades/localidades', function() {  


	Usuario::verificaLoginAdmin();

	$unidade = new Unidade();

	$page = new PageAdmin();

	$page->setTpl("admin-unidades-localidades",[
	"unidadesEscolares"=>$unidade::listAllUnidadesEscolares(),
	"unidadesAdministrativas"=>$unidade::listAllUnidadesAdministrativas()
	]);

});



//---------ROTA PARA A PÁGINA DAS IMAGENS DOS LOCAIS----------------------//

$app->get('/admin/unidade/fotos/:id_unidade', function($id_unidade) {  


	Usuario::verificaLoginAdmin();

	$unidade = new Unidade();

	$unidade->get((int)$id_unidade);

	$page = new PageAdmin();

	$page->setTpl("admin-unidade-imagens",[
		'imagens'=>$unidade->showPhotos($id_unidade),
		"values"=>$unidade->getValues()
	]);

});

//---------ROTA PARA ADICIONAR FOTOS FORM(POST)----------------------//


$app->post("/admin/unidade/fotos/post/:id_unidade", function($id_unidade){

	Usuario::verificaLoginAdmin();

	$unidade = new Unidade();

	$unidade->get((int)$id_unidade);

	// var_dump($unidade);
	// exit;
	$unidade->setData($_POST);
	
	$unidade->movePhotos();

	header("Location: /admin/unidade/fotos/".$id_unidade);
	exit;



});

//---------ROTA PARA A PÁGINA DE LOCALIZAÇÃO NO MAPA----------------------//

$app->get('/admin/unidade/localizacao/:id_unidade', function($id_unidade) {  


	Usuario::verificaLoginAdmin();

	$unidade = new Unidade();

	$page = new PageAdmin();

	$unidade->get((int)$id_unidade);

	$page->setTpl("admin-unidade-localizacao",[
		"values"=>$unidade->getValues(),
		'unidadeOpenMsg'=>Usuario::getSuccess()	
	]);

});

//---------ROTA PARA A PÁGINA DE ALTERAÇÃO DA  LOCALIZAÇÃO NO MAPA----------------------//

$app->get('/admin/unidade/localizacao-alterar/:id_unidade', function($id_unidade) {  


	Usuario::verificaLoginAdmin();

	$unidade = new Unidade();

	$page = new PageAdmin();

	$unidade->get((int)$id_unidade);

	$page->setTpl("admin-unidade-alterar-localizacao",[
		"values"=>$unidade->getValues(),
		'unidadeOpenMsg'=>Usuario::getSuccess(),
		'errorRegister'=>Usuario::getErrorRegister(),	
	]);

});

//---------ROTA PARA ALTERAÇÃO DA LOCALIZAÇÃO FORM(POST)----------------------//


$app->post("/admin/localizacao-alterar/post/:id_unidade", function($id_unidade){

	Usuario::verificaLoginAdmin();

	$unidade = new Unidade();

	$unidade->get((int)$id_unidade);

	if ($_POST['lat'] == '' &&  $_POST['lng'] == '') {

			Usuario::setErrorRegister("Localização já marcada");
			header("Location: /admin/unidade/localizacao-alterar/".$id_unidade);
			exit;

	}

	$unidade->setData($_POST);
	//var_dump($unidade);

	$unidade->alterarLocalizacao();

	Usuario::setSuccess("Local alterado com sucesso!!");

	header("Location: /admin/unidade/localizacao/".$id_unidade);
	exit;


});

//---------ROTA PARA A PÁGINA DE VISUALIZAÇÃO DAS INFORMAÇÕES DAS UNIDADES ---------------------//

    $app->get('/admin/unidade/informacoes/:id_unidade', function($id_unidade) {  


        Usuario::verificaLoginAdmin();

        $unidade = new Unidade();

        $unidade->get((int)$id_unidade);

        $supervisores = $unidade->getSupervisores($id_unidade);
        $coordenadores = $unidade->getCoordenadores($id_unidade);
     
        $page = new PageAdmin();

        $page->setTpl("admin-unidade-informacoes",[
            "value"=>$unidade->getValues(),
            'unidadeOpenMsg'=>Usuario::getSuccess(),
            "supervisores"=>$supervisores['data'],
            "coordenadores"=>$coordenadores['data'],
        ]);
    });


  //---------ROTA PARA O ENVIO DO FORMULÁRIO DE ALTERAÇÃO DOS DADOS DA UNIDADE----------------------//

    $app->post("/admin/unidade/editar/:id_unidade",function($id_unidade){

        
            $unidade = new Unidade();

            $unidade->get((int)$id_unidade);

            $unidade->setData($_POST);
            
            $unidade->alterarUnidades();


            Usuario::setSuccess("Dados alterados com Sucesso");

            header("Location: /admin/unidade/informacoes/".$id_unidade);
            exit;


        });  

 //---------ROTA PARA O ENVIO DO FORMULÁRIO DE ALTERAÇÃO DOS DADOS DA UNIDADE ADMINISTRATIVA----------------------//

 $app->post("/admin/unidade-administrativa/editar/:id_unidade",function($id_unidade){

        
	$unidade = new Unidade();

	$unidade->get((int)$id_unidade);

	$unidade->setData($_POST);
	
	$unidade->alterarUnidadeAdministrativa();


	Usuario::setSuccess("Dados alterados com Sucesso");

	header("Location: /admin/unidade/informacoes/".$id_unidade);
	exit;


});  		



//---------ROTA PARA  A PÁGINA DE TABELAS DE TODAS UNIDADES----------------------//

$app->get('/admin/dados-unidades', function() {  


	Usuario::verificaLoginAdmin();

	$unidade = new Unidade();

	$search = (isset($_GET['search'])) ? $_GET['search'] : "";
	$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;

	if ($search != '') {

		$pagination = $unidade::getPageSearch($search, $page);

	} else {

		$pagination = $unidade::getPage($page);

	}

	$pages = [];

	for ($i=1; $i <= $pagination['pages']; $i++) { 
		array_push($pages, [
			'link'=>'/admin/dados-unidades?page='.$i,
			'page'=>$i,
			'search'=>$search,
		]);
	}

	$page = new PageAdmin();

	$page->setTpl("admin-dados-unidades",[
	 "search"=>$search,
	 "total"=>$pagination['total'],
	 "pages"=>$pages,
	 'profileMsg'=> Usuario::getSuccess(),
	 "todasUnidades"=>$pagination['data'],
	 "value"=>$unidade->getValues()
	]);


});

?>
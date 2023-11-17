
<?php

use \Projeto\Page;
use \Projeto\Model\Usuario;
use \Projeto\Model\Unidade;
use \Projeto\Model\Avaliacao;

//---------ROTA PARA DELETAR UMA UNIDADE ----------------------//

$app->get("/usuario/avaliacao/delete/:id_avaliacao,:nome_user",function($id_avaliacao,$nome_user){

    $avaliacao = new Avaliacao();
    
    $avaliacao->get((int)$id_avaliacao);

	$avaliacao->historico_avaliacoes($nome_user);

    $avaliacao->delete($id_avaliacao);

    header("Location: /usuario/avaliacoes");
    exit;
});



//---------ROTA PARA A PÁGINA PARA CADASTRAR UNIDADE ESCOLAR----------------------//

$app->get('/usuario/cadastrar-avaliacao', function() {  


	Usuario::verificaLogin();

	$unidade = new Unidade();

	$page = new Page();

	$page->setTpl("usuario-cadastro-avaliacao",[
		'avaliacaoOpenMsg'=>Usuario::getSuccess(),
		'errorRegister'=>Usuario::getErrorRegister(),
		"unidades"=>$unidade->getUnidadesEscolares()
	]);

});

//---------ROTA PARA PAGINA DE CADASTRO DE UMA UNIDADE----------------------//


$app->post("/usuario/cadastrar-avaliacao/registro", function(){

	Usuario::verificaLogin();

	$avaliacao = new Avaliacao();

	$avaliacao->setData($_POST);
	var_dump($avaliacao);

	$avaliacao->registrarAvaliacoes();

	Usuario::setSuccess("Avaliação registrada com sucesso!!");

	header("Location: /usuario/avaliacoes");
	exit;


});


//---------ROTA PARA O ENVIO DO FORMULÁRIO DE ALTERAÇÃO DOS DADOS DA UNIDADE----------------------//

    $app->post("/usuario/avaliacao/editar/:id_avaliacao",function($id_avaliacao){

        
            $avaliacao = new Avaliacao();

            $avaliacao->get((int)$id_avaliacao);

            $avaliacao->setData($_POST);
            
            $avaliacao->editarAvaliacoes();


            Usuario::setSuccess("Dados alterados com Sucesso");

            header("Location: /usuario/editar-avaliacao/".$id_avaliacao);
            exit;


        });  
 		
//---------ROTA PARA ALTERAÇÃO DAS AVALIACOES----------------------//

$app->get('/usuario/editar-avaliacao/:id_valiacao', function($id_avaliacao){
    
	Usuario::verificaLogin();

	$avaliacao = new Avaliacao();

	$unidade = new Unidade();

	$avaliacao->get((int)$id_avaliacao);

	$page = new Page();

	$page ->setTpl("usuario-editar-avaliacao", array(
		"value"=>$avaliacao->getValues(),
		'CallOpenMsg'=>Usuario::getSuccess(),
		'errorRegister'=>Usuario::getErrorRegister(),
		"unidades"=>$unidade->getUnidadesEscolares()
	));

});

//---------ROTA PARA  A PÁGINA DE TABELAS DE TODAS UNIDADES----------------------//

$app->get('/usuario/avaliacoes', function() {  


	Usuario::verificaLogin();

	$avaliacao = new Avaliacao();

	$search = (isset($_GET['search'])) ? $_GET['search'] : "";
	
	$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;

	if ($search != '' ) {

		$pagination = $avaliacao::getPageSearch($search, $page);

	} else {

		$pagination = $avaliacao::getPageAvaliacao($page);

	}

	$pages = [];

	for ($i=1; $i <= $pagination['pages']; $i++) { 
		array_push($pages, [
			'link'=>'/usuario/avaliacoes?page='.$i,
			'page'=>$i,
			'search'=>$search,
		]);
	}

	$page = new Page();

	$page->setTpl("usuario-avaliacoes",[
	 "search"=>$search,
	 "total"=>$pagination['total'],
	 "pages"=>$pages,
	 'profileMsg'=> Usuario::getSuccess(),
	 "todasAvaliacoes"=>$pagination['data'],
	 "value"=>$avaliacao->getValues()
	]);


});

?>
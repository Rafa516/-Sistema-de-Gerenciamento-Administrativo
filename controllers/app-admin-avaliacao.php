
<?php

use \Projeto\PageAdmin;
use \Projeto\Model\Usuario;
use \Projeto\Model\Unidade;
use \Projeto\Model\Avaliacao;

//---------ROTA PARA DELETAR UMA UNIDADE ----------------------//

$app->get("/admin/avaliacao/delete/:id_avaliacao,:nome_user",function($id_avaliacao,$nome_user){

    $avaliacao = new Avaliacao();
    
    $avaliacao->get((int)$id_avaliacao);

	$avaliacao->historico_avaliacoes($nome_user);

    $avaliacao->delete($id_avaliacao);

    header("Location: /admin/avaliacoes");
    exit;
});



//---------ROTA PARA A PÁGINA PARA CADASTRAR UNIDADE ESCOLAR----------------------//

$app->get('/admin/cadastrar-avaliacao', function() {  


	Usuario::verificaLoginAdmin();

	$unidade = new Unidade();

	$page = new PageAdmin();

	$page->setTpl("admin-cadastro-avaliacao",[
		'avaliacaoOpenMsg'=>Usuario::getSuccess(),
		'errorRegister'=>Usuario::getErrorRegister(),
		"unidades"=>$unidade->getUnidadesEscolares()
	]);

});

//---------ROTA PARA PAGINA DE CADASTRO DE UMA UNIDADE----------------------//


$app->post("/admin/cadastrar-avaliacao/registro", function(){

	Usuario::verificaLoginAdmin();

	$avaliacao = new Avaliacao();

	$avaliacao->setData($_POST);
	var_dump($avaliacao);

	$avaliacao->registrarAvaliacoes();

	Usuario::setSuccess("Avaliação registrada com sucesso!!");

	header("Location: /admin/avaliacoes");
	exit;


});


//---------ROTA PARA O ENVIO DO FORMULÁRIO DE ALTERAÇÃO DOS DADOS DA UNIDADE----------------------//

    $app->post("/admin/avaliacao/editar/:id_avaliacao",function($id_avaliacao){

        
            $avaliacao = new Avaliacao();

            $avaliacao->get((int)$id_avaliacao);

            $avaliacao->setData($_POST);
            
            $avaliacao->editarAvaliacoes();


            Usuario::setSuccess("Dados alterados com Sucesso");

            header("Location: /admin/editar-avaliacao/".$id_avaliacao);
            exit;


        });  
 		
//---------ROTA PARA ALTERAÇÃO DAS AVALIACOES----------------------//

$app->get('/admin/editar-avaliacao/:id_valiacao', function($id_avaliacao){
    
	Usuario::verificaLoginAdmin();

	$avaliacao = new Avaliacao();

	$unidade = new Unidade();

	$avaliacao->get((int)$id_avaliacao);

	$page = new PageAdmin();

	$page ->setTpl("admin-editar-avaliacao", array(
		"value"=>$avaliacao->getValues(),
		'CallOpenMsg'=>Usuario::getSuccess(),
		'errorRegister'=>Usuario::getErrorRegister(),
		"unidades"=>$unidade->getUnidadesEscolares()
	));

});

//---------ROTA PARA  A PÁGINA DE TABELAS DE TODAS UNIDADES----------------------//

$app->get('/admin/avaliacoes', function() {  


	Usuario::verificaLoginAdmin();

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
			'link'=>'/admin/avaliacoes?page='.$i,
			'page'=>$i,
			'search'=>$search,
		]);
	}

	$page = new PageAdmin();

	$page->setTpl("admin-avaliacoes",[
	 "search"=>$search,
	 "total"=>$pagination['total'],
	 "pages"=>$pages,
	 'profileMsg'=> Usuario::getSuccess(),
	 "todasAvaliacoes"=>$pagination['data'],
	 "value"=>$avaliacao->getValues()
	]);


});

?>
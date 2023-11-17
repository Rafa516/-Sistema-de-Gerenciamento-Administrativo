<?php

use \Projeto\Page;
use \Projeto\Model\Usuario;
use \Projeto\Model\Anotacao;
		
//---------ROTA PARA DELETAR UMA ANOTACAO ----------------------//

$app->get("/usuario/anotacoes/delete/:id_anotacao",function($id_anotacao){

    $anotacao = new Anotacao();
    
    $anotacao->get((int)$id_anotacao);

    $anotacao->delete($id_anotacao);

    header("Location: /usuario/minhas-anotacoes");
    exit;
});




//--------- PÁGINA REGISTRAR ANOTACAO----------------------//

    $app->get('/usuario/registrar-anotacoes', function() {  


        Usuario::verificaLogin();

        $anotacao = new Anotacao();

        $page = new Page();

        $page->setTpl("usuario-cadastro-anotacoes",[
            'CallOpenMsg'=> Usuario::getSuccess(),
            'errorRegister'=> Usuario::getErrorRegister(),
           
        ]);

    });
//---------POST REGISTRAR ANOTACAO----------------------//

    $app->post("/usuario/registrar-anotacoes/enviar", function(){

        Usuario::verificaLogin();

       $anotacao = new Anotacao();
    
       $anotacao->setData($_POST);
               
       $anotacao->registrarAnotacao();

        Usuario::setSuccess("Anotações registradas com sucesso!!");

        header("Location: /usuario/minhas-anotacoes");
        exit;


    });


//---------ROTA PARA VIZUALIZAR DAS ANOTACAOS----------------------//

    $app->get('/usuario/anotacao-visualizar/:id_anotacao', function($id_anotacao){
    
        Usuario::verificaLogin();
    
        $anotacao = new Anotacao();
    
        $anotacao->get((int)$id_anotacao);
    
        $page = new Page();
    
        $page ->setTpl("usuario-visualizar-anotacao", array(
            "value"=>$anotacao->getValues(),
            'profileMsg'=>usuario::getSuccess(),
        ));
    
    });

    //---------ROTA PARA ALTERAR DAS ANOTACAOS----------------------//

    $app->get('/usuario/anotacao-editar/:id_anotacao', function($id_anotacao){
    
        Usuario::verificaLogin();
    
        $anotacao = new Anotacao();
    
        $anotacao->get((int)$id_anotacao);
    
        $page = new Page();
    
        $page ->setTpl("usuario-editar-anotacao", array(
            "value"=>$anotacao->getValues(),
            'CallOpenMsg'=>Usuario::getSuccess(),
            'errorRegister'=>Usuario::getErrorRegister(),
        ));
    
    });


  //---------ROTA PARA O ENVIO DO FORMULÁRIO DE EDIÇÃO DAS ANOTACAOS----------------------//

    $app->post("/usuario/anotacao/editar/:id_anotacao",function($id_anotacao){

            Usuario::verificaLogin();

            $anotacao = new Anotacao();

            $anotacao->get((int)$id_anotacao);

            $anotacao->setData($_POST);
            
            $anotacao->editarAnotacoes();

            Usuario::setSuccess("Dados alterados com Sucesso");

            header("Location: /usuario/anotacao-visualizar/".$id_anotacao);
            exit;


        });  

//---------ROTA PARA A PÁGINA DOS TERMOS DO USUÁRIO----------------------//
$app->get('/usuario/minhas-anotacoes', function() {  


    Usuario::verificaLogin();


    $usuario = Usuario::getFromSession();


    $search = (isset($_GET['search'])) ? $_GET['search'] : "";
    $page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;

    if ($search != '') {

        $pagination = $usuario->getSearchMinhasAnotacoes($search, $page);

    } else {

        $pagination = $usuario->getMinhasAnotacoes($page);

    }

    $pages = [];

    for ($i=1; $i <= $pagination['pages']; $i++) { 
        array_push($pages, [
            'link'=>'/usuario/minhas-anotacoes?page='.$i,
            'page'=>$i,
            'search'=>$search,
        ]);
    }

    $page = new Page();

    $page->setTpl("usuario-minhas-anotacoes",[
        
        "anotacoes"=>$pagination['data'],
        "total"=>$pagination['total'],
        "search"=>$search,
        'profileMsg'=>usuario::getSuccess(),
        "pages"=>$pages,
        'total_anotacoes'=>(int)$pagination['total']
    ]);

});


 





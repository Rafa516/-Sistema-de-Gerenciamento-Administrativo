<?php

use \Projeto\PageAdmin;
use \Projeto\Model\Usuario;
use \Projeto\Model\Itinerario;
use \Projeto\Model\Linha;
use \Projeto\Model\Cidade;
		

//---------ROTA PARA DELETAR UM ITINERARIO ----------------------//

    $app->get("/admin/itinerario/delete/:id_itinerarios,:nome_user",function($id_itinerarios,$nome_user){

        $itinerarios = new Itinerario();
        
        $itinerarios->get((int)$id_itinerarios);

        $itinerarios->historico_itinerario($nome_user);
     
        $itinerarios->delete((int)$id_itinerarios);

        header("Location: /admin/todos-itinerarios");
        exit;
    });



    //---------ROTA PARA DELETAR UMA LINHA DO ITINERARIO ----------------------//

$app->get("/admin/delete/itinerario-linha/:id_itinerarios_linhas",function($id_itinerarios_linhas){

    $itinerarios = new Itinerario();
    
    $itinerarios->getLinhasItinerario($id_itinerarios_linhas);

    $itinerarios->deleteLinhaItinerario($id_itinerarios_linhas);

    Usuario::setSuccess("Linha removida com Sucesso!!");

    header("Location: /admin/itinerario-visualizar/".$id_itinerarios);
    exit;
});


//---------ROTA PARA A ABERTURA DOS ITINERARIOS ----------------------//

    $app->get('/admin/cadastrar-itinerarios', function() {  


       Usuario::verificaLoginAdmin();

        $linha = new Linha();
        $cidades = new Cidade();

        $page = new PageAdmin();

        $page->setTpl("admin-cadastro-itinerarios",[
            'CallOpenMsg'=>Usuario::getSuccess(),
            'errorRegister'=>Usuario::getErrorRegister(),
            "linhas"=>$linha->getLinhasCadastradas(), 
            "cidades"=>$cidades->getCidades(),        
        ]);

    });

   

//---------ROTA PARA O FORMULÁRIO DOS ITINERARIOS----------------------//


    $app->post("/admin/cadastrar-itinerarios/enviar", function(){

       Usuario::verificaLoginAdmin();

       $itinerario = new Itinerario();
    
       
       $itinerario->setData($_POST); 
       
       $itinerario->cadastrarItinerarios();
       
        Usuario::setSuccess("Itinerario cadastrado com sucesso!!");

        header("Location: /admin/todos-itinerarios");
        exit;


    });


//---------ROTA PARA A PÁGINA DE VISUALIZAÇÃO  DOS ITINERARIOS ---------------------//

    $app->get('/admin/itinerario-visualizar/:id_itinerarios', function($id_itinerarios) {  


       Usuario::verificaLoginAdmin();

        $itinerario = new Itinerario();
        
        $linha = new Linha();

        $cidades = new Cidade();

        $itinerario->get((int)$id_itinerarios);

        $itinerario_linhas = $itinerario->getItinerarioLinhas($id_itinerarios);
        $page = new PageAdmin();

        $page->setTpl("admin-itinerario-visualizar",[
            "value"=>$itinerario->getValues(),
            "itinerario_linhas"=>$itinerario_linhas['data'],
            "linhas"=>$linha->getLinhasCadastradas(),
            'profileMsg'=>Usuario::getSuccess(),
            "cidades"=>$cidades->getCidades(),
        ]);
    });




 //---------ROTA PARA O ENVIO DO FORMULÁRIO DE EDIÇÃO DOS ITINERARIOS----------------------//

    $app->post("/admin/itinerario/editar/:id_itinerarios",function($id_itinerarios){

       Usuario::verificaLoginAdmin();

        $itinerario = new Itinerario();


        $itinerario->get((int)$id_itinerarios);
        
        $itinerario->setData($_POST);
        

        $itinerario->editarItinerarios();

        Usuario::setSuccess("Dados alterados com Sucesso");

        header("Location: /admin/itinerario-visualizar/".$id_itinerarios);
        exit;


    });


//---------ROTA PARA A PÁGINA DE TODOS OS ITINERARIOS ----------------------//
    $app->get('/admin/todos-itinerarios', function() {  


       Usuario::verificaLoginAdmin();

        $admin = Usuario::getFromSession();
        $itinerario = new Itinerario();


        $search = (isset($_GET['search'])) ? $_GET['search'] : "";
        $page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;

        if ($search != '') {

            $pagination = $itinerario->getPageSearch($search, $page);

        } else {

            $pagination = $itinerario->getPageAll($page);

        }

        $pages = [];

        for ($i=1; $i <= $pagination['pages']; $i++) { 
            array_push($pages, [
                'link'=>'/admin/todos-itinerarios?page='.$i,
                'page'=>$i,
                'search'=>$search,
            ]);
        }

        $linhas = new Linha;     

        $page = new PageAdmin();

        $page->setTpl("admin-todos-itinerarios",[
        
            "itinerarios"=>$pagination['data'],
            "search"=>$search,
            'profileMsg'=>Usuario::getSuccess(),
            "pages"=>$pages,
            "total"=>$pagination['total'],
            "values"=>$itinerario->getValues() 
           
        ]);

    });

    



   





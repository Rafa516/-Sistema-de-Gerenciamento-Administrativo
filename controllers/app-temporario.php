<?php

use \Projeto\Page;
use \Projeto\Model\Usuario;
use \Projeto\Model\Temporario;
use \Projeto\Model\Componente;
		

//---------ROTA PARA DELETAR UM Temporario ----------------------//

    $app->get("/usuario/temporarios/delete/:id_temporario",function($id_temporario){

        $temporarios = new Temporario();
       
        $temporarios->get((int)$id_temporario);
     
        $temporarios->delete();
       
        header("Location: /usuario/todos-temporarios");
        exit;
    });



//---------ROTA PARA A ABERTURA DOS TemporarioS----------------------//

    $app->get('/usuario/registrar-temporarios', function() {  


        usuario::verificaLogin();


        $componentes = new Componente();

        $page = new Page();

        $page->setTpl("usuario-cadastro-temporarios",[
            'CallOpenMsg'=>usuario::getSuccess(),
            'errorRegister'=>usuario::getErrorRegister(),
            "componentes"=>$componentes->getComponentes()

        ]);

    });

//---------ROTA PARA O FORMULÁRIO DOS TemporarioS----------------------//


    $app->post("/usuario/registrar-temporarios/enviar", function(){

        usuario::verificaLogin();

        $Temporario = new Temporario();


        $Temporario->setData($_POST);


        $Temporario->registrarTemporarios();

        

        usuario::setSuccess("Temporario registrado com sucesso!!");

        header("Location: /usuario/todos-temporarios");
        exit;


    });



    //---------ROTA PARA O FORMULÁRIO DOS TEMPORARIOS NAS MODAIS----------------------//


    $app->post("/usuario/registrar-temporarios-modal-beneficios/enviar", function(){

        usuario::verificaLogin();

        $Temporario = new Temporario();


        $Temporario->setData($_POST);


        $Temporario->registrarTemporarios();

        

        usuario::setSuccess("Temporario registrado com sucesso!!");

        header("Location: /usuario/registrar-beneficios");
        exit;


    });

    //---------ROTA PARA O FORMULÁRIO DOS TEMPORARIOS NAS MODAIS----------------------//


    $app->post("/usuario/registrar-temporarios-modal-dossiers/enviar", function(){

        usuario::verificaLogin();

        $Temporario = new Temporario();


        $Temporario->setData($_POST);


        $Temporario->registrarTemporarios();

        

        usuario::setSuccess("Temporario registrado com sucesso!!");

        header("Location: /usuario/registrar-dossiers");
        exit;


    });

    //---------ROTA PARA O FORMULÁRIO DOS TEMPORARIOS NAS MODAIS----------------------//


    $app->post("/usuario/registrar-temporarios-modal-pagamentos/enviar", function(){

        usuario::verificaLogin();

        $Temporario = new Temporario();


        $Temporario->setData($_POST);


        $Temporario->registrarTemporarios();

        

        usuario::setSuccess("Temporario registrado com sucesso!!");

        header("Location: /usuario/pagamentos-temporarios");
        exit;


    });




//---------ROTA PARA EDITAR ALTERAÇÃO DOS TemporarioS----------------------//

    $app->get('/usuario/temporario/editar/:id_temporario', function($id_temporario){
    
        Usuario::verificaLogin();
    
        $temporario = new Temporario();
    
        $temporario->get((int)$id_temporario);

        $componentes = new Componente();
    
        $page = new Page();
    
        $page ->setTpl("usuario-editar-temporario", array(
            "value"=>$temporario->getValues(),
            'CallOpenMsg'=>usuario::getSuccess(),
            'errorRegister'=>usuario::getErrorRegister(), 
            "componentes"=>$componentes->getComponentes() 
        ));
    
    });

 //---------ROTA PARA O ENVIO DO FORMULÁRIO DE EDIÇÃO DOS TemporarioS----------------------//

    $app->post("/usuario/temporario-alterar/:id_temporario",function($id_temporario){

        Usuario::verificaLogin();

        $Temporario = new Temporario();


        $Temporario->get((int)$id_temporario);
    
        $Temporario->setData($_POST); 

        $Temporario->editarTemporarios();

        Usuario::setSuccess("Dados alterados com Sucesso");

        header("Location: /usuario/todos-temporarios");
        exit;


    });


//---------ROTA PARA A PÁGINA DE TODOS OS TemporarioS ----------------------//
    $app->get('/usuario/todos-temporarios', function() {  


        Usuario::verificaLogin();

        $usuario = Usuario::getFromSession();
        $Temporario = new Temporario();


        $search = (isset($_GET['search'])) ? $_GET['search'] : "";
        $page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;

        if ($search != '') {

            $pagination = $Temporario->getPageSearchTemporario($search, $page);

        } else {

            $pagination = $Temporario->getPageTemporario($page);

        }

        $pages = [];

        for ($i=1; $i <= $pagination['pages']; $i++) { 
            array_push($pages, [
                'link'=>'/usuario/todos-temporarios?page='.$i,
                'page'=>$i,
                'search'=>$search,
            ]);
        }

        $page = new Page();

        $page->setTpl("usuario-todos-temporarios",[
            
            "temporarios"=>$pagination['data'],
            "total"=>$pagination['total'],
            "search"=>$search,
            'profileMsg'=>usuario::getSuccess(),
            "pages"=>$pages,
            "values"=>$Temporario->getValues()
        ]);

    });





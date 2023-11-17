<?php

use \Projeto\Page;
use \Projeto\Model\Usuario;
use \Projeto\Model\Efetivo;
use \Projeto\Model\Unidade;
;
		

//---------ROTA PARA DELETAR UM Efetivo ----------------------//

    $app->get("/usuario/efetivos/delete/:id_efetivo",function($id_efetivo){

        $efetivos = new Efetivo();
       
        $efetivos->get((int)$id_efetivo);
     
        $efetivos->delete();
       
        header("Location: /usuario/todos-efetivos");
        exit;
    });



//---------ROTA PARA A ABERTURA DOS EfetivoS----------------------//

    $app->get('/usuario/registrar-efetivos', function() {  


        usuario::verificaLogin();

        $unidades = new Unidade();

        $page = new Page();

        $page->setTpl("usuario-cadastro-efetivos",[
            'CallOpenMsg'=>usuario::getSuccess(),
            'errorRegister'=>usuario::getErrorRegister(),
            'unidades'=>$unidades->getUnidades()
          

        ]);

    });

//---------ROTA PARA O FORMULÁRIO DOS EfetivoS----------------------//


    $app->post("/usuario/registrar-efetivos/enviar", function(){

        usuario::verificaLogin();

        $efetivo = new Efetivo();

        $efetivo->setData($_POST);

        $efetivo->registrarEfetivos();
    
        usuario::setSuccess("Efetivo registrado com sucesso!!");

        header("Location: /usuario/todos-efetivos");
        exit;


    });



    //---------ROTA PARA O FORMULÁRIO DOS EFETIVOS NAS MODAIS----------------------//


    $app->post("/usuario/registrar-efetivos-modal-beneficios/enviar", function(){

        usuario::verificaLogin();

        $efetivo = new Efetivo();


        $efetivo->setData($_POST);


        $efetivo->registrarEfetivos();

        

        usuario::setSuccess("Efetivo registrado com sucesso!!");

        header("Location: /usuario/registrar-beneficios");
        exit;


    });

    //---------ROTA PARA O FORMULÁRIO DOS EFETIVOS NAS MODAIS----------------------//


    $app->post("/usuario/registrar-efetivos-modal-dossiers/enviar", function(){

        usuario::verificaLogin();

        $efetivo = new Efetivo();


        $efetivo->setData($_POST);


        $efetivo->registrarEfetivos();

        

        usuario::setSuccess("Efetivo registrado com sucesso!!");

        header("Location: /usuario/registrar-dossiers");
        exit;


    });

    //---------ROTA PARA O FORMULÁRIO DOS EFETIVOS NAS MODAIS----------------------//


    $app->post("/usuario/registrar-efetivos-modal-pagamentos/enviar", function(){

        usuario::verificaLogin();

        $efetivo = new Efetivo();


        $efetivo->setData($_POST);


        $efetivo->registrarEfetivos();

        

        usuario::setSuccess("Efetivo registrado com sucesso!!");

        header("Location: /usuario/pagamentos-efetivos");
        exit;


    });




//---------ROTA PARA EDITAR ALTERAÇÃO DOS EfetivoS----------------------//

    $app->get('/usuario/efetivo/editar/:id_efetivo', function($id_efetivo){
    
        Usuario::verificaLogin();
    
        $efetivo = new Efetivo();

        $unidades = new Unidade();
    
        $efetivo->get((int)$id_efetivo);
       
        $page = new Page();
    
        $page ->setTpl("usuario-editar-efetivo", array(
            "value"=>$efetivo->getValues(),
            'CallOpenMsg'=>usuario::getSuccess(),
            'errorRegister'=>usuario::getErrorRegister(),
            'profileMsg'=>usuario::getSuccess(),
            'unidades'=>$unidades->getUnidades() 
           
        ));
    
    });

 //---------ROTA PARA O ENVIO DO FORMULÁRIO DE EDIÇÃO DOS EfetivoS----------------------//

    $app->post("/usuario/efetivo-alterar/:id_efetivo",function($id_efetivo){

        Usuario::verificaLogin();

        $efetivo = new Efetivo();


        $efetivo->get((int)$id_efetivo);
    
        $efetivo->setData($_POST); 

        $efetivo->editarEfetivos();

        Usuario::setSuccess("Dados alterados com Sucesso");

        header("Location: /usuario/efetivo/editar/".$id_efetivo);
        exit;


    });


//---------ROTA PARA A PÁGINA DE TODOS OS EfetivoS ----------------------//
    $app->get('/usuario/todos-efetivos', function() {  


        Usuario::verificaLogin();

        $usuario = Usuario::getFromSession();
        $efetivo = new Efetivo();


        $search = (isset($_GET['search'])) ? $_GET['search'] : "";
        $page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;

        if ($search != '') {

            $pagination = $efetivo->getPageSearchEfetivo($search, $page);

        } else {

            $pagination = $efetivo->getPageEfetivo($page);

        }

        $pages = [];

        for ($i=1; $i <= $pagination['pages']; $i++) { 
            array_push($pages, [
                'link'=>'/usuario/todos-efetivos?page='.$i,
                'page'=>$i,
                'search'=>$search,
            ]);
        }

        $page = new Page();

        $page->setTpl("usuario-todos-efetivos",[
            
            "efetivos"=>$pagination['data'],
            "total"=>$pagination['total'],
            "search"=>$search,
            'profileMsg'=>usuario::getSuccess(),
            "pages"=>$pages,
            "values"=>$efetivo->getValues()
        ]);

    });





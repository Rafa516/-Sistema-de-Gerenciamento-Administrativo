<?php

use \Projeto\PageAdmin;
use \Projeto\Model\Usuario;
use \Projeto\Model\Temporario;
use \Projeto\Model\Componente;
		

//---------ROTA PARA DELETAR UM Temporario ----------------------//

    $app->get("/admin/temporarios/delete/:id_temporario",function($id_temporario){

        $temporarios = new Temporario();
       
        $temporarios->get((int)$id_temporario);
     
        $temporarios->delete();
       
        header("Location: /admin/todos-temporarios");
        exit;
    });



//---------ROTA PARA A ABERTURA DOS TemporarioS----------------------//

    $app->get('/admin/registrar-temporarios', function() {  


        usuario::verificaLoginAdmin();;


        $componentes = new Componente();

        $page = new PageAdmin();

        $page->setTpl("admin-cadastro-temporarios",[
            'CallOpenMsg'=>usuario::getSuccess(),
            'errorRegister'=>usuario::getErrorRegister(),
            "componentes"=>$componentes->getComponentes()

        ]);

    });

//---------ROTA PARA O FORMULÁRIO DOS TemporarioS----------------------//


    $app->post("/admin/registrar-temporarios/enviar", function(){

        usuario::verificaLoginAdmin();;

        $Temporario = new Temporario();


        $Temporario->setData($_POST);


        $Temporario->registrarTemporarios();

        

        usuario::setSuccess("Temporario registrado com sucesso!!");

        header("Location: /admin/todos-temporarios");
        exit;


    });



    //---------ROTA PARA O FORMULÁRIO DOS TEMPORARIOS NAS MODAIS----------------------//


    $app->post("/admin/registrar-temporarios-modal-beneficios/enviar", function(){

        usuario::verificaLoginAdmin();;

        $Temporario = new Temporario();


        $Temporario->setData($_POST);


        $Temporario->registrarTemporarios();

        

        usuario::setSuccess("Temporario registrado com sucesso!!");

        header("Location: /admin/registrar-beneficios");
        exit;


    });

    //---------ROTA PARA O FORMULÁRIO DOS TEMPORARIOS NAS MODAIS----------------------//


    $app->post("/admin/registrar-temporarios-modal-dossiers/enviar", function(){

        usuario::verificaLoginAdmin();;

        $Temporario = new Temporario();


        $Temporario->setData($_POST);


        $Temporario->registrarTemporarios();

        

        usuario::setSuccess("Temporario registrado com sucesso!!");

        header("Location: /admin/registrar-dossiers");
        exit;


    });

    //---------ROTA PARA O FORMULÁRIO DOS TEMPORARIOS NAS MODAIS----------------------//


    $app->post("/admin/registrar-temporarios-modal-pagamentos/enviar", function(){

        usuario::verificaLoginAdmin();;

        $Temporario = new Temporario();


        $Temporario->setData($_POST);


        $Temporario->registrarTemporarios();

        

        usuario::setSuccess("Temporario registrado com sucesso!!");

        header("Location: /admin/pagamentos-temporarios");
        exit;


    });




//---------ROTA PARA EDITAR ALTERAÇÃO DOS TemporarioS----------------------//

    $app->get('/admin/temporario/editar/:id_temporario', function($id_temporario){
    
        Usuario::verificaLoginAdmin();
    
        $temporario = new Temporario();
    
        $temporario->get((int)$id_temporario);

        $componentes = new Componente();
    
        $page = new PageAdmin();
    
        $page ->setTpl("admin-editar-temporario", array(
            "value"=>$temporario->getValues(),
            'CallOpenMsg'=>usuario::getSuccess(),
            'errorRegister'=>usuario::getErrorRegister(), 
            "componentes"=>$componentes->getComponentes() 
        ));
    
    });

 //---------ROTA PARA O ENVIO DO FORMULÁRIO DE EDIÇÃO DOS TemporarioS----------------------//

    $app->post("/admin/temporario-alterar/:id_temporario",function($id_temporario){

        Usuario::verificaLoginAdmin();

        $Temporario = new Temporario();


        $Temporario->get((int)$id_temporario);
    
        $Temporario->setData($_POST); 

        $Temporario->editarTemporarios();

        Usuario::setSuccess("Dados alterados com Sucesso");

        header("Location: /admin/todos-temporarios");
        exit;


    });


//---------ROTA PARA A PÁGINA DE TODOS OS TemporarioS ----------------------//
    $app->get('/admin/todos-temporarios', function() {  


        Usuario::verificaLoginAdmin();

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
                'link'=>'/admin/todos-temporarios?page='.$i,
                'page'=>$i,
                'search'=>$search,
            ]);
        }

        $page = new PageAdmin();

        $page->setTpl("admin-todos-temporarios",[
            
            "temporarios"=>$pagination['data'],
            "total"=>$pagination['total'],
            "search"=>$search,
            'profileMsg'=>usuario::getSuccess(),
            "pages"=>$pages,
            "values"=>$Temporario->getValues()
        ]);

    });





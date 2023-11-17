
<?php

use \Projeto\PageAdmin;
use \Projeto\Model\Usuario;
use \Projeto\Model\Efetivo;
use \Projeto\Model\Unidade;

		

//---------ROTA PARA DELETAR UM Efetivo----------------------//

    $app->get("/admin/efetivos/delete/:id_efetivo",function($id_efetivo){

        $efetivos = new Efetivo();
       
        $efetivos->get((int)$id_efetivo);
     
        $efetivos->delete();
       
        header("Location: /admin/todos-efetivos");
        exit;
    });



//---------ROTA PARA A ABERTURA DOS EfetivoS----------------------//

    $app->get('/admin/registrar-efetivos', function() {  


        usuario::verificaLoginAdmin();
        $unidades = new Unidade();

        $page = new PageAdmin();

        $page->setTpl("admin-cadastro-efetivos",[
            'CallOpenMsg'=>usuario::getSuccess(),
            'errorRegister'=>usuario::getErrorRegister(),
            'unidades'=>$unidades->getUnidades(),
            

        ]);

    });

//---------ROTA PARA O FORMULÁRIO DOS EfetivoS----------------------//


    $app->post("/admin/registrar-efetivos/enviar", function(){

        usuario::verificaLoginAdmin();;

        $Efetivo= new Efetivo();


        $Efetivo->setData($_POST);


        $Efetivo->registrarEfetivos();

        

        usuario::setSuccess("Efetivo registrado com sucesso!!");

        header("Location: /admin/todos-efetivos");
        exit;


    });



    //---------ROTA PARA O FORMULÁRIO DOS EFETIVOS NAS MODAIS----------------------//


    $app->post("/admin/registrar-efetivos-modal-beneficios/enviar", function(){

        usuario::verificaLoginAdmin();;

        $Efetivo= new Efetivo();


        $Efetivo->setData($_POST);


        $Efetivo->registrarEfetivos();

        

        usuario::setSuccess("Efetivo registrado com sucesso!!");

        header("Location: /admin/registrar-beneficios");
        exit;


    });

    //---------ROTA PARA O FORMULÁRIO DOS EFETIVOS NAS MODAIS----------------------//


    $app->post("/admin/registrar-efetivos-modal-dossiers/enviar", function(){

        usuario::verificaLoginAdmin();;

        $Efetivo= new Efetivo();


        $Efetivo->setData($_POST);


        $Efetivo->registrarEfetivos();

        

        usuario::setSuccess("Efetivo registrado com sucesso!!");

        header("Location: /admin/registrar-dossiers");
        exit;


    });

    //---------ROTA PARA O FORMULÁRIO DOS EFETIVOS NAS MODAIS----------------------//


    $app->post("/admin/registrar-efetivos-modal-pagamentos/enviar", function(){

        usuario::verificaLoginAdmin();;

        $Efetivo= new Efetivo();


        $Efetivo->setData($_POST);


        $Efetivo->registrarEfetivos();

        

        usuario::setSuccess("Efetivo registrado com sucesso!!");

        header("Location: /admin/pagamentos-efetivos");
        exit;


    });




//---------ROTA PARA EDITAR ALTERAÇÃO DOS EfetivoS----------------------//

    $app->get('/admin/efetivo/editar/:id_efetivo', function($id_efetivo){
    
        Usuario::verificaLoginAdmin();
    
        $efetivo = new Efetivo();

        $unidades = new Unidade();
    
        $efetivo->get((int)$id_efetivo);
    
        $page = new PageAdmin();
    
        $page ->setTpl("admin-editar-efetivo", array(
            "value"=>$efetivo->getValues(),
            'CallOpenMsg'=>usuario::getSuccess(),
            'errorRegister'=>usuario::getErrorRegister(),
            'unidades'=>$unidades->getUnidades() 
           
        ));
    
    });

 //---------ROTA PARA O ENVIO DO FORMULÁRIO DE EDIÇÃO DOS EfetivoS----------------------//

    $app->post("/admin/efetivo-alterar/:id_efetivo",function($id_efetivo){

        Usuario::verificaLoginAdmin();

        $Efetivo= new Efetivo();


        $Efetivo->get((int)$id_efetivo);
    
        $Efetivo->setData($_POST); 

        $Efetivo->editarEfetivos();

        Usuario::setSuccess("Dados alterados com Sucesso");

        header("Location: /admin/todos-efetivos");
        exit;


    });


//---------ROTA PARA A PÁGINA DE TODOS OS EfetivoS ----------------------//
    $app->get('/admin/todos-efetivos', function() {  


        Usuario::verificaLoginAdmin();

        $usuario = Usuario::getFromSession();
        $Efetivo= new Efetivo();


        $search = (isset($_GET['search'])) ? $_GET['search'] : "";
        $page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;

        if ($search != '') {

            $pagination = $Efetivo->getPageSearchEfetivo($search, $page);

        } else {

            $pagination = $Efetivo->getPageEfetivo($page);

        }

        $pages = [];

        for ($i=1; $i <= $pagination['pages']; $i++) { 
            array_push($pages, [
                'link'=>'/admin/todos-efetivos?page='.$i,
                'page'=>$i,
                'search'=>$search,
            ]);
        }

        $page = new PageAdmin();

        $page->setTpl("admin-todos-efetivos",[
            
            "efetivos"=>$pagination['data'],
            "total"=>$pagination['total'],
            "search"=>$search,
            'profileMsg'=>usuario::getSuccess(),
            "pages"=>$pages,
            "values"=>$Efetivo->getValues()
        ]);

    });





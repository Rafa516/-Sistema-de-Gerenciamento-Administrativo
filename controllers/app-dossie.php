<?php

use \Projeto\Page;
use \Projeto\Model\Usuario;
use \Projeto\Model\Dossie;
use \Projeto\Model\Temporario;
use \Projeto\Model\Componente;
		

//---------ROTA PARA DELETAR UM Dossie ----------------------//

    $app->get("/usuario/dossiers/delete/:id_dossie",function($id_dossie){

        $dossiers = new Dossie();
       
        $dossiers->get((int)$id_dossie);
     
        $dossiers->delete();
       
        header("Location: /usuario/todos-dossiers-temporarios");
        exit;
    });


    //---------ROTA PARA DELETAR UM ARQUIVO ----------------------//

    $app->get("/usuario/dossiers-arquivo/delete/:id_arquivo_dossie",function($id_arquivo_dossie){

        $dossiers = new Dossie();
       
        $dossiers->getArquivo((int)$id_arquivo_dossie);
     
        $dossiers->deleteArquivo();

        Usuario::setSuccess("Arquivo removido com sucesso");
       
        header("Location: /usuario/todos-dossiers-temporarios/arquivos/".$id_dossie);
        exit;
    });

 
//---------ROTA PARA A ABERTURA DOS DossieS----------------------//

    $app->get('/usuario/registrar-dossiers', function() {  


        usuario::verificaLogin();

        $temporarios = new Temporario();

        $componentes = new Componente();

        $page = new Page();

        $page->setTpl("usuario-cadastro-dossiers",[
            'CallOpenMsg'=>usuario::getSuccess(),
            'errorRegister'=>usuario::getErrorRegister(),
            "temporarios"=>$temporarios->getTemporariosCadastrados(),
            "componentes"=>$componentes->getComponentes()
            


        ]);

    });

//---------ROTA PARA O FORMULÁRIO DOS DossieS----------------------//


    $app->post("/usuario/registrar-dossiers/enviar", function(){

        usuario::verificaLogin();

        $dossie = new Dossie();


        $dossie->setData($_POST);



        $dossie->registrarDossies();


        usuario::setSuccess("Dossie registrado com sucesso!!");

        header("Location: /usuario/todos-dossiers-temporarios");
        exit;


    });




//---------ROTA PARA EDITAR ALTERAÇÃO DOS DossieS----------------------//

    $app->get('/usuario/dossie/editar/:id_dossie', function($id_dossie){
    
        Usuario::verificaLogin();
    
        $dossie = new Dossie();
    
        $dossie->get((int)$id_dossie);

        $temporarios = new Temporario();
    
        $page = new Page();
    
        $page ->setTpl("usuario-editar-dossie", array(
            "value"=>$dossie->getValues(),
            'CallOpenMsg'=>usuario::getSuccess(),
            'errorRegister'=>usuario::getErrorRegister(), 
            "temporarios"=>$temporarios->getTemporariosCadastrados(), 
        ));
    
    });

 //---------ROTA PARA O ENVIO DO FORMULÁRIO DE EDIÇÃO DOS DossieS----------------------//

    $app->post("/usuario/dossie/editar/:id_dossie",function($id_dossie){

        Usuario::verificaLogin();

        $dossie = new Dossie();


        $dossie->get((int)$id_dossie);
    
        $dossie->setData($_POST);
       
        

        $dossie->editarDossies();

        Usuario::setSuccess("Dados alterados com Sucesso");

        header("Location: /usuario/todos-dossiers-temporarios");
        exit;


    });


//---------ROTA PARA A PÁGINA TODOS DOSSIES CONTRATO TEMPORÁRIO----------------------//
    $app->get('/usuario/todos-dossiers-temporarios', function() {  


        Usuario::verificaLogin();

        $usuario = Usuario::getFromSession();
        $dossie = new Dossie();


        $search = (isset($_GET['search'])) ? $_GET['search'] : "";
        $page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;

        if ($search != '') {

            $pagination = $dossie->getPageSearchDossieTemporario($search, $page);

        } else {

            $pagination = $dossie->getPageDossieTemporario($page);

        }

        $pages = [];

        for ($i=1; $i <= $pagination['pages']; $i++) { 
            array_push($pages, [
                'link'=>'/usuario/dossiers-temporarios?page='.$i,
                'page'=>$i,
                'search'=>$search,
            ]);
        }

        $page = new Page();

        $page->setTpl("usuario-todos-dossiers-temporarios",[
            
            "dossiers"=>$pagination['data'],
            "total"=>$pagination['total'],
            "search"=>$search,
            'profileMsg'=>usuario::getSuccess(),
            "pages"=>$pages,
            "values"=>$dossie->getValues()
        ]);

    });

//---------ROTA PARA ANEXAR ARQUIVO  - POST---------------------//

    $app->post("/usuario/dossie/anexar-arquivo/:id_dossie", function ($id_dossie) {

        $dossie = new Dossie();

        $dossie  ->get((int)$id_dossie);
    
        $dossie  ->setData($_POST);
    
        $dossie  ->moveArquivo();

        Usuario::setSuccess("Arquivo(s) Anexado(s) com Sucesso");

        header('Location: /usuario/todos-dossiers-temporarios/arquivos/'.$id_dossie);
        exit;

    });

//---------ROTA PARA A PÁGINA DOS ARQUIVOS DO Dossie----------------------//

    $app->get('/usuario/todos-dossiers-temporarios/arquivos/:id_dossie', function($id_dossie) {  


        Usuario::verificaLogin();

        $dossie = new Dossie();

        $page = new Page();

        $page->setTpl("usuario-arquivos-dossiers",[
            "id_dossie"=>$dossie->get((int)$id_dossie),
            'arquivo'=>$dossie->showArquivo($id_dossie),
            "value"=>$dossie->getValues(), 
            'profileMsg'=>usuario::getSuccess(),        

        ]);

    });




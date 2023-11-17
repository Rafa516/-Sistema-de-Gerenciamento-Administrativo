<?php

use \Projeto\PageAdmin;
use \Projeto\Model\Usuario;
use \Projeto\Model\Termo;
use \Projeto\Model\Linha;
		
//---------ROTA PARA DELETAR UM LINHA ----------------------//

$app->get("/admin/linhas/delete/:id_linha",function($id_linha){

    $linha = new Linha();
    
    $linha->get((int)$id_linha);

    $linha->delete($id_linha);

    header("Location: /admin/linhas");
    exit;
});




//--------- PÁGINA REGISTRAR LINHA----------------------//

    $app->get('/admin/registrar-linhas', function() {  


        Usuario::verificaLoginAdmin();

        $linha = new Linha();

        $page = new PageAdmin();

        $page->setTpl("admin-registro-linhas",[
            'CallOpenMsg'=> Usuario::getSuccess(),
            'errorRegister'=> Usuario::getErrorRegister(),
             "linhas"=>$linha->getlinhasLinha(),
           
        ]);

    });
//---------POST REGISTRAR LINHA----------------------//

    $app->post("/admin/registrar-linhas/enviar", function(){

        Usuario::verificaLoginAdmin();

       $linha = new Linha();
    
       $linha->setData($_POST);
           
       $linha->registrarLinhas();

        Usuario::setSuccess("Linha registrada com sucesso!!");

        header("Location: /admin/linhas");
        exit;


    });


//---------ROTA PARA ALTERAÇÃO DAS LINHAS----------------------//

    $app->get('/admin/linhas/editar/:id_linha', function($id_linha){
    
        Usuario::verificaLoginAdmin();
    
        $linha = new Linha();
    
        $linha->get((int)$id_linha);
   
        $page = new PageAdmin();
    
        $page ->setTpl("admin-linhas-editar", array(
            "value"=>$linha->getValues(),
            'CallOpenMsg'=>Usuario::getSuccess(),
            'errorRegister'=>Usuario::getErrorRegister(),
        ));
    
    });

  //---------ROTA PARA O ENVIO DO FORMULÁRIO DE EDIÇÃO DAS LINHAS----------------------//

    $app->post("/admin/linhas/editar/:id_linha",function($id_linha){

            Usuario::verificaLoginAdmin();

            $linha = new Linha();


            $linha->get((int)$id_linha);

            $linha->setData($_POST);

            $linha->editarLinhas();

            Usuario::setSuccess("Dados alterados com Sucesso");

            header("Location: /admin/linhas");
            exit;


        });  

//---------ROTA PARA A PÁGINA DAS LINHAS ----------------------//
    $app->get('/admin/linhas', function() {  


        Usuario::verificaLoginAdmin();

        $admin = Usuario::getFromSession();
        $linha = new Linha();


        $search = (isset($_GET['search'])) ? $_GET['search'] : "";
        $page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;

        if ($search != '') {

            $pagination = $linha->getPageSearch($search, $page);

        } else {

            $pagination = $linha->getPageLinha($page);

        }

        $pages = [];

        for ($i=1; $i <= $pagination['pages']; $i++) { 
            array_push($pages, [
                'link'=>'/admin/linhas?page='.$i,
                'page'=>$i,
                'search'=>$search,
            ]);
        }

        $page = new PageAdmin();

        $page->setTpl("admin-linhas",[
            
            "linha"=>$pagination['data'],
            "total"=>$pagination['total'],
            "search"=>$search,
            'profileMsg'=> Usuario::getSuccess(),
            "pages"=>$pages,
            "values"=>$linha->getValues()
        ]);

    });


    //---------ROTA PARA PAINEL DE LOCAIS---------------------//

    $app->get('/admin/linha-locais', function() {  

        Usuario::verificaLoginAdmin();

        $page = new PageAdmin();

        $page->setTpl("admin-linhas-locais",[ ]);

    });





<?php

use \Projeto\Page;
use \Projeto\Model\Usuario;
use \Projeto\Model\Termo;
use \Projeto\Model\Linha;
		
//---------ROTA PARA DELETAR UM LINHA ----------------------//

$app->get("/usuario/linhas/delete/:id_linha",function($id_linha){

    $linha = new Linha();
    
    $linha->get((int)$id_linha);

    $linha->delete($id_linha);

    header("Location: /usuario/linhas");
    exit;
});




//--------- PÁGINA REGISTRAR LINHA----------------------//

    $app->get('/usuario/registrar-linhas', function() {  


        Usuario::verificaLogin();

        $linha = new Linha();

        $page = new Page();

        $page->setTpl("usuario-cadastro-linhas",[
            'CallOpenMsg'=> Usuario::getSuccess(),
            'errorRegister'=> Usuario::getErrorRegister(),
             "linhas"=>$linha->getlinhasLinha(),
           
        ]);

    });
//---------POST REGISTRAR LINHA----------------------//

    $app->post("/usuario/registrar-linhas/enviar", function(){

        Usuario::verificaLogin();

       $linha = new Linha();
    
       $linha->setData($_POST);
           
       $linha->registrarLinhas();

        Usuario::setSuccess("Linha registrada com sucesso!!");

        header("Location: /usuario/linhas");
        exit;


    });


//---------ROTA PARA ALTERAÇÃO DAS LINHAS----------------------//

    $app->get('/usuario/linhas/editar/:id_linha', function($id_linha){
    
        Usuario::verificaLogin();
    
        $linha = new Linha();
    
        $linha->get((int)$id_linha);
   
        $page = new Page();
    
        $page ->setTpl("usuario-editar-linha", array(
            "value"=>$linha->getValues(),
            'CallOpenMsg'=>Usuario::getSuccess(),
            'errorRegister'=>Usuario::getErrorRegister(),
        ));
    
    });

  //---------ROTA PARA O ENVIO DO FORMULÁRIO DE EDIÇÃO DAS LINHAS----------------------//

    $app->post("/usuario/linhas/editar/:id_linha",function($id_linha){

            Usuario::verificaLogin();

            $linha = new Linha();


            $linha->get((int)$id_linha);

            $linha->setData($_POST);

            $linha->editarLinhas();

            Usuario::setSuccess("Dados alterados com Sucesso");

            header("Location: /usuario/linhas");
            exit;


        });  

//---------ROTA PARA A PÁGINA DAS LINHAS ----------------------//
    $app->get('/usuario/linhas', function() {  


        Usuario::verificaLogin();

        $usuario = Usuario::getFromSession();
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
                'link'=>'/usuario/linhas?page='.$i,
                'page'=>$i,
                'search'=>$search,
            ]);
        }

        $page = new Page();

        $page->setTpl("usuario-linhas",[
            
            "linha"=>$pagination['data'],
            "total"=>$pagination['total'],
            "search"=>$search,
            'profileMsg'=> Usuario::getSuccess(),
            "pages"=>$pages,
            "values"=>$linha->getValues()
        ]);

    });


    //---------ROTA PARA PAINEL DE LOCAIS---------------------//

    $app->get('/usuario/linha-locais', function() {  

        Usuario::verificaLogin();

        $page = new Page();

        $page->setTpl("usuario-linhas-locais",[ ]);

    });





<?php

use \Projeto\Page;
use \Projeto\Model\Usuario;
use \Projeto\Model\Documento;
		

//---------ROTA PARA DELETAR UM Documento ----------------------//

    $app->get("/usuario/documentos/delete/:id_documento,:nome_user",function($id_documento,$nome_user){

        $documentos = new Documento();
       
        $documentos->get((int)$id_documento);

        $documentos->historico_documentos($nome_user);
     
        $documentos->delete();
       
        header("Location: /usuario/todos-documentos");
        exit;
    });

//---------ROTA PARA DELETAR UM ARQUIVO ----------------------//

    $app->get("/usuario/documentos-arquivo/delete/:id_arquivoD,:nome_user",function($id_arquivoD,$nome_user){

        $documentos = new Documento();
       
        $documentos->getArquivo((int)$id_arquivoD);
  
        $documentos->historico_arquivos($nome_user);
     
        $documentos->deleteArquivo();

        Usuario::setSuccess("Arquivo removido com sucesso");
       
        header("Location: /usuario/todos-documentos/arquivos/".$id_documento);
        exit;
    });


//---------ROTA PARA A ABERTURA DOS DocumentoS----------------------//

    $app->get('/usuario/registrar-documentos', function() {  


        usuario::verificaLogin();



        $page = new Page();

        $page->setTpl("usuario-cadastro-documentos",[
            'CallOpenMsg'=>usuario::getSuccess(),
            'errorRegister'=>usuario::getErrorRegister(),
            


        ]);

    });

//---------ROTA PARA O FORMULÁRIO DOS DocumentoS----------------------//


    $app->post("/usuario/registrar-documentos/enviar", function(){

        usuario::verificaLogin();

        $Documento = new Documento();


        $Documento->setData($_POST);


        $Documento->registrarDocumentos();

        

        usuario::setSuccess("Documento registrado com sucesso!!");

        header("Location: /usuario/todos-documentos");
        exit;


    });




//---------ROTA PARA EDITAR ALTERAÇÃO DOS DocumentoS----------------------//

    $app->get('/usuario/documento/editar/:id_documento', function($id_documento){
    
        Usuario::verificaLogin();
    
        $documento = new Documento();
    
        $documento->get((int)$id_documento);
    
        $page = new Page();
    
        $page ->setTpl("usuario-editar-documento", array(
            "value"=>$documento->getValues(),
            'CallOpenMsg'=>usuario::getSuccess(),
            'errorRegister'=>usuario::getErrorRegister()  
        ));
    
    });

 //---------ROTA PARA O ENVIO DO FORMULÁRIO DE EDIÇÃO DOS DocumentoS----------------------//

    $app->post("/usuario/Documento/editar/:id_documento",function($id_documento){

        Usuario::verificaLogin();

        $Documento = new Documento();


        $Documento->get((int)$id_documento);
    
        $Documento->setData($_POST);
       
        

        $Documento->editarDocumentos();

        Usuario::setSuccess("Dados alterados com Sucesso");

        header("Location: /usuario/todos-documentos");
        exit;


    });


//---------ROTA PARA A PÁGINA DE TODOS OS DocumentoS ----------------------//
    $app->get('/usuario/todos-documentos', function() {  


        Usuario::verificaLogin();

        $usuario = Usuario::getFromSession();
        $Documento = new Documento();


        $search = (isset($_GET['search'])) ? $_GET['search'] : "";
        $page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;

        if ($search != '') {

            $pagination = $Documento->getPageSearch($search, $page);

        } else {

            $pagination = $Documento->getPageAll($page);

        }

        $pages = [];

        for ($i=1; $i <= $pagination['pages']; $i++) { 
            array_push($pages, [
                'link'=>'/usuario/todos-documentos?page='.$i,
                'page'=>$i,
                'search'=>$search,
            ]);
        }

        $page = new Page();

        $page->setTpl("usuario-todos-documentos",[
            
            "documentos"=>$pagination['data'],
            "total"=>$pagination['total'],
            "search"=>$search,
            'profileMsg'=>usuario::getSuccess(),
            "pages"=>$pages,
            "values"=>$Documento->getValues()
        ]);

    });

//---------ROTA PARA ANEXAR ARQUIVO  - POST---------------------//

    $app->post("/usuario/documento/anexar-arquivo/:id_documento", function ($id_documento) {

        $documento = new Documento();

        $documento  ->get((int)$id_documento);
    
        $documento  ->setData($_POST);
    
        $documento  ->moveArquivo();

        Usuario::setSuccess("Arquivo(s) Anexado(s) com Sucesso");

        header('Location: /usuario/todos-documentos/arquivos/'.$id_documento);
        exit;

    });

//---------ROTA PARA A PÁGINA DOS ARQUIVOS DO Documento----------------------//

    $app->get('/usuario/todos-documentos/arquivos/:id_documento', function($id_documento) {  


        Usuario::verificaLogin();

        $documento = new Documento();

        $page = new Page();

        $page->setTpl("usuario-arquivos-documentos",[
            "id_documento"=>$documento->get((int)$id_documento),
            'arquivo'=>$documento->showArquivo($id_documento),
            "value"=>$documento->getValues(),
            'profileMsg'=>usuario::getSuccess()

        ]);

    });




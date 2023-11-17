<?php

use \Projeto\PageAdmin;
use \Projeto\Model\Usuario;
use \Projeto\Model\Documento;
		

//---------ROTA PARA DELETAR UM Documento ----------------------//

    $app->get("/admin/documentos/delete/:id_documento,:nome_user",function($id_documento,$nome_user){

        $documentos = new Documento();
       
        $documentos->get((int)$id_documento);

        $documentos->historico_documentos($nome_user);
     
        $documentos->delete();
       
        header("Location: /admin/todos-documentos");
        exit;
    });

//---------ROTA PARA DELETAR UM ARQUIVO ----------------------//

    $app->get("/admin/documentos-arquivo/delete/:id_arquivoD,:nome_user",function($id_arquivoD,$nome_user){

        $documentos = new Documento();
       
        $documentos->getArquivo((int)$id_arquivoD);

        $documentos->historico_arquivos($nome_user);
     
        $documentos->deleteArquivo();

        Usuario::setSuccess("Arquivo removido com sucesso");
       
        header("Location: /admin/todos-documentos/arquivos/".$id_documento);
        exit;
    });


//---------ROTA PARA A ABERTURA DOS DocumentoS----------------------//

    $app->get('/admin/registrar-documentos', function() {  


        Usuario::verificaLoginAdmin();



        $page = new PageAdmin();

        $page->setTpl("admin-cadastro-documentos",[
            'CallOpenMsg'=>usuario::getSuccess(),
            'errorRegister'=>usuario::getErrorRegister(),
            


        ]);

    });

//---------ROTA PARA O FORMULÁRIO DOS DocumentoS----------------------//


    $app->post("/admin/registrar-documentos/enviar", function(){

        Usuario::verificaLoginAdmin();

        $Documento = new Documento();


        $Documento->setData($_POST);


        $Documento->registrarDocumentos();

        

        usuario::setSuccess("Documento registrado com sucesso!!");

        header("Location: /admin/todos-documentos");
        exit;


    });




//---------ROTA PARA EDITAR ALTERAÇÃO DOS DocumentoS----------------------//

    $app->get('/admin/documento/editar/:id_documento', function($id_documento){
    
        Usuario::verificaLoginAdmin();
    
        $documento = new Documento();
    
        $documento->get((int)$id_documento);
    
        $page = new PageAdmin();
    
        $page ->setTpl("admin-editar-documento", array(
            "value"=>$documento->getValues(),
            'CallOpenMsg'=>usuario::getSuccess(),
            'errorRegister'=>usuario::getErrorRegister()  
        ));
    
    });

 //---------ROTA PARA O ENVIO DO FORMULÁRIO DE EDIÇÃO DOS DocumentoS----------------------//

    $app->post("/admin/Documento/editar/:id_documento",function($id_documento){

        Usuario::verificaLoginAdmin();

        $Documento = new Documento();


        $Documento->get((int)$id_documento);
    
        $Documento->setData($_POST);
       
        

        $Documento->editarDocumentos();

        Usuario::setSuccess("Dados alterados com Sucesso");

        header("Location: /admin/todos-documentos");
        exit;


    });


//---------ROTA PARA A PÁGINA DE TODOS OS DocumentoS ----------------------//
    $app->get('/admin/todos-documentos', function() {  


        Usuario::verificaLoginAdmin();

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
                'link'=>'/admin/todos-documentos?page='.$i,
                'page'=>$i,
                'search'=>$search,
            ]);
        }

        $page = new PageAdmin();

        $page->setTpl("admin-todos-documentos",[
            
            "documentos"=>$pagination['data'],
            "total"=>$pagination['total'],
            "search"=>$search,
            'profileMsg'=>usuario::getSuccess(),
            "pages"=>$pages,
            "values"=>$Documento->getValues()
        ]);

    });

//---------ROTA PARA ANEXAR ARQUIVO  - POST---------------------//

    $app->post("/admin/documento/anexar-arquivo/:id_documento", function ($id_documento) {

        $documento = new Documento();

        $documento  ->get((int)$id_documento);
    
        $documento  ->setData($_POST);
    
        $documento  ->moveArquivo();

        Usuario::setSuccess("Arquivo(s) Anexado(s) com Sucesso");

        header('Location: /admin/todos-documentos/arquivos/'.$id_documento);
        exit;

    });

//---------ROTA PARA A PÁGINA DOS ARQUIVOS DO Documento----------------------//

    $app->get('/admin/todos-documentos/arquivos/:id_documento', function($id_documento) {  


        Usuario::verificaLoginAdmin();

        $documento = new Documento();

        $page = new PageAdmin();

        $page->setTpl("admin-arquivos-documentos",[
            "id_documento"=>$documento->get((int)$id_documento),
            'arquivo'=>$documento->showArquivo($id_documento),
            "value"=>$documento->getValues(),
            'profileMsg'=>usuario::getSuccess()

        ]);

    });




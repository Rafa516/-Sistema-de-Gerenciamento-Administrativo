<?php

use \Projeto\Page;
use \Projeto\Model\Usuario;
use \Projeto\Model\Componente;
use \Projeto\Model\Beneficio;
use \Projeto\Model\Temporario;
use \Projeto\Model\Efetivo;
use \Projeto\Model\Itinerario;
use \Projeto\Model\Unidade;
        

//---------ROTA PARA DELETAR UM Beneficio ----------------------//

    $app->get("/usuario/beneficio/delete/:id_beneficio,:nome_user",function($id_beneficio,$nome_user){

        $beneficios = new Beneficio();
       
        $beneficios->get((int)$id_beneficio);

        $beneficios->historico_beneficio($nome_user);

        $beneficios->delete();

        header("Location: /usuario/todos-beneficios");
        exit;
    });


    //---------ROTA PARA DELETAR UM TRANSPORTE EFETIVO ----------------------//

    $app->get("/usuario/beneficio-transporte-efetivo/delete/:id_beneficio_efetivo,:nome_user",function($id_beneficio_efetivo,$nome_user){

        $beneficios = new Beneficio();
       
        $beneficios->getTransporteEfetivo((int)$id_beneficio_efetivo);
        
        $beneficios->historico_beneficio($nome_user);
     
        //$beneficios->deleteTransporteEfetivo();
       
        header("Location: /usuario/beneficio/transporte-efetivos");
        exit;
    });

     //---------ROTA PARA DELETAR UM TRANSPORTE EFETIVO VIGILANTES  ----------------------//

    $app->get("/usuario/beneficio-transporte-vigilantes/delete/:id_beneficio_efetivo,:nome_user",function($id_beneficio_efetivo,$nome_user){

        $beneficios = new Beneficio();
       
        $beneficios->getTransporteEfetivo((int)$id_beneficio_efetivo);

        $beneficios->historico_beneficio($nome_user);
     
        $beneficios->deleteTransporteEfetivo();
       
        header("Location: /usuario/beneficio/transporte-vigilantes");
        exit;
    });
    
    //---------ROTA PARA DELETAR UM REPAG EFETIVO  ----------------------//

    $app->get("/usuario/repag/delete/:id_repag_efetivo,:nome_user",function($id_repag_efetivo,$nome_user){

        $beneficios = new Beneficio();
       
        $beneficios->getRepag((int)$id_repag_efetivo);

        $beneficios->historico_repag_efetivos($nome_user);
     
        $beneficios->deleteRepag();
       
        //header("Location: /usuario/todos-beneficios");
        exit;
    });

    //---------ROTA PARA DELETAR UM REPAG TEMPORARIO  ----------------------//

    $app->get("/usuario/repag-temporario/delete/:id_repag_temporario,:nome_user",function($id_repag_temporario,$nome_user){

        $beneficios = new Beneficio();
       
        $beneficios->getRepagTemporario((int)$id_repag_temporario);

        $beneficios->historico_repag($nome_user);
     
        $beneficios->deleteRepagTemporario();
       
        //header("Location: /usuario/todos-beneficios");
        exit;
    });




//---------ROTA PARA REGISTRO DOS BeneficioS----------------------//

    $app->get('/usuario/registrar-beneficios', function() {  


        usuario::verificaLogin();

        $componentes = new Componente();

        $temporarios = new Temporario();

        $page = new Page();

        $page->setTpl("usuario-cadastro-beneficio",[
            'CallOpenMsg'=>usuario::getSuccess(),
            'errorRegister'=>usuario::getErrorRegister(),
            "componentes"=>$componentes->getComponentes(),
            "temporarios"=>$temporarios->getTemporariosCadastrados() 
            


        ]);

    });

 //---------ROTA PARA O FORMULÁRIO DOS EFETIVOS NAS MODAIS----------------------//


    $app->post("/usuario/registrar-efetivos-modal/enviar", function(){

        usuario::verificaLogin();

        $efetivo = new Efetivo();


        $efetivo->setData($_POST);


        $efetivo->registrarEfetivos();

        

        usuario::setSuccess("Efetivo registrado com sucesso!!");

        header("Location: /usuario/beneficio/transporte-efetivos");
        exit;


    });

//---------ROTA PARA O FORMULÁRIO DOS BeneficioS----------------------//


    $app->post("/usuario/registrar-beneficios/enviar", function(){

        usuario::verificaLogin();

        $beneficio = new Beneficio();

        $beneficio->setData($_POST);

        $beneficio->registrarBeneficios();


        usuario::setSuccess("Beneficio registrado com sucesso!!");

        header("Location: /usuario/beneficio/alimentacao");
        exit;


    });

    //---------ROTA PARA O FORMULÁRIO DO TRANSPORTE EETIVOS----------------------//


    $app->post("/usuario/registrar-transporte-efetivo/enviar", function(){

        usuario::verificaLogin();

        $beneficio = new Beneficio();

        $beneficio->setData($_POST);

        // var_dump($beneficio);
        // exit();

        $beneficio->registrarTransporteEfetivo();


        usuario::setSuccess("Beneficio registrado com sucesso!!");

        header("Location: /usuario/beneficio/transporte-efetivos");
        exit;


    });

    //---------ROTA PARA O FORMULÁRIO PARA CALCULO REPAG ----------------------//


    $app->post("/usuario/registrar-repag-transporte-efetivo/:id_beneficio_efetivo", function ($id_beneficio_efetivo) {
        
        usuario::verificaLogin();

        $beneficio = new Beneficio();
  

        $beneficio->setData($_POST);

         // var_dump($beneficio);
         // exit();

        $beneficio->registrarRepagEfetivo();


        //usuario::setSuccess("REPAG incluído com sucesso!!");

        header("Location: /usuario/transporte-efetivo-visualizar/".$id_beneficio_efetivo);
        exit;


    });

     //---------ROTA PARA ALTERAR FORMULÁRIO PARA CALCULO REPAG ----------------------//

    $app->post("/usuario/alterar-repag-transporte-efetivo-enviar/:id_repag_efetivo", function ($id_repag_efetivo) {
        
        usuario::verificaLogin();

        $beneficio = new Beneficio();


        $beneficio->getRepag((int) $id_repag_efetivo);

        $beneficio->setData($_POST);

        //  var_dump($beneficio);
        //  exit();

        $beneficio->alterarRepagEfetivo();


        usuario::setSuccess("Dados Alterados com sucesso!!");

        header("Location: /usuario/alterar-repag-transporte-efetivo/".$id_repag_efetivo);
        exit;


    });

    //---------ROTA PARA PAGINA DE ALTERAR  CALCULO REPAG ----------------------//
    $app->get("/usuario/alterar-repag-transporte-efetivo/:id_repag_efetivo", function ($id_repag_efetivo) {
        
        usuario::verificaLogin();

        $beneficio = new Beneficio();


        $beneficio->getRepag((int) $id_repag_efetivo);

        $page = new Page();
    
        $page ->setTpl("usuario-editar-repag-efetivo", array(
            "value"=>$beneficio->getValues(),
            'profileMsg' => usuario::getSuccess(),  
        ));


    });

     //---------ROTA PARA O FORMULÁRIO PARA CALCULO REPAG TEMPORARIO ----------------------//


     $app->post("/usuario/registrar-repag-transporte-temporario/:id_beneficio", function ($id_beneficio) {
        
        usuario::verificaLogin();

        $beneficio = new Beneficio();
  

        $beneficio->setData($_POST);

         // var_dump($beneficio);
         // exit();

        $beneficio->registrarRepagTemporario();


        usuario::setSuccess("REPAG incluído  com sucesso!!");

        header("Location: /usuario/beneficios-visualizar/".$id_beneficio);
        exit;


    });

    //---------ROTA PARA PAGINA DE ALTERAR  CALCULO REPAG TEMPORARIO ----------------------//
    $app->get("/usuario/alterar-repag-transporte-temporario/:id_repag_efetivo", function ($id_repag_temporario) {
        
        usuario::verificaLogin();

        $beneficio = new Beneficio();

        $itinerarios = new Itinerario();


        $beneficio->getRepagTemporario((int) $id_repag_temporario);

        $page = new Page();
    
        $page ->setTpl("usuario-editar-repag-temporario", array(
            "value"=>$beneficio->getValues(),
            'profileMsg' => usuario::getSuccess(),
            "itinerarios"=>$itinerarios->getItinerariosCadastrados(), 

        ));


    });

     //---------ROTA PARA ALTERAR FORMULÁRIO PARA CALCULO REPAG ----------------------//

     $app->post("/usuario/alterar-repag-transporte-temporario-enviar/:id_repag_efetivo", function ($id_repag_temporario) {
        
        usuario::verificaLogin();

        $beneficio = new Beneficio();


        $beneficio->getRepagTemporario((int) $id_repag_temporario);

        $beneficio->setData($_POST);

        //  var_dump($beneficio);
        //  exit();

        $beneficio->alterarRepagTemporario();


        usuario::setSuccess("REPAG Alterado  com sucesso!!");

        header("Location: /usuario/alterar-repag-transporte-temporario/".$id_repag_temporario);
        exit;


    });

//---------ROTA PARA EDITAR ALTERAÇÃO DOS BeneficioS----------------------//

    $app->get('/usuario/beneficio/editar/:id_beneficio', function($id_beneficio){
    
        Usuario::verificaLogin();
    
        $beneficio = new Beneficio();
    
        $beneficio->get((int)$id_beneficio);

        $componentes = new Componente();

        $temporarios = new Temporario();

        $page = new Page();
    
        $page ->setTpl("usuario-editar-beneficio", array(
            "value"=>$beneficio->getValues(),
            'CallOpenMsg'=>usuario::getSuccess(),
            'errorRegister'=>usuario::getErrorRegister(),
            "componentes"=>$componentes->getComponentes(),
            "temporarios"=>$temporarios->getTemporariosCadastrados()    
        ));
    
    });

 //---------ROTA PARA O ENVIO DO FORMULÁRIO DE EDIÇÃO DOS BENEFICIOS----------------------//

    $app->post("/usuario/beneficio/editar/:id_beneficio",function($id_beneficio){

        Usuario::verificaLogin();

        $beneficio = new Beneficio();


        $beneficio->get((int)$id_beneficio);
    
        $beneficio->setData($_POST);

       
        $beneficio->editarBeneficios();

        Usuario::setSuccess("Dados alterados com Sucesso");

        header("Location: /usuario/beneficios-visualizar/".$id_beneficio);
        exit;


    });

    //---------ROTA PARA A PÁGINA DE VISUALIZAÇÃO  DOS TRANSPORTES EFETIVIVOS---------------------//

$app->get('/usuario/transporte-efetivo-visualizar/:id_beneficio_efetivo', function ($id_beneficio_efetivo) {


    Usuario::verificaLogin();
    $efetivo = new Efetivo();
    $itinerarios = new Itinerario();
    $beneficio = new Beneficio();

    $repag = $beneficio->getRepagEfetivoIncluido((int) $id_beneficio_efetivo);
   
    $beneficio->getTransporteEfetivo((int) $id_beneficio_efetivo);



    $page = new Page();

    $page->setTpl("usuario-visualizar-transporte-efetivo", [
        'profileMsg' => usuario::getSuccess(),
        "value" => $beneficio->getValues(),
        "efetivos"=>$efetivo->getEfetivosCadastrados(),
        "itinerarios"=>$itinerarios->getItinerariosCadastrados(),
        "repags"=>$repag['data'],
    ]);
});


//---------ROTA PARA O ENVIO DO FORMULÁRIO DE EDIÇÃO DOS TRANSPORTES EFETIVIVOS----------------------//

$app->post("/usuario/transporte/editar/:id_beneficio_efetivo", function ($id_beneficio_efetivo) {

    Usuario::verificaLogin();

     $beneficio = new Beneficio();


    $beneficio->getTransporteEfetivo((int) $id_beneficio_efetivo);

    $beneficio->setData($_POST);

    $beneficio->alterarTransporteEfetivo();

    Usuario::setSuccess("Dados alterados com Sucesso");

    header("Location: /usuario/transporte-efetivo-visualizar/".$id_beneficio_efetivo);
    exit;


});


//---------ROTA PARA O ENVIO DA OBSERVAÇÃO DO TRANSPORTE ----------------------//

$app->post("/usuario/incluir-observacao/enviar/:id_beneficio_efetivo", function ($id_beneficio_efetivo) {

    Usuario::verificaLogin();

    $beneficio = new Beneficio();

    $beneficio->getTransporteEfetivo((int) $id_beneficio_efetivo);

    $beneficio->setData($_POST);

    // var_dump($beneficio);
    // exit;

    $beneficio->incluirObservacoes();

    Usuario::setSuccess("Dados alterados com Sucesso");

    header("Location: /usuario/transporte-efetivo-visualizar/".$id_beneficio_efetivo);
    exit;


});
    
    //---------ROTA PARA A PÁGINA DE VISUALIZAÇÃO  DOS BENEFICIOS ---------------------//

    $app->get('/usuario/beneficios-visualizar/:id_beneficios', function($id_beneficio) {  


        Usuario::verificaLogin();

        $beneficio = new  Beneficio();
   
       $itinerarios = new Itinerario();

       $repag = $beneficio->getRepagTemporarioIncluido((int) $id_beneficio);
   

        $beneficio->get((int)$id_beneficio);
       
        $page = new Page();

        $page->setTpl("usuario-visualizar-beneficios",[
            "value"=>$beneficio->getValues(),
            'CallOpenMsg'=>usuario::getSuccess(),
            'errorRegister'=>usuario::getErrorRegister(),
            "itinerarios"=>$itinerarios->getItinerariosCadastrados(),
            "repags"=>$repag['data'],
            
        ]);
    });


//---------ROTA PARA A PÁGINA DE TODOS BENEFICIOS DE ALIMENTAÇÃO ----------------------//
    $app->get('/usuario/beneficio/alimentacao', function() {  


        Usuario::verificaLogin();

        $usuario = Usuario::getFromSession();
        $beneficio = new Beneficio();


        $search = (isset($_GET['search'])) ? $_GET['search'] : "";
        $page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;

        if ($search != '') {

            $pagination = $beneficio->getPageSearchAlimentacao($search, $page);

        } else {

            $pagination = $beneficio->getPageAlimentacao($page);

        }

        $pages = [];

        for ($i=1; $i <= $pagination['pages']; $i++) { 
            array_push($pages, [
                'link'=>'/usuario/beneficio/alimentacao?page='.$i,
                'page'=>$i,
                'search'=>$search,
            ]);
        }

        $page = new Page();

        $page->setTpl("usuario-beneficio-alimentacao",[
            
            "beneficios"=>$pagination['data'],
            "total"=>$pagination['total'],
            "search"=>$search,
            'profileMsg'=>usuario::getSuccess(),
            "pages"=>$pages,
            "values"=>$beneficio->getValues()
        ]);

    });

    //---------ROTA PARA A PÁGINA DE TODOS BENEFICIOS DE TRANSPORTE ----------------------//
    $app->get('/usuario/beneficio/transporte', function() {  


        Usuario::verificaLogin();

        $usuario = Usuario::getFromSession();
        $beneficio = new Beneficio();


        $search = (isset($_GET['search'])) ? $_GET['search'] : "";
        $page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;

        if ($search != '') {

            $pagination = $beneficio->getPageSearchTransporte($search, $page);

        } else {

            $pagination = $beneficio->getPageTransporte($page);

        }

        $pages = [];

        for ($i=1; $i <= $pagination['pages']; $i++) { 
            array_push($pages, [
                'link'=>'/usuario/beneficio/transporte?page='.$i,
                'page'=>$i,
                'search'=>$search,
            ]);
        }

        $page = new Page();

        $page->setTpl("usuario-beneficio-transporte",[
            
            "beneficios"=>$pagination['data'],
            "total"=>$pagination['total'],
            "search"=>$search,
            'profileMsg'=>usuario::getSuccess(),
            "pages"=>$pages,
            "values"=>$beneficio->getValues()
        ]);

    });

    //---------ROTA PARA A PÁGINA DE TODOS BENEFICIOS DE TRANSPORTE EFETIVOS ----------------------//
    $app->get('/usuario/beneficio/transporte-efetivos', function() {  


        Usuario::verificaLogin();

        $usuario = Usuario::getFromSession();
        $beneficio = new Beneficio();
        $efetivo = new Efetivo();
        $itinerarios = new Itinerario();
        $unidades = new Unidade();



        $search = (isset($_GET['search'])) ? $_GET['search'] : "";
        $page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;

        if ($search != '') {

            $pagination = $beneficio->getPageSearchTransporteEfetivos($search, $page);

        } else {

            $pagination = $beneficio->getPageTransporteEfetivos($page);

        }

        $pages = [];

        for ($i=1; $i <= $pagination['pages']; $i++) { 
            array_push($pages, [
                'link'=>'/usuario/beneficio/transporte-efetivos?page='.$i,
                'page'=>$i,
                'search'=>$search,
            ]);
        }

        $page = new Page();

        $page->setTpl("usuario-beneficio-transporte-efetivos",[
            
            "beneficios"=>$pagination['data'],
            "total"=>$pagination['total'],
            "search"=>$search,
            'profileMsg'=>usuario::getSuccess(),
            "pages"=>$pages,
            "values"=>$beneficio->getValues(),
            "efetivos"=>$efetivo->getEfetivosCadastrados(),
            "itinerarios"=>$itinerarios->getItinerariosCadastrados(),
            'unidades'=>$unidades->getUnidades() 


        ]);

    });

       //---------ROTA PARA A PÁGINA DE TODOS BENEFICIOS DE TRANSPORTE EFETIVOS ----------------------//
    $app->get('/usuario/beneficio/transporte-vigilantes', function() {  


        Usuario::verificaLogin();

        $usuario = Usuario::getFromSession();
        $beneficio = new Beneficio();
        $efetivo = new Efetivo();
        $itinerarios = new Itinerario();
         $unidades = new Unidade();



        $search = (isset($_GET['search'])) ? $_GET['search'] : "";
        $page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;

        if ($search != '') {

            $pagination = $beneficio->getPageSearchTransporteVigilantes($search, $page);

        } else {

            $pagination = $beneficio->getPageTransporteVigilantes($page);

        }

        $pages = [];

        for ($i=1; $i <= $pagination['pages']; $i++) { 
            array_push($pages, [
                'link'=>'/usuario/beneficio/transporte-vigilantes?page='.$i,
                'page'=>$i,
                'search'=>$search,
            ]);
        }

        $page = new Page();

        $page->setTpl("usuario-beneficio-transporte-vigilantes",[
            
            "beneficios"=>$pagination['data'],
            "total"=>$pagination['total'],
            "search"=>$search,
            'profileMsg'=>usuario::getSuccess(),
            "pages"=>$pages,
            "values"=>$beneficio->getValues(),
            "efetivos"=>$efetivo->getEfetivosCadastrados(),
            "itinerarios"=>$itinerarios->getItinerariosCadastrados(),
            'unidades'=>$unidades->getUnidades() 


        ]);

    });






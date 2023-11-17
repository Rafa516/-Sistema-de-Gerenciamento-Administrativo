<?php

use \Projeto\PageAdmin;
use \Projeto\Model\Usuario;
use \Projeto\Model\Componente;
use \Projeto\Model\Beneficio;
use \Projeto\Model\Temporario;
use \Projeto\Model\Efetivo;
use \Projeto\Model\Itinerario;
use \Projeto\Model\Unidade;
        

//---------ROTA PARA DELETAR UM Beneficio ----------------------//

    $app->get("/admin/beneficio/delete/:id_beneficio,:nome_user",function($id_beneficio,$nome_user){

        $beneficios = new Beneficio();
       
        $beneficios->get((int)$id_beneficio);

        $beneficios->historico_beneficio($nome_user);
     
        $beneficios->delete();
       
        header("Location: /admin/todos-beneficios");
        exit;
    });

    //---------ROTA PARA DELETAR UM TRANSPORTE EFETIVO ----------------------//

    $app->get("/admin/beneficio-transporte-efetivo/delete/:id_beneficio_efetivo,:nome_user",function($id_beneficio_efetivo,$nome_user){

        $beneficios = new Beneficio();
       
        $beneficios->getTransporteEfetivo((int)$id_beneficio_efetivo);

        $beneficios->historico_beneficio($nome_user);
     
        $beneficios->deleteTransporteEfetivo();
       
        header("Location: /admin/beneficio/transporte-efetivos");
        exit;
    });

     //---------ROTA PARA DELETAR UM TRANSPORTE EFETIVO VIGILANTES  ----------------------//

    $app->get("/admin/beneficio-transporte-vigilantes/delete/:id_beneficio_efetivo,:nome_user",function($id_beneficio_efetivo,$nome_user){

        $beneficios = new Beneficio();
       
        $beneficios->getTransporteEfetivo((int)$id_beneficio_efetivo);

        $beneficios->historico_beneficio($nome_user);
     
        $beneficios->deleteTransporteEfetivo();
       
        header("Location: /admin/beneficio/transporte-vigilantes");
        exit;
    });
    
    //---------ROTA PARA DELETAR UM REPAG EFETIVO  ----------------------//

    $app->get("/admin/repag/delete/:id_repag_efetivo,:nome_user",function($id_repag_efetivo,$nome_user){

        $beneficios = new Beneficio();
       
        $beneficios->getRepag((int)$id_repag_efetivo);

        $beneficios->historico_repag_efetivos($nome_user);
     
     
        $beneficios->deleteRepag();
       
        //header("Location: /admin/todos-beneficios");
        exit;
    });

    //---------ROTA PARA DELETAR UM REPAG TEMPORARIO  ----------------------//

    $app->get("/admin/repag-temporario/delete/:id_repag_temporario,:nome_user",function($id_repag_temporario,$nome_user){

        $beneficios = new Beneficio();
       
        $beneficios->getRepagTemporario((int)$id_repag_temporario);

        $beneficios->historico_repag($nome_user);
     
        $beneficios->deleteRepagTemporario();
       
        //header("Location: /admin/todos-beneficios");
        exit;
    });




//---------ROTA PARA REGISTRO DOS BeneficioS----------------------//

    $app->get('/admin/registrar-beneficios', function() {  


       usuario::verificaLoginAdmin();

        $componentes = new Componente();

        $temporarios = new Temporario();

        $page = new PageAdmin();

        $page->setTpl("admin-cadastro-beneficio",[
            'CallOpenMsg'=>usuario::getSuccess(),
            'errorRegister'=>usuario::getErrorRegister(),
            "componentes"=>$componentes->getComponentes(),
            "temporarios"=>$temporarios->getTemporariosCadastrados() 
            


        ]);

    });

 //---------ROTA PARA O FORMULÁRIO DOS EFETIVOS NAS MODAIS----------------------//


    $app->post("/admin/registrar-efetivos-modal/enviar", function(){

       usuario::verificaLoginAdmin();

        $efetivo = new Efetivo();


        $efetivo->setData($_POST);


        $efetivo->registrarEfetivos();

        

        usuario::setSuccess("Efetivo registrado com sucesso!!");

        header("Location: /admin/beneficio/transporte-efetivos");
        exit;


    });

//---------ROTA PARA O FORMULÁRIO DOS BeneficioS----------------------//


    $app->post("/admin/registrar-beneficios/enviar", function(){

       usuario::verificaLoginAdmin();

        $beneficio = new Beneficio();

        $beneficio->setData($_POST);

        $beneficio->registrarBeneficios();


        usuario::setSuccess("Beneficio registrado com sucesso!!");

        header("Location: /admin/beneficio/alimentacao");
        exit;


    });

    //---------ROTA PARA O FORMULÁRIO DO TRANSPORTE EETIVOS----------------------//


    $app->post("/admin/registrar-transporte-efetivo/enviar", function(){

       usuario::verificaLoginAdmin();

        $beneficio = new Beneficio();

        $beneficio->setData($_POST);

        // var_dump($beneficio);
        // exit();

        $beneficio->registrarTransporteEfetivo();


        usuario::setSuccess("Beneficio registrado com sucesso!!");

        header("Location: /admin/beneficio/transporte-efetivos");
        exit;


    });

    //---------ROTA PARA O FORMULÁRIO PARA CALCULO REPAG ----------------------//


    $app->post("/admin/registrar-repag-transporte-efetivo/:id_beneficio_efetivo", function ($id_beneficio_efetivo) {
        
       usuario::verificaLoginAdmin();

        $beneficio = new Beneficio();
  

        $beneficio->setData($_POST);

         // var_dump($beneficio);
         // exit();

        $beneficio->registrarRepagEfetivo();


        usuario::setSuccess("REPAG incluído com sucesso!!");

        header("Location: /admin/transporte-efetivo-visualizar/".$id_beneficio_efetivo);
        exit;


    });

     //---------ROTA PARA ALTERAR FORMULÁRIO PARA CALCULO REPAG ----------------------//

    $app->post("/admin/alterar-repag-transporte-efetivo-enviar/:id_repag_efetivo", function ($id_repag_efetivo) {
        
       usuario::verificaLoginAdmin();

        $beneficio = new Beneficio();


        $beneficio->getRepag((int) $id_repag_efetivo);

        $beneficio->setData($_POST);

        //  var_dump($beneficio);
        //  exit();

        $beneficio->alterarRepagEfetivo();


        usuario::setSuccess("REPAG Alterado  com sucesso!!");

        header("Location: /admin/alterar-repag-transporte-efetivo/".$id_repag_efetivo);
        exit;


    });

    //---------ROTA PARA PAGINA DE ALTERAR  CALCULO REPAG ----------------------//
    $app->get("/admin/alterar-repag-transporte-efetivo/:id_repag_efetivo", function ($id_repag_efetivo) {
        
       usuario::verificaLoginAdmin();

        $beneficio = new Beneficio();


        $beneficio->getRepag((int) $id_repag_efetivo);

        $page = new PageAdmin();
    
        $page ->setTpl("admin-editar-repag-efetivo", array(
            "value"=>$beneficio->getValues(),
            'profileMsg' => usuario::getSuccess(),  
        ));


    });

     //---------ROTA PARA O FORMULÁRIO PARA CALCULO REPAG TEMPORARIO ----------------------//


     $app->post("/admin/registrar-repag-transporte-temporario/:id_beneficio", function ($id_beneficio) {
        
       usuario::verificaLoginAdmin();

        $beneficio = new Beneficio();
  

        $beneficio->setData($_POST);

         // var_dump($beneficio);
         // exit();

        $beneficio->registrarRepagTemporario();


        usuario::setSuccess("REPAG incluído  com sucesso!!");

        header("Location: /admin/beneficios-visualizar/".$id_beneficio);
        exit;


    });

    //---------ROTA PARA PAGINA DE ALTERAR  CALCULO REPAG TEMPORARIO ----------------------//
    $app->get("/admin/alterar-repag-transporte-temporario/:id_repag_efetivo", function ($id_repag_temporario) {
        
       usuario::verificaLoginAdmin();

        $beneficio = new Beneficio();

        $itinerarios = new Itinerario();


        $beneficio->getRepagTemporario((int) $id_repag_temporario);

        $page = new PageAdmin();
    
        $page ->setTpl("admin-editar-repag-temporario", array(
            "value"=>$beneficio->getValues(),
            'profileMsg' => usuario::getSuccess(),
            "itinerarios"=>$itinerarios->getItinerariosCadastrados(), 

        ));


    });

     //---------ROTA PARA ALTERAR FORMULÁRIO PARA CALCULO REPAG ----------------------//

     $app->post("/admin/alterar-repag-transporte-temporario-enviar/:id_repag_efetivo", function ($id_repag_temporario) {
        
       usuario::verificaLoginAdmin();

        $beneficio = new Beneficio();


        $beneficio->getRepagTemporario((int) $id_repag_temporario);

        $beneficio->setData($_POST);

        //  var_dump($beneficio);
        //  exit();

        $beneficio->alterarRepagTemporario();


        usuario::setSuccess("REPAG Alterado  com sucesso!!");

        header("Location: /admin/alterar-repag-transporte-temporario/".$id_repag_temporario);
        exit;


    });

//---------ROTA PARA EDITAR ALTERAÇÃO DOS BeneficioS----------------------//

    $app->get('/admin/beneficio/editar/:id_beneficio', function($id_beneficio){
    
       usuario::verificaLoginAdmin();
    
        $beneficio = new Beneficio();
    
        $beneficio->get((int)$id_beneficio);

        $componentes = new Componente();

        $temporarios = new Temporario();

        $page = new PageAdmin();
    
        $page ->setTpl("admin-editar-beneficio", array(
            "value"=>$beneficio->getValues(),
            'CallOpenMsg'=>usuario::getSuccess(),
            'errorRegister'=>usuario::getErrorRegister(),
            "componentes"=>$componentes->getComponentes(),
            "temporarios"=>$temporarios->getTemporariosCadastrados()    
        ));
    
    });

 //---------ROTA PARA O ENVIO DO FORMULÁRIO DE EDIÇÃO DOS BENEFICIOS----------------------//

    $app->post("/admin/beneficio/editar/:id_beneficio",function($id_beneficio){

       usuario::verificaLoginAdmin();

        $beneficio = new Beneficio();


        $beneficio->get((int)$id_beneficio);
    
        $beneficio->setData($_POST);

       
        $beneficio->editarBeneficios();

        Usuario::setSuccess("Dados alterados com Sucesso");

        header("Location: /admin/beneficios-visualizar/".$id_beneficio);
        exit;


    });

    //---------ROTA PARA A PÁGINA DE VISUALIZAÇÃO  DOS TRANSPORTES EFETIVIVOS---------------------//

$app->get('/admin/transporte-efetivo-visualizar/:id_beneficio_efetivo', function ($id_beneficio_efetivo) {


   usuario::verificaLoginAdmin();
    $efetivo = new Efetivo();
    $itinerarios = new Itinerario();
    $beneficio = new Beneficio();

    $repag = $beneficio->getRepagEfetivoIncluido((int) $id_beneficio_efetivo);
   
    $beneficio->getTransporteEfetivo((int) $id_beneficio_efetivo);



    $page = new PageAdmin();

    $page->setTpl("admin-visualizar-transporte-efetivo", [
        'profileMsg' => usuario::getSuccess(),
        "value" => $beneficio->getValues(),
        "efetivos"=>$efetivo->getEfetivosCadastrados(),
        "itinerarios"=>$itinerarios->getItinerariosCadastrados(),
        "repags"=>$repag['data'],
    ]);
});


//---------ROTA PARA O ENVIO DO FORMULÁRIO DE EDIÇÃO DOS TRANSPORTES EFETIVIVOS----------------------//

$app->post("/admin/transporte/editar/:id_beneficio_efetivo", function ($id_beneficio_efetivo) {

   usuario::verificaLoginAdmin();

     $beneficio = new Beneficio();


    $beneficio->getTransporteEfetivo((int) $id_beneficio_efetivo);

    $beneficio->setData($_POST);

    $beneficio->alterarTransporteEfetivo();

    Usuario::setSuccess("Dados alterados com Sucesso");

    header("Location: /admin/transporte-efetivo-visualizar/".$id_beneficio_efetivo);
    exit;


});


//---------ROTA PARA O ENVIO DA OBSERVAÇÃO DO TRANSPORTE ----------------------//

$app->post("/admin/incluir-observacao-transporte/enviar/:id_beneficio_efetivo", function ($id_beneficio_efetivo) {

   usuario::verificaLoginAdmin();

    $beneficio = new Beneficio();

    $beneficio->getTransporteEfetivo((int) $id_beneficio_efetivo);

    $beneficio->setData($_POST);

    // var_dump($beneficio);
    // exit;

   $beneficio->incluirObservacoes();

    Usuario::setSuccess("Dados alterados com Sucesso");

    header("Location: /admin/transporte-efetivo-visualizar/".$id_beneficio_efetivo);
    exit;


});
    
    //---------ROTA PARA A PÁGINA DE VISUALIZAÇÃO  DOS BENEFICIOS ---------------------//

    $app->get('/admin/beneficios-visualizar/:id_beneficios', function($id_beneficio) {  


       usuario::verificaLoginAdmin();

        $beneficio = new  Beneficio();
   
       $itinerarios = new Itinerario();

       $repag = $beneficio->getRepagTemporarioIncluido((int) $id_beneficio);
   

        $beneficio->get((int)$id_beneficio);
       
        $page = new PageAdmin();

        $page->setTpl("admin-visualizar-beneficios",[
            "value"=>$beneficio->getValues(),
            'CallOpenMsg'=>usuario::getSuccess(),
            'errorRegister'=>usuario::getErrorRegister(),
            "itinerarios"=>$itinerarios->getItinerariosCadastrados(),
            "repags"=>$repag['data'],
            
        ]);
    });


//---------ROTA PARA A PÁGINA DE TODOS BENEFICIOS DE ALIMENTAÇÃO ----------------------//
    $app->get('/admin/beneficio/alimentacao', function() {  


       usuario::verificaLoginAdmin();

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
                'link'=>'/admin/beneficio/alimentacao?page='.$i,
                'page'=>$i,
                'search'=>$search,
            ]);
        }

        $page = new PageAdmin();

        $page->setTpl("admin-beneficio-alimentacao",[
            
            "beneficios"=>$pagination['data'],
            "total"=>$pagination['total'],
            "search"=>$search,
            'profileMsg'=>usuario::getSuccess(),
            "pages"=>$pages,
            "values"=>$beneficio->getValues()
        ]);

    });

    //---------ROTA PARA A PÁGINA DE TODOS BENEFICIOS DE TRANSPORTE ----------------------//
    $app->get('/admin/beneficio/transporte', function() {  


       usuario::verificaLoginAdmin();

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
                'link'=>'/admin/beneficio/transporte?page='.$i,
                'page'=>$i,
                'search'=>$search,
            ]);
        }

        $page = new PageAdmin();

        $page->setTpl("admin-beneficio-transporte",[
            
            "beneficios"=>$pagination['data'],
            "total"=>$pagination['total'],
            "search"=>$search,
            'profileMsg'=>usuario::getSuccess(),
            "pages"=>$pages,
            "values"=>$beneficio->getValues()
        ]);

    });

    //---------ROTA PARA A PÁGINA DE TODOS BENEFICIOS DE TRANSPORTE EFETIVOS ----------------------//
    $app->get('/admin/beneficio/transporte-efetivos', function() {  


       usuario::verificaLoginAdmin();

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
                'link'=>'/admin/beneficio/transporte-efetivos?page='.$i,
                'page'=>$i,
                'search'=>$search,
            ]);
        }

        $page = new PageAdmin();

        $page->setTpl("admin-beneficio-transporte-efetivos",[
            
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
    $app->get('/admin/beneficio/transporte-vigilantes', function() {  


       usuario::verificaLoginAdmin();

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
                'link'=>'/admin/beneficio/transporte-vigilantes?page='.$i,
                'page'=>$i,
                'search'=>$search,
            ]);
        }

        $page = new PageAdmin();

        $page->setTpl("admin-beneficio-transporte-vigilantes",[
            
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






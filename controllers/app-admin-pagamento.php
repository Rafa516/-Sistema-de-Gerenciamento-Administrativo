<?php

use \Projeto\PageAdmin;
use \Projeto\Model\Usuario;
use \Projeto\Model\Pagamento;
use \Projeto\Model\Temporario;
use \Projeto\Model\Componente;
use \Projeto\Model\HorasPagas;


//---------ROTA PARA DELETAR UM Pagamento ----------------------//

$app->get("/admin/pagamentos/delete/:id_pagamento", function ($id_pagamento) {

    $pagamentos = new Pagamento();

    $pagamentos->get((int) $id_pagamento);

    $pagamentos->deletePagamento();

    header("Location: /admin/pagamentos-temporarios");
    exit;
});


//---------ROTA PARA DELETAR UM Pagamento ----------------------//

$app->get("/admin/grade/delete/:id_grade", function ($id_grade) {

    $pagamentos = new Pagamento();

    $pagamentos->getGrade((int) $id_grade);

    $pagamentos->deleteGrade();

    header("Location: /admin/pagamentos-temporarios");
    exit;
});



//---------ROTA PARA A ABERTURA DOS PagamentoS----------------------//

$app->get('/admin/registrar-pagamentos', function () {


    Usuario::verificaLoginAdmin();

    $page = new PageAdmin();

    $page->setTpl("admin-abertura-pagamentos", [
        'CallOpenMsg' => usuario::getSuccess(),
        'errorRegister' => usuario::getErrorRegister(),



    ]);

});

//---------ROTA PARA O FORMULÁRIO DOS PagamentoS----------------------//


$app->post("/admin/registrar-pagamentos/enviar", function () {

    Usuario::verificaLoginAdmin();

    $pagamento = new Pagamento();


    $pagamento->setData($_POST);

    //  var_dump($pagamento);
    //  exit;

    $pagamento->registrarPagamentos();

    usuario::setSuccess("Cáculos de Pagamento registrado com sucesso!!");

    header("Location: /admin/pagamentos-temporarios");
    exit;


});


//---------ROTA PARA O FORMULÁRIO Das GRADES----------------------//


$app->post("/admin/registrar-grade/enviar", function () {

    Usuario::verificaLoginAdmin();

    $pagamento = new Pagamento();


    $pagamento->setData($_POST);

    // var_dump($pagamento);
    // exit;


    $pagamento->registrarGrades();



    usuario::setSuccess("Grade registrada com sucesso!!");

    header("Location: /admin/pagamentos-temporarios");
    exit;


});



//---------ROTA PARA A PÁGINA DE VISUALIZAÇÃO  DOS PAGAMENTOS---------------------//

$app->get('/admin/pagamento-visualizar/:id_pagamento', function ($id_pagamento) {


    Usuario::verificaLoginAdmin();

    $pagamento = new Pagamento();
    $temporarios = new Temporario();
    $horas_pagas = new HorasPagas();

    $pagamento->get((int) $id_pagamento);

    $page = new PageAdmin();

    $page->setTpl("admin-visualizar-pagamento", [
        'profileMsg' => usuario::getSuccess(),
        "value" => $pagamento->getValues(),
        "temporarios" => $temporarios->getTemporariosCadastrados(),
        "grades" => $pagamento->getGradesCadastradas(),
        "horasPagas" => $horas_pagas->getHorasPagasCadastradas()
    ]);
});

///---------ROTA PARA PAGINA DE ALTERAÇÃO DAS HORAS PAGAS----------------------//

$app->get('/admin/horas_pagas/editar/:id_horas_pagas', function($id_horas_pagas){
    
    Usuario::verificaLoginAdmin();

    $horas_pagas = new HorasPagas();

    $horas_pagas->get((int)$id_horas_pagas);

    $page = new PageAdmin();

    $page ->setTpl("admin-editar-horas-pagas", array(
        "value"=>$horas_pagas->getValues(),
        'CallOpenMsg'=>Usuario::getSuccess(),
        'errorRegister'=>Usuario::getErrorRegister(),
    ));

});

//---------ROTA PARA ALTERAR DADOS DAS HORAS PAGAS----------------------//

$app->post("/admin/horas_pagas/enviar/:id_horas_pagas", function ($id_horas_pagas) {

    Usuario::verificaLoginAdmin();

    $horas_pagas = new HorasPagas();

    $horas_pagas->get((int)$id_horas_pagas);

    $horas_pagas->setData($_POST);

    $horas_pagas->editarHorasPagas();

    Usuario::setSuccess("Dados das Horas Pagas alterados com Sucesso");

    header("Location: /admin/pagamentos-temporarios");
    exit;


});


//---------ROTA PARA O ENVIO DO FORMULÁRIO DE EDIÇÃO DOS PagamentoS----------------------//

$app->post("/admin/Pagamento/editar/:id_pagamento", function ($id_pagamento) {

    Usuario::verificaLoginAdmin();

    $pagamento = new Pagamento();


    $pagamento->get((int) $id_pagamento);

    $pagamento->setData($_POST);

    $pagamento->editarPagamentos();

    Usuario::setSuccess("Dados alterados com Sucesso");

    header("Location: /admin/pagamento-visualizar/".$id_pagamento);
    exit;


});

//---------ROTA PARA O ENVIO DA OBSERVAÇÃO DO PAGAMENTO----------------------//

$app->post("/admin/incluir-observacao/enviar/:id_pagamento", function ($id_pagamento) {

    Usuario::verificaLoginAdmin();

    $pagamento = new Pagamento();

    $pagamento->get((int) $id_pagamento);

    $pagamento->setData($_POST);

    // var_dump($pagamento);
    // exit;

    $pagamento->incluirObservacoes();

    Usuario::setSuccess("Dados alterados com Sucesso");

    header("Location: /admin/pagamento-visualizar/".$id_pagamento);
    exit;


});


//---------ROTA PARA A PÁGINA DE TODOS OS PagamentoS ----------------------//
$app->get('/admin/pagamentos-temporarios', function () {


    Usuario::verificaLoginAdmin();

    $usuario = Usuario::getFromSession();
    $pagamento = new Pagamento();
    $temporarios = new Temporario();
    $horas_pagas = new HorasPagas();
    $componentes = new Componente();

    $search = (isset($_GET['search'])) ? $_GET['search'] : "";
    $page = (isset($_GET['page'])) ? (int) $_GET['page'] : 1;

    if ($search != '') {

        $pagination = $pagamento->getPageSearchPagamentoTemporario($search, $page);

    } else {

        $pagination = $pagamento->getPagePagamentoTemporario($page);

    }

    $pages = [];

    for ($i = 1; $i <= $pagination['pages']; $i++) {
        array_push($pages, [
            'link' => '/admin/pagamentos-temporarios?page=' . $i,
            'page' => $i,
            'search' => $search,
        ]);
    }

    $page = new PageAdmin();

    $page->setTpl("admin-todos-pagamentos-temporarios", [

        "pagamentos" => $pagination['data'],
        "total" => $pagination['total'],
        "search" => $search,
        'profileMsg' => usuario::getSuccess(),
        "pages" => $pages,
        "values" => $pagamento->getValues(),
        "temporarios" => $temporarios->getTemporariosCadastrados(),
        "grades" => $pagamento->getGradesCadastradas(),
        "horasPagas" => $horas_pagas->getHorasPagasCadastradas(),
        "componentes"=>$componentes->getComponentes()
    ]);

});
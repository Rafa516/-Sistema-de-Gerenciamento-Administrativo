<?php

use \Projeto\PageAdmin;
use \Projeto\Model\Usuario;
use \Projeto\Model\Anotacao;

//---------ROTA PARA DELETAR UMA ANOTACAO ----------------------//

$app->get("/admin/anotacoes/delete/:id_anotacao,:nome_user", function ($id_anotacao,$nome_user) {

    $anotacao = new Anotacao();

    $anotacao->get((int) $id_anotacao);

    $anotacao->historico_anotacoes($nome_user);

    $anotacao->delete($id_anotacao);

    header("Location: /admin/todas-anotacoes");
    exit;
});




//--------- PÁGINA REGISTRAR ANOTACAO----------------------//

$app->get('/admin/registrar-anotacoes', function () {


    Usuario::verificaLoginAdmin();

    $anotacao = new Anotacao();

    $page = new PageAdmin();

    $page->setTpl("admin-registro-anotacoes", [
        'CallOpenMsg' => Usuario::getSuccess(),
        'errorRegister' => Usuario::getErrorRegister(),

    ]);

});
//---------POST REGISTRAR ANOTACAO----------------------//

$app->post("/admin/registrar-anotacoes/enviar", function () {

    Usuario::verificaLoginAdmin();

    $anotacao = new Anotacao();

    $anotacao->setData($_POST);

    $anotacao->registrarAnotacao();

    Usuario::setSuccess("Anotações registradas com sucesso!!");

    header("Location: /admin/todas-anotacoes");
    exit;


});


//---------ROTA PARA VIZUALIZAR DAS ANOTACAOS----------------------//

$app->get('/admin/anotacao-visualizar/:id_anotacao', function ($id_anotacao) {

    Usuario::verificaLoginAdmin();

    $anotacao = new Anotacao();

    $anotacao->get((int) $id_anotacao);

    $page = new PageAdmin();

    $page->setTpl(
        "admin-anotacao-visualizar",
        array(
            "value" => $anotacao->getValues()
        )
    );

});

//---------ROTA PARA ALTERAR DAS ANOTACAOS----------------------//

$app->get('/admin/anotacao-editar/:id_anotacao', function ($id_anotacao) {

    Usuario::verificaLoginAdmin();

    $anotacao = new Anotacao();

    $anotacao->get((int) $id_anotacao);

    $page = new PageAdmin();

    $page->setTpl(
        "admin-anotacao-editar",
        array(
            "value" => $anotacao->getValues(),
            'CallOpenMsg' => Usuario::getSuccess(),
            'errorRegister' => Usuario::getErrorRegister(),
        )
    );

});


//---------ROTA PARA O ENVIO DO FORMULÁRIO DE EDIÇÃO DAS ANOTACAOS----------------------//

$app->post("/admin/anotacao/editar/:id_anotacao", function ($id_anotacao) {

    Usuario::verificaLoginAdmin();

    $anotacao = new Anotacao();

    $anotacao->get((int) $id_anotacao);

    $anotacao->setData($_POST);

    $anotacao->editarAnotacoes();

    Usuario::setSuccess("Dados alterados com Sucesso");

    header("Location: /admin/todas-anotacoes");
    exit;


});

//---------ROTA PARA A PÁGINA DOS TERMOS DO USUÁRIO----------------------//
$app->get('/admin/todas-anotacoes', function () {


    Usuario::verificaLoginAdmin();


    $admin = new Anotacao();


    $search = (isset($_GET['search'])) ? $_GET['search'] : "";
    $page = (isset($_GET['page'])) ? (int) $_GET['page'] : 1;

    if ($search != '') {

        $pagination = $admin->getSearchTodasAnotacoes($search, $page);

    } else {

        $pagination = $admin->getTodasAnotacoes($page);

    }

    $pages = [];

    for ($i = 1; $i <= $pagination['pages']; $i++) {
        array_push($pages, [
            'link' => '/admin/todas-anotacoes?page=' . $i,
            'page' => $i,
            'search' => $search,
        ]);
    }

    $page = new PageAdmin();

    $page->setTpl("admin-todas-anotacoes", [

        "anotacoes" => $pagination['data'],
        "search" => $search,
        'profileMsg' => Usuario::getSuccess(),
        "pages" => $pages,
        'total_anotacoes' => (int) $pagination['total']
    ]);

});

<?php

use \Projeto\PageAdmin;
use \Projeto\Model\Usuario;
use \Projeto\Model\Componente;

//---------ROTA PARA DELETAR UMA UNIDADE ----------------------//

$app->get("/admin/componente/delete/:id_componente",function($id_componente){

    $componente = new Componente();
    
    $componente->get((int)$id_componente);

    $componente->deleteComponente($id_componente);

    header("Location: /admin/dados-componentes");
    exit;
});


//---------ROTA PARA PAGINA DE CADASTRO DE UMA UNIDADE----------------------//


$app->post("/admin/cadastrar-componente/registro", function(){

	Usuario::verificaLoginAdmin();

	$componente = new Componente();

	$componente->setData($_POST);

    var_dump($componente);


	$componente->incluirComponentes();

	//Usuario::setSuccess("Local registrado com sucesso!!");

	header("Location: /admin/utilidades");
	exit;


});

  //---------ROTA PARA O ENVIO DO FORMULÁRIO DE ALTERAÇÃO DOS DADOS DA UNIDADE----------------------//

    $app->post("/admin/componente/editar/:id_componente",function($id_componente){

        
            $componente = new Componente();

            $componente->get((int)$id_componente);

            $componente->setData($_POST);
            
            $componente->alterarUnidades();


            Usuario::setSuccess("Dados alterados com Sucesso");

            header("Location: /admin/componente/informacoes/".$id_componente);
            exit;


        });  



?>
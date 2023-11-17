
<?php

use \Projeto\Model\Usuario;
use \Projeto\Model\Componente;

//---------ROTA PARA DELETAR UMA UNIDADE ----------------------//

$app->get("/usuario/componente/delete/:id_componente",function($id_componente){

    $componente = new Componente();
    
    $componente->get((int)$id_componente);

    $componente->deleteComponente($id_componente);

    header("Location: /usuario/dados-componentes");
    exit;
});


//---------ROTA PARA PAGINA DE CADASTRO DE UMA UNIDADE----------------------//


$app->post("/usuario/cadastrar-componente/registro", function(){

	Usuario::verificaLogin();

	$componente = new Componente();

	$componente->setData($_POST);

    var_dump($componente);


	$componente->incluirComponentes();

	//Usuario::setSuccess("Local registrado com sucesso!!");

	header("Location: /usuario/utilidades");
	exit;


});

  //---------ROTA PARA O ENVIO DO FORMULÁRIO DE ALTERAÇÃO DOS DADOS DA UNIDADE----------------------//

    $app->post("/usuario/componente/editar/:id_componente",function($id_componente){

        
            $componente = new Componente();

            $componente->get((int)$id_componente);

            $componente->setData($_POST);
            
            $componente->alterarUnidades();


            Usuario::setSuccess("Dados alterados com Sucesso");

            header("Location: /usuario/componente/informacoes/".$id_componente);
            exit;


        });  



?>
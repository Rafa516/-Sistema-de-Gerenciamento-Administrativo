
<?php

use \Projeto\Model\Usuario;
use \Projeto\Model\Cidade;

//---------ROTA PARA DELETAR UMA UNIDADE ----------------------//

$app->get("/usuario/cidade/delete/:id_cidade",function($id_cidade){

    $cidade = new Cidade();
    
    $cidade->get((int)$id_cidade);

    $cidade->deleteCidade($id_cidade);

    header("Location: /usuario/dados-cidades");
    exit;
});


//---------ROTA PARA PAGINA DE CADASTRO DE UMA UNIDADE----------------------//


$app->post("/usuario/cadastrar-cidade/registro", function(){

	Usuario::verificaLogin();

	$cidade = new Cidade();

	$cidade->setData($_POST);

    var_dump($cidade);


	$cidade->incluirCidades();

	//Usuario::setSuccess("Local registrado com sucesso!!");

	header("Location: /usuario/utilidades");
	exit;


});

  //---------ROTA PARA O ENVIO DO FORMULÁRIO DE ALTERAÇÃO DOS DADOS DA UNIDADE----------------------//

    $app->post("/usuario/cidade/editar/:id_cidade",function($id_cidade){

        
            $cidade = new Cidade();

            $cidade->get((int)$id_cidade);

            $cidade->setData($_POST);
            
            $cidade->alterarUnidades();


            Usuario::setSuccess("Dados alterados com Sucesso");

            header("Location: /usuario/cidade/informacoes/".$id_cidade);
            exit;


        });  



?>
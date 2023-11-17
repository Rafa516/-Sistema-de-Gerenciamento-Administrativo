<?php 
session_start();

//dependências
require_once("models/autoload.php");

//name space

$app = new \Slim\Slim(); 

$app->config('debug', true);

require_once("controllers/app-usuario.php");
require_once("controllers/app-admin.php");
require_once("controllers/app-admin-documento.php");
require_once("controllers/app-admin-informacao.php");
require_once("controllers/app-admin-unidade.php");
require_once("controllers/app-admin-itinerario.php");
require_once("controllers/app-admin-efetivo.php");
require_once("controllers/app-admin-pagamento.php");
require_once("controllers/app-admin-componente.php");
require_once("controllers/app-admin-linha.php");
require_once("controllers/app-admin-beneficio.php");
require_once("controllers/app-admin-temporario.php");
require_once("controllers/app-admin-avaliacao.php");
require_once("controllers/app-admin-dossie.php");
require_once("controllers/app-admin-anotacao.php");
require_once("controllers/app-beneficio.php");
require_once("controllers/app-documento.php");
require_once("controllers/app-componente.php");
require_once("controllers/app-dossie.php");
require_once("controllers/app-efetivo.php");
require_once("controllers/app-cidade.php");
require_once("controllers/app-pagamento.php");
require_once("controllers/app-temporario.php");
require_once("controllers/app-linha.php");
require_once("controllers/app-itinerario.php");
require_once("controllers/app-anotacao.php");
require_once("controllers/app-avaliacao.php");
require_once("controllers/app-informacao.php");
require_once("controllers/app-unidade.php");
require_once("controllers/funcoes.php");


$app->run();

 ?>
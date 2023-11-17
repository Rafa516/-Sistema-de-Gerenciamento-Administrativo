<?php

use \Projeto\Model\Usuario;
use \Projeto\Model\Documento;
use \Projeto\Model\Linha;
use \Projeto\Model\Unidade;
use \Projeto\Model\Dossie;
use \Projeto\Model\Beneficio;
use \Projeto\Model\Cidade;



function formatDate($data)
{

	return date('d/m/Y' , strtotime($data));

}

function formatDateHoras($data)
{

	return date('d/m/Y H:i:s' , strtotime($data));

}

function formatValor($valor)
{
	return str_replace(['.', ','], ',', $valor);
}


function getUsuarioNome()
{

	$res = Usuario::getFromSession();

	$usuario = $res->getnome_user();

	return utf8_decode($usuario);

}

function totalUsuarios()
{

	$total = Usuario::total();

	return $total['totalUsuarios'];

}

function adminTotal()
{

	$total = Usuario::totalAdmin();

	return $total['adminTotal'];

}

function totalUsuariosComuns()
{

	$total = Usuario::totalUsuariosComuns();

	return $total['totalUsuariosComuns'];

}

//----------------TOTAL DE DOCUMENTOS -------------------------//
function totalDocumentos()
{

	$total = Documento::totalDocumentos();


	return $total['documentosTotal'];

}

function totalcidades()
{

	$total = Cidade::totalCidades();


	return $total['cidadesTotal'];

}


function numArquivosDocumentos($id_documento)
{

	$total = Documento::numArquivosDocumentos($id_documento);

	return $total['arquivos'];

}

//----------------DOSSIE -------------------------//
function numArquivosDossiers($id_dossie)
{

	$total = Dossie::numArquivosDossiers($id_dossie);

	return $total['arquivos'];

}

//----------------BENEFICIO REPAG EFETIVOS -------------------------//
function numRepags($id_beneficio_efetivo)
{

	$total = Beneficio::numRepags($id_beneficio_efetivo);

	return $total['repags'];

}

function numRepagsTemporarios($id_beneficio)
{

	$total = Beneficio::numRepagsTemporarios($id_beneficio);

	return $total['repags'];

}

//----------------LINHAS-------------------------//
function totalItens()
{

	$total = Linha::getPageLinha();


	return $total['total'];

}



function nomeFotos($id_unidade){

	$total = Unidade::nomeFotos($id_unidade);

	   return  $total['nome'];
}

function numFotos($id_unidade){

	$total = Unidade::numFotos($id_unidade);

	   return  $total['fotos'];

}

function totalUnidades(){

	$total = Unidade::totalUnidades();


   return  $total['unidadesTotal'];

}

function totalInfantil()
{

	$total = Unidade::totalInfantil();

	return $total['totalInfantil'];

}

function totalInfantilFundamental()
{

	$total = Unidade::totalInfantilFundamental();

	return $total['totalInfantilFundamental'];

}

function totalFundamental()
{

	$total = Unidade::totalFundamental();

	return $total['totalFundamental'];

}

function totalFundamentalMedio()
{

	$total = Unidade::totalFundamentalMedio();

	return $total['totalFundamentalMedio'];

}

function totalMedio()
{

	$total = Unidade::totalMedio();

	return $total['totalMedio'];

}


function totalDiretores()
{

	$total = Unidade::totalDiretores();

	return $total['totalDiretores'];

}

function totalViceDiretores()
{

	$total = Unidade::totalViceDiretores();

	return $total['totalViceDiretores'];

}

function totalChefeSecretaria()
{

	$total = Unidade::totalChefeSecretaria();

	return $total['totalChefeSecretaria'];

}

function totalSupervisores()
{

	$total = Unidade::totalSupervisores();

	return $total['totalSupervisores'];

}

function totalCoordenadores()
{

	$total = Unidade::totalCoordenadores();

	return $total['totalCoordenadores'];

}





?>
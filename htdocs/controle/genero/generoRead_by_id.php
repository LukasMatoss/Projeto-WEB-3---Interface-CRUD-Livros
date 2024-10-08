<?php

require_once ("modelo/Banco.php");
require_once ("modelo/Genero.php");

$objResposta = new stdClass();
$objGenero = new Genero();
$objGenero->setidGenero($idGenero);

$vetor = $objGenero->readByID();

$objResposta->cod = 1;
$objResposta->status = true;
$objResposta->msg = "executado com sucesso";
$objResposta->Genero = $vetor;

header("HTTP/1.1 200");
header("Content-Type: application/json");
echo json_encode($objResposta);

?>

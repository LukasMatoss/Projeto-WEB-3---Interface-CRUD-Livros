<?php
require_once ("modelo/Banco.php");
require_once ("modelo/Autor.php");

$objResposta = new stdClass();

$objAutor = new Autor();
$objAutor->setidAutores($idAutor);

$vetor = $objAutor->readByID();

$objResposta->cod = 1;
$objResposta->status = true;
$objResposta->msg = "executado com sucesso";
$objResposta->Autor = $vetor;

header("HTTP/1.1 200");
header("Content-Type: application/json");
echo json_encode($objResposta);
?>

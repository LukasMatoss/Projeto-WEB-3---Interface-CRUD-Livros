<?php
require_once ("modelo/Banco.php");
require_once ("modelo/Livro.php");

$objResposta = new stdClass();
$objLivro = new Livro();

$vetor = $objLivro->readAll();

$objResposta->cod = 1;
$objResposta->status = true;
$objResposta->msg = "executado com sucesso";
$objResposta->livros = $vetor;

header("HTTP/1.1 200");
header("Content-Type: application/json");
echo json_encode($objResposta);
?>

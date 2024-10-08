<?php
require_once ("modelo/Livro.php");


$objResposta = new stdClass();
$objLivro = new Livro();


$idLivro = isset($_GET['idLivros']) ? intval($_GET['idLivros']) : 0;

if ($idLivro <= 0) {
    $objResposta->status = false;
    $objResposta->cod = 1;
    $objResposta->msg = "ID do livro inválido";
    header("HTTP/1.1 400 Bad Request");
    header("Content-Type: application/json");
    echo json_encode($objResposta);
    exit();
}

// Defina o ID do livro para o objeto Livro
$objLivro->setidlivros($idLivro);

// Tente excluir o livro
if ($objLivro->delete() == true) {
    header("HTTP/1.1 204 No Content");
} else {
    header("HTTP/1.1 500 Internal Server Error");
    header("Content-Type: application/json");
    $objResposta->status = false;
    $objResposta->cod = 2;
    $objResposta->msg = "Erro ao excluir livro";
    echo json_encode($objResposta);
}
?>

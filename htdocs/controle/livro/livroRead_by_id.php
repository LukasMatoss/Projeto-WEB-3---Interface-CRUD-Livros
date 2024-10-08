<?php
require_once ("modelo/Banco.php");
require_once ("modelo/Livro.php");

// Crie um objeto Livro
$objResposta = new stdClass();
$objLivro = new Livro();

// Supondo que $idLivros é passado como um parâmetro GET ou POST
// Você deve garantir que $idLivros esteja definido e sanitizado
$idLivros = isset($_GET['idLivros']) ? intval($_GET['idLivros']) : 0;

if ($idLivros <= 0) {
    $objResposta->status = false;
    $objResposta->cod = 1;
    $objResposta->msg = "ID do livro inválido";
    header("HTTP/1.1 400 Bad Request");
    header("Content-Type: application/json");
    echo json_encode($objResposta);
    exit();
}

// Defina o ID do livro para o objeto Livro
$objLivro->setidlivros($idLivros);

// Tente ler o livro
$vetor = $objLivro->readByID();

$objResposta->cod = 1;
$objResposta->status = true;
$objResposta->msg = "executado com sucesso";
$objResposta->livros = $vetor;

header("HTTP/1.1 200 OK");
header("Content-Type: application/json");
echo json_encode($objResposta);
?>

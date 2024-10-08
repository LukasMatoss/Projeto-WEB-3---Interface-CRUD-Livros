<?php
require_once ("modelo/Banco.php");
require_once ("modelo/Livro.php");

$textoRecebido = file_get_contents("php://input");
$objJson = json_decode($textoRecebido) or die('{"msg":"formato incorreto"}');

$objResposta = new stdClass();
$objLivro = new Livro();

$objLivro->setSerieLivro($objJson->livros->serieLivro);
$objLivro->setQtdPaginas($objJson->livros->qtdPaginas);
$objLivro->setTitulo($objJson->livros->titulo);

if ($objLivro->getSerieLivro() == "") {
    $objResposta->cod = 1;
    $objResposta->status = false;
    $objResposta->msg = "a serie nao pode ser vazia";
} 
if ($objLivro->getQtdPaginas() == "") {
    $objResposta->cod = 1;
    $objResposta->status = false;
    $objResposta->msg = "a quantidade de paginas nao pode ser vazia";
} 
if ($objLivro->getTitulo() == "") {
    $objResposta->cod = 1;
    $objResposta->status = false;
    $objResposta->msg = "o titulo nao pode ser vazio";
} 

if (strlen($objLivro->getSerieLivro()) != 2) {  
    $objResposta->cod = 1;
    $objResposta->status = false;
    $objResposta->msg = "A serieLivro deve conter 2 caracteres";
} 
else if ($objLivro->isLivro() == true) {
    $objResposta->cod = 3;
    $objResposta->status = false;
    $objResposta->msg = "Ja existe um livro cadastrado com a serieLivro: " . $objLivro->getSerieLivro();
} 
else {
    if ($objLivro->create() == true) {
        $objResposta->cod = 4;
        $objResposta->status = true;
        $objResposta->msg = "cadastrado com sucesso";
        $objResposta->novoLivro = $objLivro;
    } else {
        $objResposta->cod = 5;
        $objResposta->status = false;
        $objResposta->msg = "Erro ao cadastrar novo livro";
    }
}

header("Content-Type: application/json");

if ($objResposta->status == true) {
    header("HTTP/1.1 201");
} else {
    header("HTTP/1.1 200");
}

echo json_encode($objResposta);
?>

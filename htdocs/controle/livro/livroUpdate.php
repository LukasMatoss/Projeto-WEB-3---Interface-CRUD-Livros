<?php
require_once ("modelo/Banco.php");
require_once ("modelo/Livro.php");

$textoRecebido = file_get_contents("php://input");
$objJson = json_decode($textoRecebido) or die('{"msg":"formato incorreto"}');

$objResposta = new stdClass();
$objLivro = new Livro();
$objLivro->setidLivro($idLivro);
$objLivro->setserieLivro($objJson->livros->serieLivro);
$objLivro->setqtdPaginas($objJson->livros->qtdPaginas);
$objLivro->setautor($objJson->livros->autor);

if ($objLivro->getserieLivro() == "") {
    $objResposta->cod = 1;
    $objResposta->status = false;
    $objResposta->msg = "a serie nao pode ser vazia";
}

if (strlen($objLivro->getserieLivro()) != 2) {  
    $objResposta->cod = 1;
    $objResposta->status = false;
    $objResposta->msg = "A serieLivro deve conter 2 caracteres";
} 

else if ($objLivro->isLivro() == true) {
    $objResposta->cod = 3;
    $objResposta->status = false;
    $objResposta->msg = "Ja existe um livro cadastrado com a serieLivro: " . $objLivro->getserieLivro();
} 
else {
    if ($objLivro->update() == true) {
        $objResposta->cod = 4;
        $objResposta->status = true;
        $objResposta->msg = "Atualizada com sucesso";
        $objResposta->livroAtualizado = $objLivro;
    } 
    else {
        $objResposta->cod = 5;
        $objResposta->status = false;
        $objResposta->msg = "Erro ao atualizar o livro";
    }
}

header("HTTP/1.1 200");
header("Content-Type: application/json");
echo json_encode($objResposta);
?>

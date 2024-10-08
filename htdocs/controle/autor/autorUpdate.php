<?php

require_once ("modelo/Banco.php");
require_once ("modelo/Autor.php");

$textoRecebido = file_get_contents("php://input");
$objJson = json_decode($textoRecebido) or die('{"msg":"formato incorreto"}');

$objResposta = new stdClass();
$objAutor = new Autor();

$objAutor->setidAutor($idAutor);
$objAutor->setemailAutor($objJson->Autor->email);
$objAutor->setnomeAutor($objJson->Autor->nomeAutor);
$objAutor->setsenhaAutor($objJson->Autor->senhaAutor);

if ($objAutor->getnomeAutor() == "") {
    $objResposta->cod = 1;
    $objResposta->status = false;
    $objResposta->msg = "o nome do autor não pode ser vazio";
} 
elseif ($objAutor->getemailAutor() == "") {
    $objResposta->cod = 1;
    $objResposta->status = false;
    $objResposta->msg = "o email do autor não pode ser vazio";
}
elseif ($objAutor->getsenhaAutor() == "") {
    $objResposta->cod = 1;
    $objResposta->status = false;
    $objResposta->msg = "a senha do autor não pode ser vazia";
}
else if ($objAutor->isAutor() == true) {
    $objResposta->cod = 3;
    $objResposta->status = false;
    $objResposta->msg = "Já existe um autor cadastrado com o nome: " . $objAutor->getnomeAutor();
} 
else {
    if ($objAutor->update() == true) {
        $objResposta->cod = 4;
        $objResposta->status = true;
        $objResposta->msg = "Atualizado com sucesso";
        $objResposta->autorAtualizado = $objAutor;
    } 
    else {
        $objResposta->cod = 5;
        $objResposta->status = false;
        $objResposta->msg = "Erro ao atualizar o autor";
    }
}
header("HTTP/1.1 200");
header("Content-Type: application/json");
echo json_encode($objResposta);
?>

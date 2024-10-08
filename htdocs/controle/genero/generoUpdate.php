<?php

require_once ("modelo/Banco.php");
require_once ("modelo/Genero.php");

$textoRecebido = file_get_contents("php://input");
$objJson = json_decode($textoRecebido) or die('{"msg":"formato incorreto"}');

$objResposta = new stdClass();
$objGenero = new Genero();
$objGenero->setidGenero($idGenero);
$objGenero->setnomeGenero($objJson->generos->nomeGenero);
$objGenero->setDescricaoGenero($objJson->generos->descricaoGenero);

if ($objGenero->getnomeGenero() == "") {
    $objResposta->cod = 1;
    $objResposta->status = false;
    $objResposta->msg = "o nome nao pode ser vazio";
} 

else if ($objGenero->isGenero() == true) {
    $objResposta->cod = 3;
    $objResposta->status = false;
    $objResposta->msg = "Ja existe um genero cadastrado com o nome: " . $objGenero->getnomeGenero();
} 

else {
    if ($objGenero->update() == true) {
        $objResposta->cod = 4;
        $objResposta->status = true;
        $objResposta->msg = "Atualizado com sucesso";
        $objResposta->generoAtualizado = $objGenero;
    } 
    else {
        $objResposta->cod = 5;
        $objResposta->status = false;
        $objResposta->msg = "Erro ao atualizar o genero";
    }
}

header("HTTP/1.1 200");
header("Content-Type: application/json");
echo json_encode($objResposta);

?>

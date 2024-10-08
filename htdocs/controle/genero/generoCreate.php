<?php

require_once ("modelo/Banco.php");
require_once ("modelo/Genero.php");

$textoRecebido = file_get_contents("php://input");
$objJson = json_decode($textoRecebido);

$objResposta = new stdClass();

if ($objJson === null || !isset($objJson->generos)) {
    $objResposta->cod = 1;
    $objResposta->status = false;
    $objResposta->msg = "formato incorreto ou dados incompletos";
    echo json_encode($objResposta);
    exit;
}

$objGenero = new Genero();

if (isset($objJson->generos->nomeGenero)) {
    $objGenero->setnomeGenero($objJson->generos->nomeGenero);
}

if (isset($objJson->generos->descricaoGenero)) {
    $objGenero->setdescricaoGenero($objJson->generos->descricaoGenero);
}

if ($objGenero->getnomeGenero() == "") {
    $objResposta->cod = 1;
    $objResposta->status = false;
    $objResposta->msg = "o nome do gênero não pode ser vazio";
} 
else if ($objGenero->isGenero() == true) {
    $objResposta->cod = 3;
    $objResposta->status = false;
    $objResposta->msg = "Já existe um gênero cadastrado com o nome: " . $objGenero->getnomeGenero();
} 
else {
    if ($objGenero->create() == true) {
        $objResposta->cod = 4;
        $objResposta->status = true;
        $objResposta->msg = "cadastrado com sucesso";
        $objResposta->novoGenero = $objGenero;
    } 
    else {
        $objResposta->cod = 5;
        $objResposta->status = false;
        $objResposta->msg = "Erro ao cadastrar novo gênero";
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

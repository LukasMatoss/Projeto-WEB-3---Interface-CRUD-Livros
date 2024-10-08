<?php

require_once ("modelo/Genero.php");

$objResposta = new stdClass();
$objGenero = new Genero();
$objGenero->setidGenero($idGenero);

if ($objGenero->delete() == true) {
    header("HTTP/1.1 204");
} else {
    header("HTTP/1.1 200");
    header("Content-Type: application/json");
    $objResposta->status = false;
    $objResposta->cod = 1;
    $objResposta->msg = "Erro ao excluir Gênero";
    echo json_encode($objResposta);
}

?>

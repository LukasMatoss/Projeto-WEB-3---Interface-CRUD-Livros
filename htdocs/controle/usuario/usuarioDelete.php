<?php
require_once ("modelo/Usuario.php"); // Supondo que o modelo de usuário esteja em Usuario.php

$objResposta = new stdClass();
$objUsuario = new Usuario();

$idUsuario = isset($_GET['idUsuario']) ? intval($_GET['idUsuario']) : 0;

if ($idUsuario <= 0) {
    $objResposta->status = false;
    $objResposta->cod = 1;
    $objResposta->msg = "ID do usuário inválido";
    header("HTTP/1.1 400 Bad Request");
    header("Content-Type: application/json");
    echo json_encode($objResposta);
    exit();
}

// Defina o ID do usuário para o objeto Usuario
$objUsuario->setidUsuario($idUsuario);

// Tente excluir o usuário
if ($objUsuario->delete() == true) {
    header("HTTP/1.1 204 No Content");
} else {
    header("HTTP/1.1 500 Internal Server Error");
    header("Content-Type: application/json");
    $objResposta->status = false;
    $objResposta->cod = 2;
    $objResposta->msg = "Erro ao excluir usuário";
    echo json_encode($objResposta);
}
?>

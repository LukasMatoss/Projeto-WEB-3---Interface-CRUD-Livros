<?php
require_once ("modelo/Banco.php");
require_once ("modelo/Usuario.php"); // Supondo que o modelo de usuário esteja em Usuario.php

$objResposta = new stdClass();
$objUsuario = new Usuario();

$vetor = $objUsuario->readAll(); // Chama o método readAll do modelo Usuario

$objResposta->cod = 1;
$objResposta->status = true;
$objResposta->msg = "executado com sucesso";
$objResposta->usuarios = $vetor; // Atualiza o campo para 'usuarios'

header("HTTP/1.1 200");
header("Content-Type: application/json");
echo json_encode($objResposta);
?>
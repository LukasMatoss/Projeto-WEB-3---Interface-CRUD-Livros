<?php
require_once ("modelo/Banco.php");
require_once ("modelo/Usuario.php");

// Crie um objeto Usuario
$objResposta = new stdClass();
$objUsuario = new Usuario();

// Supondo que $idUsuario é passado como um parâmetro GET ou POST
// Você deve garantir que $idUsuario esteja definido e sanitizado
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

// Tente ler o usuário
$vetor = $objUsuario->readByID();

$objResposta->cod = 1;
$objResposta->status = true;
$objResposta->msg = "executado com sucesso";
$objResposta->usuarios = $vetor;

header("HTTP/1.1 200 OK");
header("Content-Type: application/json");
echo json_encode($objResposta);
?>

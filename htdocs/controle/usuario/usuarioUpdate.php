<?php
require_once ("modelo/Banco.php");
require_once ("modelo/Usuario.php");

// Crie um objeto Usuario
$objResposta = new stdClass();
$objUsuario = new Usuario();

// Receba o JSON da requisição
$textoRecebido = file_get_contents("php://input");
$objJson = json_decode($textoRecebido) or die('{"msg":"formato incorreto"}');

// Defina as propriedades do objeto Usuario com base no JSON recebido
$objUsuario->setidUsuario(isset($objJson->idUsuario) ? intval($objJson->idUsuario) : 0);
$objUsuario->setnomeUsuario(isset($objJson->nomeUsuario) ? $objJson->nomeUsuario : '');
$objUsuario->setemailUsuario(isset($objJson->emailUsuario) ? $objJson->emailUsuario : '');
$objUsuario->setsenhaUsuario(isset($objJson->senhaUsuario) ? $objJson->senhaUsuario : '');

// Valide se todos os campos necessários foram preenchidos
if ($objUsuario->getidUsuario() <= 0) {
    $objResposta->status = false;
    $objResposta->cod = 1;
    $objResposta->msg = "ID do usuário inválido";
} elseif ($objUsuario->getnomeUsuario() == "") {
    $objResposta->status = false;
    $objResposta->cod = 2;
    $objResposta->msg = "O nome do usuário não pode ser vazio";
} elseif ($objUsuario->getemailUsuario() == "") {
    $objResposta->status = false;
    $objResposta->cod = 3;
    $objResposta->msg = "O email do usuário não pode ser vazio";
} elseif ($objUsuario->getsenhaUsuario() == "") {
    $objResposta->status = false;
    $objResposta->cod = 4;
    $objResposta->msg = "A senha do usuário não pode ser vazia";
} else {
    // Tente atualizar o usuário
    if ($objUsuario->update() == true) {
        $objResposta->status = true;
        $objResposta->cod = 5;
        $objResposta->msg = "Usuário atualizado com sucesso";
        $objResposta->usuario = $objUsuario;
    } else {
        $objResposta->status = false;
        $objResposta->cod = 6;
        $objResposta->msg = "Erro ao atualizar usuário";
    }
}

// Defina os cabeçalhos HTTP e retorne a resposta JSON
header("Content-Type: application/json");

if ($objResposta->status == true) {
    header("HTTP/1.1 200 OK");
} else {
    header("HTTP/1.1 400 Bad Request");
}

echo json_encode($objResposta);
?>

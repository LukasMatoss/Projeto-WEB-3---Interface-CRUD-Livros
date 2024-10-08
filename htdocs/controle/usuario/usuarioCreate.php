<?php
require_once("modelo/Banco.php");
require_once("modelo/Usuario.php"); // Supondo que você terá uma classe Usuario similar à classe Livro

$textoRecebido = file_get_contents("php://input");
$objJson = json_decode($textoRecebido) or die('{"msg":"formato incorreto"}');

$objResposta = new stdClass();
$objUsuario = new Usuario();

// Corrigindo o acesso às propriedades do JSON
$objUsuario->setNomeUsuario($objJson->nomeUsuario);
$objUsuario->setEmailUsuario($objJson->emailUsuario);
$objUsuario->setSenhaUsuario($objJson->senhaUsuario);

if ($objUsuario->getNomeUsuario() == "") {
    $objResposta->cod = 1;
    $objResposta->status = false;
    $objResposta->msg = "o nome do usuário não pode ser vazio";
} 
if ($objUsuario->getEmailUsuario() == "") {
    $objResposta->cod = 1;
    $objResposta->status = false;
    $objResposta->msg = "o email do usuário não pode ser vazio";
} 
if ($objUsuario->getSenhaUsuario() == "") {
    $objResposta->cod = 1;
    $objResposta->status = false;
    $objResposta->msg = "a senha do usuário não pode ser vazia";
} 

// Verifica se o email já está cadastrado
// Parece que a função isUsuario não está definida. Verifique se a classe Usuario possui um método para isso.
if ($objUsuario->isUsuario()) {
    $objResposta->cod = 3;
    $objResposta->status = false;
    $objResposta->msg = "Já existe um usuário cadastrado com o email: " . $objUsuario->getEmailUsuario();
} 
else {
    if ($objUsuario->create()) {
        $objResposta->cod = 4;
        $objResposta->status = true;
        $objResposta->msg = "cadastrado com sucesso";
        $objResposta->novoUsuario = $objUsuario;
    } else {
        $objResposta->cod = 5;
        $objResposta->status = false;
        $objResposta->msg = "Erro ao cadastrar novo usuário";
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

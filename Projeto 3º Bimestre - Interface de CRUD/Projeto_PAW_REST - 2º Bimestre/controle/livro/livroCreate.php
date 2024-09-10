<?php
require_once "modelo/livro.php";

$jsonRecebido = file_get_contents('php://input');
$obj = json_decode($jsonRecebido);

$livro = new Partida();
$livro->setIdTime1($obj->id_livro);
$livro->setIdTime2($obj->id_time2);
$livro->setPlacar($obj->placar);

if ($partida->create()) {
    header('HTTP/1.1 201 Created');
    echo json_encode(["message" => "Partida criada com sucesso!"]);
} else {
    header('HTTP/1.1 500 Internal Server Error');
    echo json_encode(["message" => "Erro ao criar partida."]);
}
?>
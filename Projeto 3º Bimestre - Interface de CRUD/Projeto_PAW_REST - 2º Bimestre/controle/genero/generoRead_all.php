<?php
    require_once "modelo/genero.php";

    $genero = new genero();
    $resultado = $genero->readAll();

    if ($resultado) {
        header('HTTP/1.1 200 OK');
        echo json_encode($resultado);
    } else {
        header('HTTP/1.1 404 Not Found');
        echo json_encode(["message" => "Nenhum gênero encontrado"]);
    }
?>
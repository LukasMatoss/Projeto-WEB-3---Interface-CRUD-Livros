<?php
    require_once "modelo/autor.php";

    $autor = new autor();
    $resultado = $autor->readAll();

    if ($resultado) {
        header('HTTP/1.1 200 OK');
        echo json_encode($resultado);
    } else {
        header('HTTP/1.1 404 Not Found');
        echo json_encode(["message" => "Nenhum autor encontrado"]);
    }
?>
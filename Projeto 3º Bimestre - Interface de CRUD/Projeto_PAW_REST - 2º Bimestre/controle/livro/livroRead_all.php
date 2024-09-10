<?php
    require_once "modelo/livro.php";

    $livro = new livro();
    $resultado = $livro->readAll();

    if ($resultado) {
        header('HTTP/1.1 200 OK');
        echo json_encode($resultado);
    } else {
        header('HTTP/1.1 404 Not Found');
        echo json_encode(["message" => "Nenhum livro encontrado"]);
    }
?>

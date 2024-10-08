<?php
require_once ("modelo/Autor.php");
$objResposta = new stdClass();
$objAutor = new Autor();
$objAutor->setidAutores($idAutor);
if($objAutor->delete() == true){
    header("HTTP/1.1 204");
}else{
    header("HTTP/1.1 200");
    header("Content-Type: application/json");
    $objResposta->status = false;
    $objResposta->cod = 1;
    $objResposta->msg = "Erro ao excluir Autor";
    echo json_encode($objResposta);
}
?>

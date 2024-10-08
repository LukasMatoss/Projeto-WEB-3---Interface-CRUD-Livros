<?php
    
    require_once ("modelo/Banco.php");
    require_once ("modelo/Autor.php");

    $textoRecebido = file_get_contents("php://input");
    $objJson = json_decode($textoRecebido) or die('{"msg":"formato incorreto"}');

    $objResposta = new stdClass();
    $objAutor = new Autor();

    $objAutor->setemailAutor($objJson->Autor->emailAutor);
    $objAutor->setnomeAutor($objJson->Autor->nomeAutor);
    $objAutor->setsenhaAutor($objJson->Autor->senhaAutor);

    if ($objAutor->getnomeAutor() == "") {
        $objResposta->cod = 1;
        $objResposta->status = false;
        $objResposta->msg = "o nome do autor nao pode ser vazio";
    } 
    elseif ($objAutor->getemailAutor() == "") {
        $objResposta->cod = 1;
        $objResposta->status = false;
        $objResposta->msg = "o email do autor nao pode ser vazio";
    }
    elseif ($objAutor->getsenhaAutor() == "") {
        $objResposta->cod = 1;
        $objResposta->status = false;
        $objResposta->msg = "a senha do autor nao pode ser vazia";
    }
    else if ($objAutor->isAutor() == true) {
        $objResposta->cod = 3;
        $objResposta->status = false;
        $objResposta->msg = "Ja existe um Autor cadastrado com o nome: " . $objAutor->getnomeAutor();
    } 
    else {
        if ($objAutor->create() == true) {
            $objResposta->cod = 4;
            $objResposta->status = true;
            $objResposta->msg = "cadastrado com sucesso";
            $objResposta->novoAutor = $objAutor;
        } 
        else {
            $objResposta->cod = 5;
            $objResposta->status = false;
            $objResposta->msg = "Erro ao cadastrar novo Autor";
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

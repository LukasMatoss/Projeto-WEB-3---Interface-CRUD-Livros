<?php

require_once "modelo/router.php";

$router = new Router();

$router->get('/livro/', function () {
    require_once "controle/livro/livroRead_all.php";
});

$router->get('/autor/', function () {
    require_once "controle/autor/autorRead_all.php";
});

$router->get('/genero/', function () {
    require_once "controle/genero/generoRead_all.php";
});


$router->run();
?>
<?php

require_once "modelo/router.php";

$router = new Router();

//roteamento da classe livro

$router->get('/livro', function () {   
    require_once "controle/livro/livroRead_all.php";
});

$router->get('/livro/(\d+)', function ($idLivro) {  
    require_once "controle/livro/livroRead_by_id.php";
});

$router->post('/livro', function () {   
    require_once "controle/livro/livroCreate.php";
});

$router->put('/livro/(\d+)', function ($idLivro) {  
    require_once "controle/livro/livroUpdate.php";
});

$router->delete('/livro/(\d+)', function ($idLivro) {  
    require_once "controle/livro/livroDelete.php";
});


//roteamento da classe autor

$router->get('/autor', function () {   
    require_once "controle/autor/autorRead_all.php";
});

$router->get('/autor/(\d+)', function ($idLivro) {  
    require_once "controle/autor/autorRead_by_id.php";
});

$router->post('/autor', function () {   
    require_once "controle/autor/autorCreate.php";
});

$router->put('/autor/(\d+)', function ($idLivro) {  
    require_once "controle/autor/autorUpdate.php";
});

$router->delete('/autor/(\d+)', function ($idLivro) {  
    require_once "controle/autor/autorDelete.php";
});

//roteamento da classe genero

$router->get('/genero', function () {   
    require_once "controle/genero/generoRead_all.php";
});

$router->get('/genero/(\d+)', function ($idLivro) {  
    require_once "controle/genero/generoRead_by_id.php";
});

$router->post('/genero', function () {   
    require_once "controle/genero/generoCreate.php";
});

$router->put('/genero/(\d+)', function ($idLivro) {  
    require_once "controle/genero/generoUpdate.php";
});

$router->delete('/genero/(\d+)', function ($idLivro) {  
    require_once "controle/genero/generoDelete.php";
});

$router->run();
?>
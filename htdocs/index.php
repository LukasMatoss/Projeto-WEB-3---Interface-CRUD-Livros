<?php

require_once "modelo/router.php";

$router = new Router();

// Roteamento da classe Livro
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

// Roteamento da classe Autor
$router->get('/autor', function () {   
    require_once "controle/autor/autorRead_all.php";
});

$router->get('/autor/(\d+)', function ($idAutor) {  
    require_once "controle/autor/autorRead_by_id.php";
});

$router->post('/autor', function () {   
    require_once "controle/autor/autorCreate.php";
});

$router->put('/autor/(\d+)', function ($idAutor) {  
    require_once "controle/autor/autorUpdate.php";
});

$router->delete('/autor/(\d+)', function ($idAutor) {  
    require_once "controle/autor/autorDelete.php";
});

// Roteamento da classe Genero
$router->get('/genero', function () {   
    require_once "controle/genero/generoRead_all.php";
});

$router->get('/genero/(\d+)', function ($idGenero) {  
    require_once "controle/genero/generoRead_by_id.php";
});

$router->post('/genero', function () {   
    require_once "controle/genero/generoCreate.php";
});

$router->put('/genero/(\d+)', function ($idGenero) {  
    require_once "controle/genero/generoUpdate.php";
});

$router->delete('/genero/(\d+)', function ($idGenero) {  
    require_once "controle/genero/generoDelete.php";
});

// Roteamento da classe Usuario
$router->get('/usuario', function () {   
    require_once "controle/usuario/usuarioRead_all.php";
});

$router->get('/usuario/(\d+)', function ($idUsuario) {  
    require_once "controle/usuario/usuarioRead_all.php";
});

$router->post('/usuario', function () {   
    require_once "controle/usuario/usuarioCreate.php";
});

$router->put('/usuario/(\d+)', function ($idUsuario) {  
    require_once "controle/usuario/usuarioUpdate.php";
});

$router->delete('/usuario/(\d+)', function ($idUsuario) {  
    require_once "controle/usuario/usuarioDelete.php";
});

$router->run();
?>

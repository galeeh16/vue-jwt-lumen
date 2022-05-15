<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->post('/login', 'AuthController@login');
$router->group(['middleware' => 'cek_jwt'], function () use ($router) {
    $router->post('/profile', 'AuthController@profile');
});

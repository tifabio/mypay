<?php

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->post('/transfer', '\App\Http\Controllers\TransfersController@save');
    $router->delete('/transfer/{id}', '\App\Http\Controllers\TransfersController@cancel');
});
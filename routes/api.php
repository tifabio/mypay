<?php

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->post('/transfer', ['as' => 'transfer.create', 'uses' => '\App\Http\Controllers\TransfersController@create']);
});
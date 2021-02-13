<?php

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->post('/transfer', ['as' => 'transfer.save', 'uses' => '\App\Http\Controllers\TransfersController@save']);
    $router->delete('/transfer/{id}', ['as' => 'transfer.cancel', 'uses' =>'\App\Http\Controllers\TransfersController@cancel']);
});
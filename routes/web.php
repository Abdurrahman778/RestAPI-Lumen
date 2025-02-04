<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->post('/login', 'UserController@login');


$router->group(['middleware' => 'auth'], function () use ($router) {
    $router->group(['prefix' => 'stuffs'], function () use ($router) {
        $router->get('/', 'StuffController@index');
        $router->post('/', 'StuffController@store');
        $router->get('/trash', 'StuffController@trash');
        $router->patch('/{id}', 'StuffController@update');
        $router->delete('/{id}', 'StuffController@delete');
        $router->get('/{id}', 'StuffController@show');
        $router->get('trash/restore/{id}', 'StuffController@restore');
        $router->delete('trash/delete-permanent/{id}', 'StuffController@deletePermanent');
    });
    $router->group(['prefix' => 'users'], function () use ($router) {
        $router->get('/', 'UserController@index');
        $router->post('/', 'UserController@store');
        $router->get('/me', 'UserController@me');
    });

    $router->group(['prefix' => 'inbound-stuffs'], function() use ($router){
        $router->post('/', 'InboundStuffController@store');
    });

    $router->get('/logout', 'UserController@logout');
});


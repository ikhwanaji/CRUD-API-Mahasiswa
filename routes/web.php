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

$router->group(['prefix'=>'mahasiswa'], function ($router){
    $router->get('/','MahasiswaController@index');
    $router->get('/{id}','MahasiswaController@show');
    $router->post('/', 'MahasiswaController@store');
    $router->delete('/{id}','MahasiswaController@destroy');
    $router->put('/{id}','MahasiswaController@update');
});

$router->get('/migration','migrationcontroller@index');
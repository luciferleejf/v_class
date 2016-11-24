<?php
/**
 * 接口
 */
$router->group(['prefix' => 'data'], function($router){


    $router->get('index','DataController@index');


});


$router->resource('data', 'DataController');
<?php
/**
 *  课程路由
 */
$router->group(['prefix' => 'classCate'], function($router){
    $router->get('sort', 'ClassCateController@sort');
    $router->get('/', 'ClassCateController@index');

});

$router->resource('classCate', 'ClassCateController');
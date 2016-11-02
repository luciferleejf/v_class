<?php
/**
 * 菜单路由
 */
$router->group(['prefix' => 'class'], function($router){
    $router->get('/article', 'ClassController@articleList');
    $router->get('/cate', 'ClassController@cateList');
});

$router->resource('class', 'ClassController');
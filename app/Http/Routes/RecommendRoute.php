<?php
/**
 *  顾问路由
 */
$router->group(['prefix' => 'recommend'], function($router){


    $router->get('ajaxIndex', 'RecommendController@ajaxIndex');
    $router->get('create', 'RecommendController@create');
    $router->get('edit', 'RecommendController@edit');
    $router->get('show', 'RecommendController@show');


    $router->get('index', 'RecommendController@index');

});


$router->resource('recommend', 'RecommendController');


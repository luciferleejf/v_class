<?php
/**
 *  顾问路由
 */
$router->group(['prefix' => 'api'], function($router){
    $router->get('ajaxIndex', 'ApiController@ajaxIndex');
	$router->get('/', 'ApiController@index');

});

$router->resource('api', 'ApiController');
<?php
/**
 * 接口
 */
$router->group(['prefix' => 'client'], function($router){

	$router->get('checkLogin','ClientController@checkLogin');
    $router->get('register','ClientController@register');
});



$router->resource('client', 'ClientController');
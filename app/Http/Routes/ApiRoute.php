<?php
/**
 * 接口
 */
$router->group(['prefix' => 'client'], function($router){

	$router->post('login','ClientController@login');
    $router->post('register','ClientController@register');
    $router->post('getVerify','ClientController@getVerify');




});



$router->resource('client', 'ClientController');
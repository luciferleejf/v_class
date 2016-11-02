<?php
/**
 * 接口
 */
$router->group(['prefix' => 'client'], function($router){

	$router->get('checkLogin','ClientController@checkLogin');
});

$router->resource('client', 'ClientController');
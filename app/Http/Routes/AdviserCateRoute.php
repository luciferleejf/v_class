<?php
/**
 *  顾问路由
 */
$router->group(['prefix' => 'adviserCate'], function($router){
    $router->get('sort', 'AdviserCateController@sort');
	$router->get('/', 'AdviserCateController@index');

});

$router->resource('adviserCate', 'AdviserCateController');
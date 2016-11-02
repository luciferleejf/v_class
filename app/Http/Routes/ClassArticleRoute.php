<?php
/**
 *  顾问路由
 */
$router->group(['prefix' => 'classArticle'], function($router){
    $router->get('sort', 'ClassArticleController@sort');
	$router->get('/', 'ClassArticleController@index');

});

$router->resource('classArticle', 'ClassArticleController');
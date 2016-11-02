<?php
/**
 *  顾问路由
 */
$router->group(['prefix' => 'adviserArticle'], function($router){
    $router->get('sort', 'AdviserArticleController@sort');
	$router->get('/', 'AdviserArticleController@index');

});

$router->resource('adviserArticle', 'AdviserArticleController');
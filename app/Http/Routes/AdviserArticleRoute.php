<?php
/**
 *  顾问路由
 */
$router->group(['prefix' => 'adviserArticle'], function($router){

    $router->get('ajaxIndex', 'AdviserArticleController@ajaxIndex');
    $router->get('create', 'AdviserArticleController@create');
    $router->get('edit', 'AdviserArticleController@edit');
    $router->get('show', 'AdviserArticleController@show');







});

$router->resource('adviserArticle', 'AdviserArticleController');



<?php
/**
 *  课程路由
 */
$router->group(['prefix' => 'classArticle'], function($router){

    $router->get('ajaxIndex', 'ClassArticleController@ajaxIndex');
    $router->get('create', 'ClassArticleController@create');
    $router->get('edit', 'ClassArticleController@edit');
    $router->get('show', 'ClassArticleController@show');




    //$router->post('uploadFile', 'ClassArticleController@uploadFile');



});

$router->resource('classArticle', 'ClassArticleController');



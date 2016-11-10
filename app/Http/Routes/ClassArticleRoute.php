<?php
/**
 *  课程路由
 */
$router->group(['prefix' => 'classArticle'], function($router){

    $router->get('ajaxIndex', 'ClassArticleController@ajaxIndex');
    $router->get('create', 'ClassArticleController@create');
    $router->get('edit', 'ClassArticleController@edit');
    $router->get('show', 'ClassArticleController@show');



    $router->get('/{id}/mark/{status}', 'AdviserArticleController@mark')
        ->where([
            'id' => '[0-9]+',
            'status' => config('admin.global.status.trash').'|'.
                config('admin.global.status.audit').'|'.
                config('admin.global.status.active')
        ]);

});

$router->resource('classArticle', 'ClassArticleController');



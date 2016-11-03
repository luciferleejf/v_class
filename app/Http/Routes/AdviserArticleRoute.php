<?php
/**
 *  顾问路由
 */
$router->group(['prefix' => 'adviserArticle'], function($router){
    $router->get('ajaxIndex', 'AdviserArticle@ajaxIndex');
    $router->get('/{id}/mark/{status}', 'AdviserArticleController@mark')
        ->where([
            'id' => '[0-9]+',
            'status' => config('admin.global.status.trash').'|'.
                config('admin.global.status.audit').'|'.
                config('admin.global.status.active')
        ]);
    $router->get('/{id}/reset','AdviserArticleController@changePassword')->where(['id' => '[0-9]+']);
    $router->post('reset','AdviserArticleController@resetPassword');
});

$router->resource('adviserArticle', 'AdviserArticleController');



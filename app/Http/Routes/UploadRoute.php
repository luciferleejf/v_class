<?php
/**
 * 接口
 */
$router->group(['prefix' => 'upload'], function($router){


    $router->post('article_upload','UploadController@article_upload');

});



$router->resource('upload', 'UploadController');
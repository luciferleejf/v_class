<?php
/**
 * 接口
 */
$router->group(['prefix' => 'upload'], function($router){



    $router->get('server','UploadController@server');
    $router->post('server','UploadController@server');
});



$router->resource('upload', 'UploadController');
<?php
/**
 *  顾问路由
 */
$router->group(['prefix' => 'recommend'], function($router){
    $router->get('index', 'RecommendController@index');

});





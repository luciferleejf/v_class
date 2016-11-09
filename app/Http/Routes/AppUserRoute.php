<?php
/**
 *  顾问路由
 */
$router->group(['prefix' => 'appUser'], function($router){
    $router->get('ajaxIndex', 'AppUserController@ajaxIndex');

});

$router->resource('appUser', 'AppUserController');



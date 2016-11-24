<?php
/**
 * 接口
 */
$router->group(['prefix' => 'client'], function($router){

	$router->post('login','ClientController@login');   //用户登录
    $router->post('register','ClientController@register'); //用户注册
    $router->post('getVerify','ClientController@getVerify');   //发送验证码
    $router->post('setDefault','ClientController@setDefault'); //头像昵称设置
    $router->post('forgetPassword','ClientController@forgetPassword');//忘记密码
    $router->post('resetPassword','ClientController@resetPassword');  //重置密码
    $router->POST('classDetail','ClientController@classDetail'); //课程详情页
    $router->POST('adviserDetail','ClientController@adviserDetail'); //课程详情页


    $router->get('getIndex','ClientController@getIndex');
    $router->get('getAdviser','ClientController@getAdviser');
    $router->get('getClassCate','ClientController@getClassCate');









});



$router->resource('client', 'ClientController');
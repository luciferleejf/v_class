<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['prefix' => '', 'namespace' => 'Admin','middleware' => ['web', 'auth']], function ($router) {
    $router->get('/', 'IndexController@index');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {

    //Route::get('/login', function(){return view('auth.login');});
    Route::auth();
});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin','middleware' => ['web', 'auth']], function ($router) {

    $router->get('/', 'IndexController@index');

    /*
     *
     *系统
     *
     * */

        /*用户*/
        require(__DIR__ . '/Routes/UserRoute.php');
        //权限
        require(__DIR__ . '/Routes/PermissionRoute.php');
        /*菜单*/
        require(__DIR__ . '/Routes/MenuRoute.php');
        //角色
        require(__DIR__ . '/Routes/RoleRoute.php');

    /*
     *
     * 课程管理
     *
     * */

        //课程分类
        require(__DIR__ . '/Routes/ClassCateRoute.php');
        //课程列表
        require(__DIR__ . '/Routes/ClassArticleRoute.php');

    /*
     * 顾问管理
     *
     * */
        //顾问分类
        require(__DIR__ . '/Routes/AdviserCateRoute.php');
        //顾问列表
        require(__DIR__ . '/Routes/AdviserArticleRoute.php');

    /*
     *
     *用户管理
     *
     * */
    require(__DIR__ . '/Routes/AppUserRoute.php');



    /*
     *
     *接口管理
     *
     * */
    require(__DIR__ . '/Routes/ApiListRoute.php');

    /*
    *
    *推荐位管理
    *
     *
    * */
    require(__DIR__ . '/Routes/RecommendRoute.php');



    /*
    *
    *上传插件
    *
     *
    * */
    require(__DIR__ . '/Routes/UploadRoute.php');

});


Route::group(['prefix' => 'api', 'namespace' => 'Api'], function ($router) {

    require(__DIR__ . '/Routes/ApiRoute.php');
    require(__DIR__ . '/Routes/DataRoute.php');
});
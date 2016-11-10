<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->singleton('AdviserCateRepository', function($app){
            return new \App\Repositories\admin\AdviserCateRepository();
        });

        $this->app->singleton('ClassCateRepository', function($app){
            return new \App\Repositories\admin\ClassCateRepository();
        });

        $this->app->singleton('ClassArticleRepository', function($app){
            return new \App\Repositories\admin\ClassArticleRepository();
        });



        $this->app->singleton('AdviserArticleRepository', function($app){
            return new \App\Repositories\admin\AdviserArticleRepository();
        });

        $this->app->singleton('VerifyCodeRepository', function($app){
            return new \App\Repositories\api\VerifyCodeRepository();
        });
    }
}

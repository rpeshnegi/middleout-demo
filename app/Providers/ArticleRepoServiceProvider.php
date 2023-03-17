<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ArticleRepoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Repositories\Article\IArticleRepository', 'App\Repositories\Article\ArticleRepository');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

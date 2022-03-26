<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Src\Application\Repositories\ArticleRepository;
use Src\Infrastructure\Repositories\EloquentArticleRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            ArticleRepository::class,
            EloquentArticleRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

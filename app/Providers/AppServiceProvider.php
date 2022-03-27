<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Src\Application\Repositories\ArticleRepository;
use Src\Application\Repositories\CommentIntentionRepository;
use Src\Application\Repositories\UserRepository;
use Src\Infrastructure\Repositories\EloquentArticleRepository;
use Src\Infrastructure\Repositories\EloquentCommentIntentionRepository;
use Src\Infrastructure\Repositories\EloquentUserRepository;

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

        $this->app->bind(
            UserRepository::class,
            EloquentUserRepository::class
        );

        $this->app->bind(
            CommentIntentionRepository::class,
            EloquentCommentIntentionRepository::class
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

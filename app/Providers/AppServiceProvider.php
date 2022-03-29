<?php

namespace App\Providers;

use Illuminate\Support\Facades\Bus;
use Illuminate\Support\ServiceProvider;
use Src\Application\Commands\CommentPublishedCommand;
use Src\Application\Handlers\CommentPublishedHandler;
use Src\Application\Repositories\ArticleRepository;
use Src\Application\Repositories\CommentIntentionRepository;
use Src\Application\Repositories\CommentRepository;
use Src\Application\Repositories\UserRepository;
use Src\Infrastructure\Repositories\EloquentArticleRepository;
use Src\Infrastructure\Repositories\EloquentCommentIntentionRepository;
use Src\Infrastructure\Repositories\EloquentCommentRepository;
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

        $this->app->bind(
            CommentRepository::class,
            EloquentCommentRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Bus::map([
            CommentPublishedCommand::class => CommentPublishedHandler::class,
        ]);
    }
}

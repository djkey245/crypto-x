<?php

namespace App\Providers;

use App\Domain\News\Repositories\TweetRepositoryInterface;
use App\Infrastructure\Persistence\News\EloquentTweetRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            TweetRepositoryInterface::class,
            EloquentTweetRepository::class
        );

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

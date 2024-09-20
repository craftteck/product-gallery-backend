<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Packages\Domain\Product\FavoriteRepositoryInterface;
use Packages\Infrastructure\Product\FavoriteRepository;

class FavoriteServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            FavoriteRepositoryInterface::class,
            FavoriteRepository::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Packages\Domain\Favorite\FavoriteRepositoryInterface;
use Packages\Infrastructure\Favorite\FavoriteRepository;
use Packages\Usecase\Favorite\Create\CreateFavoriteUsecase;
use Packages\Usecase\Favorite\Create\CreateFavoriteUsecaseInterface;

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

        $this->app->bind(
            CreateFavoriteUsecaseInterface::class,
            CreateFavoriteUsecase::class,
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

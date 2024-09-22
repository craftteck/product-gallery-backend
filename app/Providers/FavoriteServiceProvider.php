<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Packages\Domain\Favorite\FavoriteRepositoryInterface;
use Packages\Infrastructure\Favorite\FavoriteRepository;
use Packages\Usecase\Favorite\Create\CreateFavoriteUsecase;
use Packages\Usecase\Favorite\Create\CreateFavoriteUsecaseInterface;
use Packages\Usecase\Favorite\Delete\DeleteFavoriteUsecase;
use Packages\Usecase\Favorite\Delete\DeleteFavoriteUsecaseInterface;

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

        $this->app->bind(
            DeleteFavoriteUsecaseInterface::class,
            DeleteFavoriteUsecase::class,
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

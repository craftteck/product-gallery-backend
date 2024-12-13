<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Packages\Domain\Favorite\FavoriteRepositoryInterface;
use Packages\Infrastructure\Favorite\FavoriteRepository;
use Packages\UseCase\Favorite\Create\CreateFavoriteUseCase;
use Packages\UseCase\Favorite\Create\CreateFavoriteUseCaseInterface;
use Packages\UseCase\Favorite\Delete\DeleteFavoriteUseCase;
use Packages\UseCase\Favorite\Delete\DeleteFavoriteUseCaseInterface;

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

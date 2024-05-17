<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Packages\Domain\Product\ProductRepositoryInterface;
use Packages\Infrastructure\Product\ProductRepository;
use Packages\Usecase\Product\CreateProductInteractor;
use Packages\Usecase\Product\CreateProductInteractorInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            ProductRepositoryInterface::class,
            ProductRepository::class
        );

        $this->app->bind(
            CreateProductInteractorInterface::class,
            CreateProductInteractor::class,
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

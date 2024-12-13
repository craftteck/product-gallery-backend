<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Packages\Domain\Product\ProductRepositoryInterface;
use Packages\Infrastructure\Product\ProductRepository;
use Packages\UseCase\Product\Create\CreateProductUseCase;
use Packages\UseCase\Product\Create\CreateProductUseCaseInterface;
use Packages\UseCase\Product\Delete\DeleteProductUseCase;
use Packages\UseCase\Product\Delete\DeleteProductUseCaseInterface;
use Packages\UseCase\Product\Read\ReadProductUseCase;
use Packages\UseCase\Product\Read\ReadProductUseCaseInterface;
use Packages\UseCase\Product\Update\UpdateProductUseCase;
use Packages\UseCase\Product\Update\UpdateProductUseCaseInterface;

class ProductServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            ProductRepositoryInterface::class,
            ProductRepository::class
        );

        $this->app->bind(
            CreateProductUseCaseInterface::class,
            CreateProductUseCase::class,
        );

        $this->app->bind(
            ReadProductUseCaseInterface::class,
            ReadProductUseCase::class,
        );

        $this->app->bind(
            UpdateProductUseCaseInterface::class,
            UpdateProductUseCase::class,
        );

        $this->app->bind(
            DeleteProductUseCaseInterface::class,
            DeleteProductUseCase::class,
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

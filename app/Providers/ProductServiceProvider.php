<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Packages\Domain\Product\ProductRepositoryInterface;
use Packages\Infrastructure\Product\ProductRepository;
use Packages\Usecase\Product\Create\CreateProductUsecase;
use Packages\Usecase\Product\Create\CreateProductUsecaseInterface;
use Packages\Usecase\Product\Delete\DeleteProductUsecase;
use Packages\Usecase\Product\Delete\DeleteProductUsecaseInterface;
use Packages\Usecase\Product\Read\ReadProductUsecase;
use Packages\Usecase\Product\Read\ReadProductUsecaseInterface;
use Packages\Usecase\Product\Update\UpdateProductUsecase;
use Packages\Usecase\Product\Update\UpdateProductUsecaseInterface;

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
            CreateProductUsecaseInterface::class,
            CreateProductUsecase::class,
        );

        $this->app->bind(
            ReadProductUsecaseInterface::class,
            ReadProductUsecase::class,
        );

        $this->app->bind(
            UpdateProductUsecaseInterface::class,
            UpdateProductUsecase::class,
        );

        $this->app->bind(
            DeleteProductUsecaseInterface::class,
            DeleteProductUsecase::class,
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

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Packages\Domain\Product\ProductRepositoryInterface;
use Packages\Infrastructure\Product\ProductRepository;

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
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

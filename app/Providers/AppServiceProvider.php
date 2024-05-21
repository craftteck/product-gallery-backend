<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\ServiceProvider;
use Packages\Domain\Product\ProductRepositoryInterface;
use Packages\Infrastructure\Product\ProductRepository;
use Packages\Usecase\Product\Create\CreateProductInteractor;
use Packages\Usecase\Product\Create\CreateProductInteractorInterface;
use Packages\Usecase\Product\Delete\DeleteProductInteractor;
use Packages\Usecase\Product\Delete\DeleteProductInteractorInterface;
use Packages\Usecase\Product\Read\ReadProductInteractor;
use Packages\Usecase\Product\Read\ReadProductInteractorInterface;

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

        $this->app->bind(
            ReadProductInteractorInterface::class,
            ReadProductInteractor::class,
        );

        $this->app->bind(
            DeleteProductInteractorInterface::class,
            DeleteProductInteractor::class,
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        ResetPassword::createUrlUsing(function (object $notifiable, string $token) {
            return config('app.frontend_url')."/password-reset/$token?email={$notifiable->getEmailForPasswordReset()}";
        });
    }
}

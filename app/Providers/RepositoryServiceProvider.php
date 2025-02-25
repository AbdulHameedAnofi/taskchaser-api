<?php

namespace App\Providers;

use App\Repositories\AuthenticateRepository;
use App\Repositories\CartRepository;
use App\Repositories\Contracts\AuthenticateRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\ProductRepository;
use App\Repositories\Contracts\CartRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            AuthenticateRepositoryInterface::class,
            AuthenticateRepository::class
        );

        $this->app->bind(
            ProductRepositoryInterface::class,
            ProductRepository::class
        );

        $this->app->bind(
            CartRepositoryInterface::class,
            CartRepository::class
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

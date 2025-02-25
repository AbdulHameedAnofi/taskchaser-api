<?php

namespace App\Providers;

use App\Repositories\AuthenticateRepository;
use App\Repositories\CartRepository;
use App\Repositories\Contracts\AuthenticateRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\ProductRepository;
use App\Respositories\Contracts\CartRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
        $this->app->bind([
            AuthenticateRepositoryInterface::class => AuthenticateRepository::class,
            ProductRepositoryInterface::class => ProductRepository::class,
            CartRepositoryInterface::class => CartRepository::class,
        ]);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

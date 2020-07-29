<?php

namespace App\Providers;

use App\Repositories\Eloquent\OrderRepository;
use App\Repositories\Eloquent\ProductRepository;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\Interfaces\ProductInterface;
use App\Repositories\Interfaces\UserInterface;
use App\Repositories\Interfaces\OrderInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind(UserInterface::class, UserRepository::class);
        $this->app->bind(OrderInterface::class, OrderRepository::class);
        $this->app->bind(ProductInterface::class, ProductRepository::class);

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

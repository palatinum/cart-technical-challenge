<?php

namespace Core\ShoppingCart\Infrastructure\Laravel\Providers;

use Core\ShoppingCart\Domain\Repositories\CartProductRepositoryContract;
use Core\ShoppingCart\Domain\Repositories\CartRepositoryContract;
use Core\ShoppingCart\Infrastructure\Laravel\Repositories\CartProductRepositoryEloquent;
use Core\ShoppingCart\Infrastructure\Laravel\Repositories\CartRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(CartRepositoryContract::class, CartRepositoryEloquent::class);
        $this->app->bind(CartProductRepositoryContract::class, CartProductRepositoryEloquent::class);
    }
}

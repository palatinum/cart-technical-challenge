<?php

namespace Core\ShoppingCart\Infrastructure\Laravel\Repositories;

use Core\ShoppingCart\Domain\Entities\Cart;
use Core\ShoppingCart\Domain\Repositories\CartRepositoryContract;
use \Core\ShoppingCart\Infrastructure\Laravel\Eloquent\Cart as Model;

readonly class CartRepositoryEloquent implements CartRepositoryContract
{
    public function __construct(
        private Model $model
    ) {}

    public function create(): Cart
    {
        $model = $this->model->create();
        return new Cart(
            id: $model->id,
            quantity: 0,
        );
    }

    public function updateQuantity(int $cartId): int
    {
        $model = $this->model->find($cartId);
        return $model->updateQuantity();
    }

    public function empty(int $cartId): Cart
    {
        $model = $this->model->find($cartId);
        $model->empty();
        $model->updateQuantity();
        return new Cart(
            id: $model->id,
            quantity: 0,
        );

    }
}

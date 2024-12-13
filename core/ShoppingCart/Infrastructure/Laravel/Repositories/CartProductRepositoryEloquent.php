<?php

namespace Core\ShoppingCart\Infrastructure\Laravel\Repositories;

use Core\ShoppingCart\Domain\Entities\CartProduct;
use Core\ShoppingCart\Domain\Repositories\CartProductRepositoryContract;
use Core\ShoppingCart\Infrastructure\Laravel\Eloquent\CartProduct as Model;

readonly class CartProductRepositoryEloquent implements CartProductRepositoryContract
{
    public function __construct(
        private Model $model
    ) {}

    public function getCartProductByCartIdAndProductId (int $cartId, int $productId): ?CartProduct
    {
        $model = $this->model->where('cart_id', $cartId)->where('product_id', $productId)->first();
        if(!$model) {
            return null;
        }
        return new CartProduct(
            id: $model->id,
            cartId: $model->cart_id,
            productId: $model->product_id,
            quantity: $model->quantity,
        );
    }

    public function create(int $cartId, int $productId, int $quantity): CartProduct
    {
        $model = $this->model->create([
            'cart_id' => $cartId,
            'product_id' => $productId,
            'quantity' => $quantity,
        ]);
        return new CartProduct(
            id: $model->id,
            cartId: $model->cart_id,
            productId: $model->product_id,
            quantity: $model->quantity,
        );
    }

    public function update(int $cartProductId, int $quantity): CartProduct
    {
        $model = $this->model->find($cartProductId);
        $model->update([
            'quantity' => $quantity,
        ]);

        return new CartProduct(
            id: $model->id,
            cartId: $model->cart_id,
            productId: $model->product_id,
            quantity: $model->quantity,
        );
    }

    public function remove(int $cartProductId): CartProduct
    {
        $model = $this->model->find($cartProductId);
        $model->delete();

        return new CartProduct(
            id: $model->id,
            cartId: $model->cart_id,
            productId: $model->product_id,
            quantity: $model->quantity,
        );
    }
}

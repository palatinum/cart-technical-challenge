<?php

namespace Core\ShoppingCart\Domain\Entities;

readonly class CartProduct
{
    public function __construct(
        private int $id,
        private int $cartId,
        private int $productId,
        private int $quantity,
    ){}

    public function id (): int
    {
        return $this->id;
    }
    public function cartId (): int
    {
        return $this->cartId;
    }
    public function productId (): int
    {
        return $this->productId;
    }
    public function quantity (): int
    {
        return $this->quantity;
    }
}

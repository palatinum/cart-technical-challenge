<?php

namespace Core\ShoppingCart\Domain\Entities;

readonly class Cart
{
    public function __construct(
        private int $id,
        private int $quantity,
    ){}

    public function id (): int
    {
        return $this->id;
    }
    public function quantity (): int
    {
        return $this->quantity;
    }
}

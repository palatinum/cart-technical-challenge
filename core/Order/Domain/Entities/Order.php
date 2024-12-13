<?php

namespace Core\Order\Domain\Entities;

readonly class Order
{
    /**
     * @param int $cartId
     * @param int $quantity
     */
    public function __construct(
        private int $cartId,
        private int $quantity,
    ){}

    /**
     * @return int
     */
    public function cartId (): int
    {
        return $this->cartId;
    }

    /**
     * @return int
     */
    public function quantity (): int
    {
        return $this->quantity;
    }
}

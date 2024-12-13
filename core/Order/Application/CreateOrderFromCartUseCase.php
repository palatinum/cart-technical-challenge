<?php

namespace Core\Order\Application;

use Core\Order\Domain\Entities\Order;

class CreateOrderFromCartUseCase
{
    /**
     * @param int $cartId
     * @param int $quantity
     * @return Order
     */
    public function __invoke(int $cartId, int $quantity): Order
    {
        //TODO: implement order creation
        return new Order($cartId, $quantity);
    }
}

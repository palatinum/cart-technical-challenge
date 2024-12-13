<?php

namespace Core\ShoppingCart\Domain\Repositories;

use Core\ShoppingCart\Domain\Entities\Cart;
use Core\ShoppingCart\Domain\Entities\CartProduct;

interface CartRepositoryContract
{
    public function create (): Cart;

    public function updateQuantity(int $cartId): int;
}

<?php

namespace Core\ShoppingCart\Domain\Repositories;

use Core\ShoppingCart\Domain\Entities\CartProduct;

interface CartProductRepositoryContract
{
    public function getCartProductByCartIdAndProductId (int $cartId, int $productId): ?CartProduct;
    public function create (int $cartId, int $productId, int $quantity): CartProduct;
    public function update(int $cartProductId, int $quantity): CartProduct;
    public function remove(int $cartProductId): CartProduct;
}

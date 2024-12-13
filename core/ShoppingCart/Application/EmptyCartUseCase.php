<?php

namespace Core\ShoppingCart\Application;

use Core\ShoppingCart\Domain\Entities\Cart;
use Core\ShoppingCart\Domain\Repositories\CartRepositoryContract;

class EmptyCartUseCase
{
    public function __construct(
        private CartRepositoryContract $cartRepository
    ){}

    public function __invoke(int $cartId): Cart
    {
        return $this->cartRepository->empty($cartId);
    }
}

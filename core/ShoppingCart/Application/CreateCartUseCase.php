<?php

namespace Core\ShoppingCart\Application;

use Core\ShoppingCart\Domain\Entities\Cart;
use Core\ShoppingCart\Domain\Repositories\CartRepositoryContract;

readonly class CreateCartUseCase
{
    /**
     * @param CartRepositoryContract $cartRepository
     */
    public function __construct(
        private CartRepositoryContract $cartRepository
    ){}

    /**
     * @return Cart
     */
    public function __invoke(): Cart
    {
        return $this->cartRepository->create();
    }
}

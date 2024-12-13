<?php

namespace Core\ShoppingCart\Application;

use Core\ShoppingCart\Domain\Entities\CartProduct;
use Core\ShoppingCart\Domain\Repositories\CartProductRepositoryContract;
use Core\ShoppingCart\Domain\Repositories\CartRepositoryContract;

readonly class UpdateCartProductUseCase
{
    public function __construct(
        private CartProductRepositoryContract $cartProductRepository,
        private CartRepositoryContract        $cartRepository
    ){}

    public function __invoke(int $cartProductId, int $quantity): CartProduct
    {
        $cartProduct = $this->cartProductRepository->update($cartProductId, $quantity);
        $this->cartRepository->updateQuantity($cartProduct->cartId());
        return $cartProduct;
    }
}

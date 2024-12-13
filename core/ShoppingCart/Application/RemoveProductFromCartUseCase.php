<?php

namespace Core\ShoppingCart\Application;

use Core\ShoppingCart\Domain\Entities\CartProduct;
use Core\ShoppingCart\Domain\Repositories\CartProductRepositoryContract;
use Core\ShoppingCart\Domain\Repositories\CartRepositoryContract;

class RemoveProductFromCartUseCase
{
    public function __construct(
        private CartProductRepositoryContract $cartProductRepository,
        private CartRepositoryContract        $cartRepository
    ){}

    public function __invoke(int $cartProductId): CartProduct
    {
        $product = $this->cartProductRepository->remove($cartProductId);
        $this->cartRepository->updateQuantity($product->cartId());
        return $product;
    }
}

<?php

namespace Core\ShoppingCart\Application;

use Core\ShoppingCart\Domain\Entities\CartProduct;
use Core\ShoppingCart\Domain\Repositories\CartProductRepositoryContract;
use Core\ShoppingCart\Domain\Repositories\CartRepositoryContract;

readonly class AddProductToCartUseCase
{
    public function __construct(
        private CartProductRepositoryContract $cartProductRepository,
        private CartRepositoryContract $cartRepository
    ){}

    public function __invoke(int $cartId, int $productId, int $quantity): CartProduct
    {
        $cartProduct = $this->cartProductRepository->getCartProductByCartIdAndProductId($cartId, $productId);
        if($cartProduct) {
            $totalQuantity = $quantity + $cartProduct->quantity();
            $cartProduct = $this->cartProductRepository->update($cartProduct->id(), $totalQuantity);
        } else {
            $cartProduct = $this->cartProductRepository->create($cartId, $productId, $quantity);
        }
        $this->cartRepository->updateQuantity($cartProduct->cartId());
        return $cartProduct;
    }
}

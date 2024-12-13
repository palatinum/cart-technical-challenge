<?php

namespace Tests\Unit\ShoppingCart\UseCases;

use Core\ShoppingCart\Application\AddProductToCartUseCase;
use Core\ShoppingCart\Domain\Entities\CartProduct;
use Core\ShoppingCart\Domain\Repositories\CartProductRepositoryContract;
use Core\ShoppingCart\Infrastructure\Laravel\Repositories\CartRepositoryEloquent;
use PHPUnit\Framework\TestCase;

class AddProductToCartUseCaseTest extends TestCase
{
    public function testAddExistingProductToCartSuccess () {
        $cartProductId = 1;
        $cartId = 5;
        $productId = 78432;
        $quantity = 4;
        $newQuantity = 2;
        $totalQuantity = $quantity + $newQuantity;
        $existingCartProduct = new CartProduct($cartProductId, $cartId, $productId, $quantity);
        $expectedCartProduct = new CartProduct($cartProductId, $cartId, $productId, $totalQuantity);

        $cartProductRepository = $this->createMock(CartProductRepositoryContract::class);
        $cartProductRepository->expects($this->once())
            ->method('getCartProductByCartIdAndProductId')
            ->with($cartId, $productId)
            ->willReturn($existingCartProduct);

        $cartProductRepository->expects($this->once())
            ->method('update')
            ->with($cartProductId, $totalQuantity)
            ->willReturn($expectedCartProduct);

        $cartRepository = $this->createMock(CartRepositoryEloquent::class);
        $cartRepository->expects($this->once())
            ->method('updateQuantity')
            ->with($cartId)
            ->willReturn($totalQuantity);

        $useCase = new AddProductToCartUseCase($cartProductRepository, $cartRepository);
        $response = $useCase->__invoke($cartId, $productId, $newQuantity);
        $this->assertEquals($expectedCartProduct->quantity(), $response->quantity());
    }

    public function testAddProductToCartSuccess () {
        $cartProductId = 1;
        $cartId = 5;
        $productId = 78432;
        $quantity = 4;
        $expectedCartProduct = new CartProduct($cartProductId, $cartId, $productId, $quantity);

        $cartProductRepository = $this->createMock(CartProductRepositoryContract::class);
        $cartProductRepository->expects($this->once())
            ->method('getCartProductByCartIdAndProductId')
            ->with($cartId, $productId)
            ->willReturn(null);

        $cartProductRepository->expects($this->once())
            ->method('create')
            ->with($cartId, $productId, $quantity)
            ->willReturn($expectedCartProduct);

        $cartRepository = $this->createMock(CartRepositoryEloquent::class);
        $cartRepository->expects($this->once())
            ->method('updateQuantity')
            ->with($cartId)
            ->willReturn($quantity);

        $useCase = new AddProductToCartUseCase($cartProductRepository, $cartRepository);
        $response = $useCase->__invoke($cartId, $productId, $quantity);
        $this->assertEquals($expectedCartProduct->id(), $response->id());
        $this->assertEquals($expectedCartProduct->cartId(), $response->cartId());
        $this->assertEquals($expectedCartProduct->productId(), $response->productId());
        $this->assertEquals($expectedCartProduct->quantity(), $response->quantity());
    }
}

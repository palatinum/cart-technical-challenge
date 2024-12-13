<?php

namespace Tests\Unit\ShoppingCart\UseCases;

use Core\ShoppingCart\Application\UpdateCartProductUseCase;
use Core\ShoppingCart\Domain\Entities\CartProduct;
use Core\ShoppingCart\Domain\Repositories\CartProductRepositoryContract;
use Core\ShoppingCart\Infrastructure\Laravel\Repositories\CartRepositoryEloquent;
use PHPUnit\Framework\TestCase;

class UpdateCartProductUseCaseTest extends TestCase
{
    public function testUpdateCartProductSuccess () {
        $cartProductId = 1;
        $cartId = 5;
        $productId = 78432;
        $quantity = 4;
        $expectedCartProduct = new CartProduct($cartProductId, $cartId, $productId, $quantity);

        $cartProductRepository = $this->createMock(CartProductRepositoryContract::class);
        $cartProductRepository->expects($this->once())
            ->method('update')
            ->with($cartProductId, $quantity)
            ->willReturn($expectedCartProduct);

        $cartRepository = $this->createMock(CartRepositoryEloquent::class);
        $cartRepository->expects($this->once())
            ->method('updateQuantity')
            ->with($cartId)
            ->willReturn($quantity);

        $useCase = new UpdateCartProductUseCase($cartProductRepository, $cartRepository);
        $response = $useCase->__invoke($cartProductId, $quantity);
        $this->assertEquals($expectedCartProduct->id(), $response->id());
        $this->assertEquals($expectedCartProduct->cartId(), $response->cartId());
        $this->assertEquals($expectedCartProduct->productId(), $response->productId());
        $this->assertEquals($expectedCartProduct->quantity(), $response->quantity());
    }
}

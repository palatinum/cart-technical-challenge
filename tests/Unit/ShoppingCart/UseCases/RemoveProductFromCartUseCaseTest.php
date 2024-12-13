<?php

namespace Tests\Unit\ShoppingCart\UseCases;

use Core\ShoppingCart\Application\RemoveProductFromCartUseCase;
use Core\ShoppingCart\Domain\Entities\CartProduct;
use Core\ShoppingCart\Domain\Repositories\CartProductRepositoryContract;
use Core\ShoppingCart\Infrastructure\Laravel\Repositories\CartRepositoryEloquent;
use PHPUnit\Framework\TestCase;

class RemoveProductFromCartUseCaseTest extends TestCase
{
    public function testRemoveProductFromCart () {
        $cartProductId = 1;
        $cartId = 5;
        $productId = 78432;
        $quantity = 4;
        $expectedCartProduct = new CartProduct($cartProductId, $cartId, $productId, $quantity);

        $cartProductRepository = $this->createMock(CartProductRepositoryContract::class);
        $cartProductRepository->expects($this->once())
            ->method('remove')
            ->with($cartProductId)
            ->willReturn($expectedCartProduct);

        $cartRepository = $this->createMock(CartRepositoryEloquent::class);
        $cartRepository->expects($this->once())
            ->method('updateQuantity')
            ->with($cartId)
            ->willReturn($quantity);


        $useCase = new RemoveProductFromCartUseCase($cartProductRepository, $cartRepository);
        $response = $useCase->__invoke($cartProductId);
        $this->assertEquals($expectedCartProduct, $response);
    }
}

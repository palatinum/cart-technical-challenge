<?php

namespace Tests\Unit\ShoppingCart\UseCases;

use Core\ShoppingCart\Application\EmptyCartUseCase;
use Core\ShoppingCart\Domain\Entities\Cart;
use Core\ShoppingCart\Infrastructure\Laravel\Repositories\CartRepositoryEloquent;
use PHPUnit\Framework\TestCase;

class EmptyCartUseCaseTest extends TestCase
{
    public function testEmptyCartSuccess () {
        $cartId = 1;
        $quantity = 0;
        $expectedCart = new Cart($cartId, $quantity);
        $cartRepository = $this->createMock(CartRepositoryEloquent::class);
        $cartRepository->expects($this->once())
            ->method('empty')
            ->willReturn($expectedCart);

        $useCase = new EmptyCartUseCase($cartRepository);
        $response = $useCase->__invoke($cartId);
        $this->assertEquals($expectedCart->quantity(), $response->quantity());
    }
}

<?php

namespace Tests\Unit\ShoppingCart\UseCases;

use Core\ShoppingCart\Application\CreateCartUseCase;
use Core\ShoppingCart\Domain\Entities\Cart;
use Core\ShoppingCart\Infrastructure\Laravel\Repositories\CartRepositoryEloquent;
use PHPUnit\Framework\TestCase;

class CreateCartUseCaseTest extends TestCase
{
    public function testCreateCartSuccess () {
        $cart = new Cart(1, 0);
        $repository = $this->createMock(CartRepositoryEloquent::class);
        $repository->expects($this->once())
            ->method('create')
            ->willReturn($cart);
        $useCase = new CreateCartUseCase($repository);
        $response = $useCase->__invoke();
        $this->assertEquals($cart, $response);
    }
}

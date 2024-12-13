<?php

namespace Tests\Unit\Order\UseCases;

use Core\Order\Application\CreateOrderFromCartUseCase;
use Core\ShoppingCart\Domain\Entities\Cart;
use PHPUnit\Framework\TestCase;

class CreateOrderFromCartUseCaseTest extends TestCase
{
    public function testGivenCartShouldReturnOrder () {
        $cart = new Cart(1, 12);
        $useCase = new CreateOrderFromCartUseCase();
        $order = $useCase->__invoke($cart->id(), $cart->quantity());
        $this->assertEquals($cart->id(), $order->cartId());
        $this->assertEquals($cart->quantity(), $order->quantity());
    }
}

<?php

namespace Core\Shared\Infrastructure\Controllers;

use Core\Order\Application\CreateOrderFromCartUseCase;
use Core\Shared\Infrastructure\Responses\ConfirmCartPurchaseResponse;
use Core\ShoppingCart\Application\EmptyCartUseCase;
use Core\ShoppingCart\Infrastructure\Laravel\Controllers\Controller;
use Core\ShoppingCart\Infrastructure\Laravel\Requests\ConfirmCartPurchaseRequest;

class ConfirmCartPurchaseController extends Controller
{
    public function __construct(
        private readonly EmptyCartUseCase $emptyCart,
        private readonly CreateOrderFromCartUseCase $createOrderFromCart
    ){}

    public function __invoke(ConfirmCartPurchaseRequest $request): ConfirmCartPurchaseResponse
    {
        $cart = $this->emptyCart->__invoke(
            $request->integer('cartId'),
        );
        $order = $this->createOrderFromCart->__invoke($cart->id(), $cart->quantity());
        return new ConfirmCartPurchaseResponse($order);
    }
}

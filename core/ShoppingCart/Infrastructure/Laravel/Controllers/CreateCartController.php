<?php

namespace Core\ShoppingCart\Infrastructure\Laravel\Controllers;

use Core\ShoppingCart\Application\CreateCartUseCase;
use Core\ShoppingCart\Infrastructure\Laravel\Responses\CreateCartResponse;

class CreateCartController extends Controller
{
    public function __construct(
        private readonly CreateCartUseCase $createCart
    ){}

    public function __invoke(): CreateCartResponse
    {
        $cart = $this->createCart->__invoke();
        return new CreateCartResponse($cart);
    }
}

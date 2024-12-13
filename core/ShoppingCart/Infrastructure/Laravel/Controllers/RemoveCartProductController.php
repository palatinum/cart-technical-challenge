<?php

namespace Core\ShoppingCart\Infrastructure\Laravel\Controllers;

use Core\ShoppingCart\Application\RemoveProductFromCartUseCase;
use Core\ShoppingCart\Infrastructure\Laravel\Requests\RemoveCartProductRequest;
use Core\ShoppingCart\Infrastructure\Laravel\Responses\RemoveCartProductResponse;

class RemoveCartProductController extends Controller
{
    public function __construct(
        private readonly RemoveProductFromCartUseCase $removeProductFromCart
    ){}

    public function __invoke(RemoveCartProductRequest $request): RemoveCartProductResponse
    {
        $product = $this->removeProductFromCart->__invoke(
            $request->integer('cartProductId'),
        );
        return new RemoveCartProductResponse($product);
    }
}

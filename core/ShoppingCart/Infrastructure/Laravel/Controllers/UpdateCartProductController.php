<?php

namespace Core\ShoppingCart\Infrastructure\Laravel\Controllers;

use Core\ShoppingCart\Application\UpdateCartProductUseCase;
use Core\ShoppingCart\Infrastructure\Laravel\Requests\UpdateCartProductRequest;
use Core\ShoppingCart\Infrastructure\Laravel\Responses\UpdateCartProductResponse;

class UpdateCartProductController extends Controller
{
    public function __construct(
        private readonly UpdateCartProductUseCase $updateCartProduct
    ){}

    public function __invoke(UpdateCartProductRequest $request): UpdateCartProductResponse
    {
        $product = $this->updateCartProduct->__invoke(
            $request->integer('cartProductId'),
            $request->integer('quantity'),
        );
        return new UpdateCartProductResponse($product);
    }
}
